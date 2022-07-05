<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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
        ->whereYear('created_at','=',Carbon::parse($date)->format('Y'))
        ->sum('until_price');
        // dd($saleNowMonth);
        $saleNowYear = DB::table('invoices')
        ->where('status','=',4)
        ->whereYear('created_at','=',Carbon::parse($date)->format('Y'))
        ->sum('until_price');

        //so don hang
        $num_invocie = Invoice::where('status','=','4')->count();

        // bieu do doanh thu thep tung thang

        $data = DB::select("SELECT MONTH(created_at) as 'month',YEAR(created_at) as 'year',SUM(until_price) as 'sale' from invoices WHERE status = 4 GROUP BY year(created_at),month(created_at)");

        $months=[];
        $monthSum=[];
        foreach ($data as $value){
            $months[]="Tháng ".$value->month;
            $monthSum[]=$value->sale;
        }

        // dd($months,$saleNowYear);
        return view('home',['saleNowYear'=>$saleNowYear,'num_invocie'=>$num_invocie,'countUser'=>$countUser,'saleNowDay' => $saleNowDay,'saleNowMonth'=>$saleNowMonth,'months'=>$months,'monthSum'=>$monthSum]);
    }

    public function saleOfYear(Request $request){
        $year = $request->year;
        $data = DB::select("SELECT MONTH(created_at) as 'month',SUM(until_price) as 'sale' from invoices WHERE status = 4 and month('created_at') = {$year} GROUP BY month");
        // $data = DB::table('invoices')
        // ->where('status','=',4)
        // ->whereYear('created_at','=',$request->year)
        // ->select('created_at')
        // ->sum('until_price');
        // dd($data);
        $months=[];
        $monthSum=[];
        foreach ($data as $value){
            $months[]="Tháng ".$value->month;
            $monthSum[]=$value->sale;
        }
        return Redirect::route('home',['months'=>$months,'monthSum'=>$monthSum,'year'=>$year]);
    }
}
