<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Voucher;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voucher = Voucher::orderBy('id','DESC')->get();
        return view('component.voucher.list-voucher',compact('voucher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('component.voucher.create-voucher');
    }
    public function postCreate(Request $request)
    {
        $today = Date('Y-m-d');
        // dd($today,$request->start_date,($today==$request->start_date)?true:false);
        // dd($request->start_date);
        $voucher = new Voucher();
        $voucher->voucher_code = strtoupper($request->voucher_code);
        $voucher->min_total_price = $request->min_total_price;
        $voucher->discount_price = $request->discount_price;
        $voucher->start_date = $request->start_date;
        $voucher->end_date = $request->end_date;
        $voucher->description = $request->description;
        // dd(($today==$request->start_date)?1:0);
        $voucher->status = ($today==$request->start_date)?1:0;
        $success = $voucher->save();
        return view('component.voucher.create-voucher',compact('voucher','success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoucherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voucher = Voucher::find($id);
        $voucher->start_date = Carbon::parse($voucher->start_date)->format('d-m-Y');
        $voucher->end_date = Carbon::parse($voucher->end_date)->format('d-m-Y');
        return view('component.voucher.detail-voucher',compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $voucher = Voucher::find($id);
        $voucher->start_date = Carbon::parse($voucher->start_date)->format('d-m-Y');
        $voucher->end_date = Carbon::parse($voucher->end_date)->format('d-m-Y');
        return view('component.voucher.edit-voucher',compact('voucher'));
    }

    public function postEdit($id,Request $request)
    {
        $voucher = Voucher::find($id);
        $voucher->voucher_code = strtoupper($request->voucher_code);
        $voucher->min_total_price = $request->min_total_price;
        $voucher->discount_price = $request->discount_price;
        $voucher->start_date = $request->start_date;
        $voucher->end_date = $request->end_date;
        $voucher->description = $request->description;
        $voucher->status = $request->status;
        $success = $voucher->update();
        return view('component.voucher.edit-voucher',compact('success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoucherRequest  $request
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        //
    }
}
