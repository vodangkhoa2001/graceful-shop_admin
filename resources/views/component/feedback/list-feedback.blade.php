@extends('layouts.master')
@section('title')
    Phản hồi từ người dùng
@endsection
@section('head')
    @parent

@endsection
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Phản hồi từ người dùng</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Phản hồi từ người dùng</h6>
            <a href="{{ route('get-AddProduct') }}" rel="noopener noreferrer" style="float:right">Thêm mới</a>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên người dùng</th>
                            <th>Góp ý</th>
                            <th>Ngày tạo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($feedbacks))

                        @foreach ($feedbacks as $key=>$item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->full_name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="#" class="btn btn-outline-primary"><i class="fa-solid fa-envelope"></i></a>
                            </td>
                        </tr>

                        @endforeach
                        @else
                        <tr>
                            <td colspan="5">Không có phản hồi nào</td>
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
