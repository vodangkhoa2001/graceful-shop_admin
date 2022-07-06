<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LoginRequest;
use App\Models\Role;

class UserController extends Controller
{

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUsers(){
        $title = 'Danh sách người dùng';
        $role = Role::all();
        $users = DB::select('SELECT users.*,roles.role_name FROM users,roles WHERE users.role = roles.role_value and users.role != 1 and users.status = 1 ORDER BY created_at DESC');
        return view('component.account.users',compact('title','users','role'));
    }




    public function getLogin(){
        return view('component.login');
    }
    public function postLogin(Request $request){
        if((Auth::attempt(['phone' => $request->phone, 'password' =>
            $request->password])))
            {

                $account=Auth::User();


                if(Auth::User()->role != 0)
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
    //     $user->role=0;
    //     $user->status = 1;
    //     $user->save();
    // }
    public function getCreateAccount(){

        $roles = Role::all();

        return view('component.account.create-account',compact('roles'));
    }
    public function postCreateAccount(Request $request){

        $user = new User();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->avatar = $request->file('avatar')->getClientOriginalName();
        $request->avatar->storeAs('public/users/',$request->file('avatar')->getClientOriginalName());
        $user->role = $request->role;
        $user->status = $request->status;
        return view('component.account.create-account',['success'=>$user->save()]);
    }
    public function getEditUser($id){
        $roles = Role::all();
        $user = User::all()->find($id);
        return view('component.account.edit-account',compact('user','roles'));
    }
    public function postEditUser( Request $request,$id){
        $user = User::find($id);
        if($request->hasFile('avatar_reup')){
            $newImg = $request->file('avatar_reup')->getClientOriginalName();
            $request->avatar_reup->storeAs('public/users/', $newImg);
            $user->avatar = $newImg;
        }
        $user->full_name = $request->input('full_name');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->sex = $request->input('gender');
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');
        $user->address = $request->input('address');
        $user->status = $request->input('status');
        $success = $user->update();
        return view('component.account.edit-account',compact('success'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $name=$user->full_name;
        $user->update();
        return redirect()->route('list-user')->with('msg','Đã xóa thành công người dùng '.$name);

    }
}

