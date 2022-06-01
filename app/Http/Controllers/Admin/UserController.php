<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Admin\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUser(){
        $title = 'Danh sách người dùng';
        $users = new User();
        $users = DB::select('SELECT * FROM users WHERE status = 1 ORDER BY created_at DESC');
        return view('component.users',compact('title','users'));
    }
    public function register(Request $request){
        $user = new User();
        $user->phone = $request->phone;
        $user->password = $request->password;
        $user->avatar = 'avatar_default.png';
        $user->full_name = $request->full_name;
        $user->api_token = Str::random(60);
        $user->role_id=0;
        $user->status = 1;
        return response()->json(['mess','created user']);
    }
}

