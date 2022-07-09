<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Jobs\SendEmail;
use App\Models\Picture;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Danh sách đơn hàng';
        $invoices = DB::table('invoices')
        ->join('users','users.id','=','invoices.user_id')
        ->leftJoin('vouchers','vouchers.id','=','invoices.voucher_id')
        ->select('invoices.*','users.full_name','vouchers.voucher_code')
        ->get();
        // dd($invoices);
        return view('component.invoice.list-invoice',compact('invoices','title'));
    }

    public function updateStatus($id){
        $invoice = Invoice::find($id);
        $invoice->status = $invoice->status+1;
        $invoice->update();
        return Redirect::route('list-invoice')->with('msg','Đã duyệt đơn hàng '.$invoice->invoice_code);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);
        $invoice_v = DB::select("SELECT vouchers.* FROM invoices LEFT JOIN vouchers on voucher_id = vouchers.id WHERE invoices.id = {$id}");
        $invoice_details = DB::table('invoice_details')
        ->leftJoin('invoices','invoices.id','=','invoice_id')
        ->leftJoin('products','products.id','=','product_id')
        ->where('invoice_id','=',$id)
        ->select('invoice_details.*','products.*','invoices.quantity as invoice_quantity')
        ->get();
        foreach ($invoice_details as $invoice_detail){
            $pics[] = DB::select("SELECT picture_value FROM pictures,products WHERE products.id = pictures.product_id and product_id ={$invoice_detail->product_id}");
        }
        // for($i = 0;$i<count($pics);$i++){
        //     for($j =0;$j<count($pics[$i]);$j++){
        //         $a[]=$pics[$i][$j]->picture_value;
        //     }
        // }
        // dd($a);
        return view('component.invoice.detail-invoice',compact('invoice','invoice_details','invoice_v','pics'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $invoice = Invoice::find($id);
        return view('component.invoice.edit-invoice',compact('invoice'));
    }

    public function postEdit($id,Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $user = Auth::user();
        $invoice = Invoice::where('invoices.id', '=', $id)
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

            $user2 = User::where('id','=',$invoice->user_id)->first();
            $message = [
                'type' => 'Đơn hàng',
                'hi' => $user2->full_name,
                'content1' => 'Mã đơn hàng: ',
                'num' => $invoice->invoice_code,
                'content2' => ' đã huỷ thành công. Lý do: '.$request->reason,
            ];
            SendEmail::dispatch($message, $user2)->delay(now()->addMinute(1));
        }
        $code = $invoice->invoice_code;
        return Redirect::route('list-invoice')->with('msg','Đã hủy thành công đơn hàng '.$code);
    }
}
