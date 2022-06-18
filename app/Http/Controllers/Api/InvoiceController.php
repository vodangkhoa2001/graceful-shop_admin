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
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request as HttpRequest;
use Carbon\Carbon;
use Validator;
use File;
use Hash;

class InvoiceController extends Controller
{
    //Danh sách hoá đơn
    public function getAllInvoice()
    {
        try {        
            $user = Auth::user();

            $invoices = Invoice::where('invoices.status', '=', 1)
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

            $invoices = Invoice::where('invoices.status', '=', 1)
            ->where('invoices.user_id', '=', $user->id)
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
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }
        
            $user = Auth::user();

            $invoice = Invoice::create([
                'user_id'=> $user->id,
                'voucher_id'=> $request->voucher_id,
                'quantity'=> 0,
                'ship_price'=> $request->ship_price,
                'until_price'=> 0 - $request->ship_price,
                'status'=> 1,
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
                ]); 
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
