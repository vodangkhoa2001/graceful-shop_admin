<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;


class FeedbackController extends Controller
{
    public function index(){
        $feedbacks = DB::table('feedback')
        ->leftJoin('users','users.id','=','user_id')
        ->select('feedback.*','users.full_name')
        ->get();

        return view('component.feedback.list-feedback',compact('feedbacks'));
    }
}
