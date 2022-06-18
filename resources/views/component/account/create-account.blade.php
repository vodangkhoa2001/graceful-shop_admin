@extends('layouts.master')
@section('title')
    Tạo tài khoản
@endsection
@section('head')
    @parent
@endsection

@section('content')
<div class="row">

    <div class="col-lg">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tạo tài khoản</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Thêm tài khoản thành công.</h3>
                    <a href="{{ route('list-user') }}">Danh sách người dùng</a>
                @else
                <form action="{{ route('post-CreateAccount') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            {{-- <div class="form-group col-md-6">
                            <label for="product_code">Mã người dùng</label>
                            <input type="text" class="form-control" name="product_code" id="product_code" value="{{ $productCode }}" placeholder="Mã sản phẩm" readonly >
                            </div> --}}
                            <div class="form-group col-md-6">
                            <label for="full_name">Họ và tên</label>
                            <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Họ và tên" value="{{ old('full_name') }}" >
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="gender">Giới tính</label>
                                <div class="form-row d-flex justify-content-center">
                                    <div class="form-group col-md-4">
                                        <input type="radio" name="gender" id="male" value="0" checked>
                                        <label for="male">Nam</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="radio" name="gender" id="female" value="1" >
                                        <label for="female">Nữ</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="role">Loại tài khoản</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="">-- Loại tài khoản --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->role_value }}">{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="phone">Số điện thoại</label>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="password">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" value="{{ old('password') }}">
                            </div>

                        </div>
                    </div>

                    <div class="form-row pl-4">
                        <div class="form-group col-md-3">
                        <input type="file" name="avatar" value="{{ old('avatar') }}" accept="image/*" multiple required name="image">

                        </div>
                    </div>
                    <div class="form-group m-4">
                        <label for="status">Trạng thái</label>
                        <select name="status" class="form-control">
                            <option value="1">Đang hoạt động</option>
                            <option value="0">Ngưng hoạt động</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end p-4">
                        <button class="btn btn-primary col-2"  type="submit">Thêm tài khoản</button>

                    </div>
                    </div>

                </form>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
    @parent
@endsection
