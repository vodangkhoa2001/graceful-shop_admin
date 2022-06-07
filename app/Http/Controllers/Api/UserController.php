<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use File;
use Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {        
        try {
            $validator = Validator::make($request->all(), [ 
                'phone' => 'required', 
                'password' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Cần điền đầy đủ thông tin đăng nhập!']);
            }
            if(Auth::attempt(['phone' => $request->phone, 'password' => $request->password])){ 
                $user = Auth::user(); 
                if($user->role == 0 && $user->status == 1){
                    $token = $user->createToken('MobileApp', ['Graceful'])->plainTextToken;
                    return response()->json(['status'=>0, 'data'=>$token, 'message'=>'']); 
                } else {
                    return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Tài khoản hoặc mật khẩu không chính xác!']);
                }
            } 
            else{ 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Tài khoản hoặc mật khẩu không chính xác!']);
            } 
        } catch (\Exception $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }

    public function register(Request $request) 
    { 
        try {
            $validator = Validator::make($request->all(), [ 
                'name' => 'required', 
                'phone' => 'required', 
                'password' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->messages()]);
            } 
            else{
                $validator = Validator::make($request->all(), [ 
                    'phone' => 'unique:users',
                ]);
                if ($validator->fails()) { 
                    return response()->json(['status'=>-2, 'data'=>'', 'message'=>$validator->messages()]);
                } 
                $user = User::create([
                    'full_name' => $request->name, 
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'avatar' => 'default_avatar.png',
                    'role' => 0,
                    'status' => true
                ]); 
                return response()->json(['status'=>0, 'data'=>$user, 'message'=>'']);
            }
        } catch (\Exception $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }

    public function info() 
    { 
        // $user = Auth::user();
        $user = User::select(['*', DB::raw('CONCAT("img/users/",avatar) AS avatar')])
        ->where('role', '=', 0)
        ->where('status', '=', 1)
        ->where('id', '=', Auth::user()->id)
        ->get();
        return response()->json(['status'=>0, 'data' => $user, 'message'=>'']);      
    } 
}
