@extends('layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('head')
    @parent
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Họ và tên</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Role</th>
                                            <th>Trạng thái</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($users))
                                        @foreach ($users as $key=>$item)

                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->full_name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>@if ($item->address == "")
                                                    --
                                                    @else
                                                    {{ $item->address }}
                                                @endif</td>
                                                <td>{{ $item->role_name }} </td>
                                                <td>@if ($item->status==0)
                                                    <span class="text-danger">Ngưng hoạt động</span>
                                                @else
                                                    <span class="text-success">Hoạt động</span>
                                                @endif</td>
                                                <td><a href="{{ route('get-EditUser',$item->id) }}">Sửa</a> <br> <a href="#">Xóa</a></td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7">Không có người dùng nào</td>
                                        </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection
@section('script')


    @parent


@endsection