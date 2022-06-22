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
                            <a href="{{ route('get-CreateCategory') }}" rel="noopener noreferrer" style="float:right">Thêm mới</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên danh mục</th>
                                            <th>Icon</th>
                                            <th>Trạng thái</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($category))
                                        @foreach ($category as $key=>$item)

                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->category_name }}</td>
                                                <td class="d-flex justify-content-center"><img width="60"  src="{{ asset('storage/categories') }}/{{ $item->icon }}" ></td>
                                                <td>@if ($item->status==0)
                                                    <span class="text-danger">Ngưng hoạt động</span>
                                                @else
                                                    <span class="text-success">Hoạt động</span>
                                                @endif</td>
                                                <td><a href="{{ route('get-EditCategory',$item->id) }}">Sửa</a> <br> <a href="#">Xóa</a></td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="5">Không có danh mục nào</td>
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
