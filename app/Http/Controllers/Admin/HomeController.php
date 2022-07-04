<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //đếm số người dùng
    public function statistic(){
        $countUser = DB::table('users')->where([['role','=',0],['status','=',1]])->count();
        $date = Date('Y-m-d');
        //DT hom nay
        $saleNowDay = DB::table('invoices')
        ->where('status','=',4)
        ->whereDate('created_at','=',$date)
        ->sum('until_price');
        //DT thang nay
        $saleNowMonth = DB::table('invoices')
        ->where('status','=',4)
        ->whereMonth('created_at','=',Carbon::parse($date)->format('m'))
        ->sum('until_price');
        // dd($saleNowMonth);

        // bieu do
        $data = Invoice::select('id','created_at')->get()
        ->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M');
        });
        $months=[];
        $monthCount=[];
        foreach ($data as $month=>$value){
            $months[]=$month;
            $monthCount[]=count($value);
        }
        // dd($months);
        return view('home',['countUser'=>$countUser,'saleNowDay' => $saleNowDay,'saleNowMonth'=>$saleNowMonth,'months'=>$months,'monthCount'=>$monthCount]);
    }
}
