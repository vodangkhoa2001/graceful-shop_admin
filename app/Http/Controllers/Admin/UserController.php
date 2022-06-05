<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Admin\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LoginRequest;
class UserController extends Controller
{

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUser(){
        $title = 'Danh sách người dùng';
        $users = new User();
        $users = DB::select('SELECT * FROM users WHERE status = 1 ORDER BY created_at DESC');
        return view('component.users',compact('title','users'));
    }

    public function getLogin(){
        return view('component.login');
    }
    public function postLogin(Request $request){
        if((Auth::attempt(['phone' => $request->phone, 'password' =>
            $request->password])))
            {
                #chỗ này của user
                $taikhoan=Auth::User();


                if(Auth::User()->role_id != 0)
                {
                    Session::flash('success', 'Đăng Nhập thành công');
                    return redirect()->route('home');
                }
                else
                {
                    Session::flash('error', 'Tài khoản hoặc mật khẩu không đúng!');
                    return redirect('login');
                }
                //return view("component/index");
            }
            else
            {
                    // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
                    Session::flash('error', 'Tài khoản hoặc mật khẩu không đúng!');
                    return redirect('login');
            }
    }
    // public function register(Request $request){
    //     $user = new User();
    //     $user->phone = $request->phone;
    //     $user->password = $request->password;
    //     $user->avatar = 'avatar_default.png';
    //     $user->full_name = $request->full_name;
    //     $user->api_token = Str::random(60);
    //     $user->role_id=0;
    //     $user->status = 1;
    //     return response()->json(['mess','created user']);
    // }
}

