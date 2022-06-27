<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Voucher;
use App\Models\Cart;
use App\Models\Product;
use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request as HttpRequest;
use Carbon\Carbon;
use Validator;
use File;
use Hash;
use App\Jobs\SendEmail;

class InvoiceController extends Controller
{
    //Danh sách hoá đơn
    public function getAllInvoice()
    {
        try {        
            $user = Auth::user();

            $invoices = Invoice::with(['voucher'])
            // ->where('invoices.status', '=', 1)
            ->where('invoices.user_id', '=', $user->id)
            ->orderBy('invoices.id', 'DESC')
            ->get();

            return response()->json(['status'=>0, 'data'=>$invoices, 'message'=>'']);
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }

    //Chi tiết hoá đơn
    public function getInvoiceDetail($id)
    {
        try {        
            $user = Auth::user();

            $invoices = Invoice::where('invoices.user_id', '=', $user->id)
            ->where('invoices.id', '=', $id)
            ->first();
            
            $invoice_detail = InvoiceDetail::with(['product'])
            ->with(['color' => function($query) {
                $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture) AS picture')]);
            }])
            ->with(['size'])
            ->where('invoice_details.invoice_id', '=', $invoices->id)
            ->get();

            return response()->json(['status'=>0, 'data'=>$invoice_detail, 'message'=>'']);
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }

    //Tạo hoá đơn
    public function addInvoice(HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'cart_id' => 'required', 
                'voucher_id' => 'nullable|int',
                'ship_price' => 'nullable|int',
                'name' => 'required', 
                'phone' => 'required', 
                'address' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }
           
            $user = Auth::user();

            $date = Carbon::now();
            $year = $date->year;
            $month = $date->month;
            $day = $date->day;
            if(Str::length($month)==1)
            {
                $month = '0'.$month;
            }
         
            $invoice = Invoice::create([
                'user_id'=> $user->id,
                'invoice_code'=> $year.$month.$day.Str::random(10),
                'voucher_id'=> $request->voucher_id,
                'quantity'=> 0,
                'ship_price'=> $request->ship_price,
                'until_price'=> 0 + $request->ship_price,
                'name'=> $request->name,
                'phone'=> $request->phone,
                'address'=> $request->address,
                'status'=> 1,
                'canceler_id' => null,
                'reason' => null,
            ]); 

            foreach ($request->cart_id as $id){
                $cart = Cart::where('id', '=', $id)
                ->where('user_id', '=', $user->id)
                ->first();
                if($cart){
                    $product = Product::where('id', $cart->product_id)->first();
                    $invoice_detail =  InvoiceDetail::create([
                        'invoice_id'=> $invoice->id,
                        'product_id'=> $cart->product_id,
                        'color_id'=> $cart->color_id,
                        'size_id'=> $cart->size_id,
                        'quantity'=> $cart->quantity,
                        'price'=> $product->price,
                        'total_price'=> $product->price * $cart->quantity,
                        'status'=> 1,
                    ]); 
                    $invoice->update([
                        'quantity'=> $invoice->quantity + $invoice_detail->quantity,
                        'until_price'=> $invoice->until_price + $invoice_detail->total_price,
                    ]); 
                    Product::where('id', $cart->product_id)
                    ->update([
                        'stock'=> $product->stock - $cart->quantity,
                    ]);   
                    $cart->delete();
                }else{
                    DB::rollBack();
                    return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Không tìm thấy sản phẩm trong giỏ hàng']);
                }                
            }        

            if($request->voucher_id){
                $voucher = Voucher::where('id', '=', $request->voucher_id)->first();
                $invoice->update([
                    'until_price'=> $invoice->until_price - $voucher->discount_price,
                ]);
            }
            
            if($invoice->until_price < 0){
                $invoice->update([
                    'until_price'=> 0,
                ]); 
            }

            $message = [
                'type' => 'Đơn hàng',
                'hi' => $user->full_name,
                'content1' => 'Chúng tôi đã tiếp nhận đơn đặt hàng của bạn. Mã đơn hàng của bạn là: ',
                'num' => $invoice->invoice_code,
                'content2' => ' và tổng giá trị đơn hàng: '.$invoice->until_price.' VND. Chúng tôi sẽ phản hồi sớm nhất cho bạn, xin cảm ơn!',
            ];
            SendEmail::dispatch($message, $user)->delay(now()->addMinute(1));            

            DB::commit();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Hoá đơn được tạo thành công!']);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }

    //Huỷ đơn hàng
    public function cancelInvoice(HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'id' => 'required', 
                'reason' => 'required'
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }
        
            $user = Auth::user();

            $invoice = Invoice::where('invoices.id', '=', $request->id)
            ->where('invoices.user_id', '=', $user->id)
            ->first();

            if($invoice){
                $invoice->update([
                    'status'=> 0,
                    'canceler_id'=> $user->id,
                    'reason'=> $request->reason,
                ]); 

                $invoice_details = InvoiceDetail::join('invoices', 'invoices.id', '=', 'invoice_details.invoice_id')
                ->where('invoices.id', '=', $invoice->id)
                ->get();    

                foreach ($invoice_details as $invoice_detail){
                    $product = Product::where('id', $invoice_detail->product_id)->first();
                    Product::where('id', $invoice_detail->product_id)
                    ->update([
                        'stock'=> $product->stock + $invoice_detail->quantity,
                    ]); 
                }

                $message = [
                    'type' => 'Đơn hàng',
                    'hi' => $user->full_name,
                    'content1' => 'Mã đơn hàng: ',
                    'num' => $invoice->invoice_code,
                    'content2' => ' đã huỷ thành công. Lý do: '.$request->reason,
                ];
                SendEmail::dispatch($message, $user)->delay(now()->addMinute(1));            
                
                DB::commit();
                return response()->json(['status'=>0, 'data'=>'', 'message'=>'Huỷ đơn hàng thành công!']);
            }
            else{
                DB::commit();
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Không tìm thấy đơn hàng!']);
            }
            

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }
}
