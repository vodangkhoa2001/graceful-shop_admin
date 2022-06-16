<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest;
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
    //Đăng ký
    public function register(HttpRequest $request) 
    { 
        try {
            $validator = Validator::make($request->all(), [ 
                'name' => 'required', 
                'phone' => 'required', 
                'password' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Cần điền đầy đủ thông tin!']);
            } 
            else{
                $validator = Validator::make($request->all(), [ 
                    'phone' => 'unique:users',
                ]);
                if ($validator->fails()) { 
                    return response()->json(['status'=>-2, 'data'=>'', 'message'=>'Số điện thoại đã được đăng ký!']);
                } 
                $user = User::create([
                    'full_name' => $request->name, 
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'avatar' => 'default_avatar.png',
                    'role' => 0,
                    'status' => true
                ]); 
                return response()->json(['status'=>0, 'data'=>$user->id.'', 'message'=>'Đăng ký thành công!']);
            }
        } catch (\Exception $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }
    //Đăng nhập
    public function login(HttpRequest $request)
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
                    return response()->json(['status'=>0, 'data'=>$token, 'message'=>'Đăng nhập thành công!']); 
                } else {
                    if($user->role != 0)
                    {
                        return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Tài khoản không tồn tại!']);
                    }
                    else{
                        return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Tài khoản đã bị khoá!']);
                    }                    
                }
            } 
            else{ 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Tài khoản hoặc mật khẩu không chính xác!']);
            } 
        } catch (\Exception $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }
    //Đăng xuất
    public function logout()
    {
        try {
            Auth::user()->tokens()->delete();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Đăng xuất thành công!']); 
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }
    //Đổi mật khẩu
    public function changePass(HttpRequest $request)
    {
        try {
            $validator = Validator::make($request->all(), [ 
                'old_pass' => 'required', 
                'new_pass' => 'required', 
            ]);            
            $user = Auth::user();
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Cần điền đầy đủ thông tin đăng nhập!']);
            }           
            if(Auth::guard('web')->attempt(['phone' => $user->phone, 'password' => $request->old_pass])){ 
                
                $user->update(['password' => Hash::make($request->new_pass)]);
                Auth::user()->tokens()->delete();
                return response()->json(['status'=>0, 'data'=>'', 'message'=>'Đổi mật thành công!']); 
            } 
            else{ 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Mật khẩu cũ không chính xác!']);
            }               
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }
    //Thông tin người dùng 
    public function info() 
    { 
        try {            
            // $user = Auth::user();
            $user = User::select(['*', DB::raw('CONCAT("assets/img/users/",avatar) AS avatar')])
            ->where('role', '=', 0)
            ->where('status', '=', 1)
            ->where('id', '=', Auth::user()->id)
            ->first();
            return response()->json(['status'=>0, 'data' => $user, 'message'=>'']);   
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    } 

    //Thay đổi thông tin người dùng 
    public function changeInfo(HttpRequest $request) 
    { 
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'full_name' => 'required', 
                'date_of_birth' => 'nullable|date',
                'sex' => 'nullable|int',
                'email' => 'nullable|email',
                'address' => 'nullable|string',
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:10240'
            ]);            
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }      

            $user = Auth::user();
            
            if($request->hasFile('avatar')){
                if($user->avatar != 'default_avatar.png'){
                    //Xoá ảnh cũ
                    unlink(public_path('/assets/img/users/'.$user->avatar));
                }               
                $image= $request->file('avatar');
                $namewithextension = $image->getClientOriginalName();
                $fileName = explode('.', $namewithextension)[0];
                $extension = $image->getClientOriginalExtension();
                $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                $destinationPath = public_path('/assets/img/users/');
                $image->move($destinationPath,$fileNew);
                $user->update([
                    'full_name' => $request->full_name,
                    'date_of_birth' => $request->date_of_birth,
                    'sex' => $request->sex,
                    'email' => $request->email,
                    'address' => $request->address,
                    'avatar' => $fileNew,
                ]);
            }else{
                $user->update([
                    'full_name' => $request->full_name,
                    'date_of_birth' => $request->date_of_birth,
                    'sex' => $request->sex,
                    'email' => $request->email,
                    'address' => $request->address,
                ]);    
            }
            DB::commit();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Cập nhật thông tin thành công!']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    } 

    //Thay đổi ảnh đại diện
    public function changeAvatar(HttpRequest $request) 
    {
        try {
            $validator = Validator::make($request->all(), [ 
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:10240'
            ]);
            
            if ($validator->fails()) {
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);         
            }
            
            $user = Auth::user();
            if($request->hasFile('avatar')){
                if($user->avatar != 'default_avatar.png'){
                    //Xoá ảnh cũ
                    unlink(public_path('/assets/img/users/'.$user->avatar));
                }               
                $image= $request->file('avatar');
                $namewithextension = $image->getClientOriginalName();
                $fileName = explode('.', $namewithextension)[0];
                $extension = $image->getClientOriginalExtension();
                $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                $destinationPath = public_path('/assets/img/users/');
                $image->move($destinationPath,$fileNew);
                $user->update([
                    'avatar' => $fileNew,
                ]);
                return response()->json(['status'=>0, 'data'=>'assets/img/users/'.$fileNew, 'message'=>'Cập nhật thành công!']);
            }
            else{
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Không tìm thấy ảnh']);
            }

        } catch (\Exception $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }
}
