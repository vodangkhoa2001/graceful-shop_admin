<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        $success = $invoice->update();
        return Redirect::route('list-invoice',compact('success'));
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
        $invoice_detail = DB::table('invoice_details')
        ->leftJoin('invoices','invoices.id','=','invoice_id')
        ->leftJoin('products','products.id','=','product_id')
        ->where('invoice_id','=',$id)
        ->select('invoice_details.*','products.*','invoices.quantity as invoice_quantity')
        ->get();
        // dd($invoice_v[0]);
        return view('component.invoice.detail-invoice',compact('invoice','invoice_detail','invoice_v'));
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
    public function destroy($id)
    {
        $invoice_detail = DB::table('invoice_details')
        ->leftJoin('invoices','invoices.id','=','invoice_id')
        ->leftJoin('products','products.id','=','product_id')
        ->where('invoices.id','=',$id)
        ->select('invoices.id as invoice_id','products.product_name','products.stock','invoice_details.*')
        ->get();
        dd($invoice_detail[0]);
        $invoice = Invoice::find($id);
        $product = Product::find($invoice_detail->product_id);
        $old_stock = $product->stock;
        $product->stock += $invoice->quantity;
        $invoice->status = 0;
        dd($invoice->id);
        if($product->update() && $invoice->update()){
            $success = true;
        }
        return Redirect::route('list-invoice',compact('success'));
    }
}
