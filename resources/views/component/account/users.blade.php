@extends('layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('head')
    @parent
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                <a href="{{ route('get-CreateAccount') }}" rel="noopener noreferrer" style="float:right">Thêm mới</a>
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
                                    <td>
                                        <div class="d-flex justify-content-xl-between">
                                            @if ($item->status != 0)
                                            <a href="{{ route('get-EditUser',$item->id) }}"title="Chỉnh sửa" class="btn btn-sm btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="#removeModal{{ $item->id }}" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#removeModal{{ $item->id }}" title="Xóa"><i class="fa-solid fa-minus"></i></a>

                                            @else
                                            <a href="{{ route('get-EditUser',$item->id) }}"title="Chỉnh sửa" class="btn btn-sm btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></a>

                                            @endif

                                        </div>
                                        {{-- Modal --}}
                                        <div class="modal fade" id="removeModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ngưng hoạt động người dùng</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span>Bạn có chắc muốn ngưng hoạt động người dùng {{ $item->full_name }}?</span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('cancel-user',$item->id) }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary">OK</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
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
