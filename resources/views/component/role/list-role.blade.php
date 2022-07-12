@extends('layouts.master')
@section('title')
    Danh sách Role
@endsection
@section('head')
    @parent

@endsection
@section('content')
@if (session('msg'))
<div class="alert alert-success">
    {{ session('msg') }}
</div>
@endif
    <h1 class="h3 mb-2 text-gray-800">Danh sách Role </h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách Role </h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Nội dung</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            {{-- <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($roles))

                        @foreach ($roles as $key=>$item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->role_name }}</td>
                            <td>
                                @if($item->status==0)
                                    <span class="text-danger">Không hoạt động</span>
                                @else
                                    <span class="text-success">Hoạt động</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at }}</td>
                            {{-- <td>
                                <a href="#removeModal{{ $item->id }}" class="btn btn-outline-danger" data-toggle="modal" data-target="#removeModal{{ $item->id }}" title="Xóa"><i class="fa-solid fa-minus"></i></a>
                             
                                <div class="modal fade" id="removeModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Xóa role</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <span>Bạn có chắc muốn xóa {{ $item->role_name }}?</span>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('cancel-slide',$item->id) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">OK</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td> --}}
                        </tr>

                        @endforeach
                        @else
                        <tr>
                            <td colspan="5">Không có role nào</td>
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
