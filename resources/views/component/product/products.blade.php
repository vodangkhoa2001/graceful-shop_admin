@extends('layouts.master')
@section('title')
    {{ $title }}
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
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            <a href="{{ route('get-AddProduct') }}" rel="noopener noreferrer" style="float:right">Thêm mới</a>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá nhập</th>
                            <th>Giá bán</th>
                            <th>Giảm giá</th>
                            <th width="10%">Số lượng</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($products))

                        @foreach ($products as $key=>$item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ number_format( $item->import_price, 0, '', '.') }}</td>
                            <td>{{ number_format( $item->price, 0, '', '.') }}</td>
                            <td>{{ number_format( $item->discount_price, 0, '', '.') }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>@if ($item->status==0)
                                <span class="text-danger">Ngưng hoạt động</span>
                                @else
                                <span class="text-success">Hoạt động</span>
                            @endif</td>
                            <td>
                                <a href="{{ route('get-product',$item->id) }}" class="btn btn-sm btn-outline-primary" title="Chi tiết"><i class="fa-solid fa-file-lines"></i></a>
                                <a href="{{ route('edit-product',$item->id) }}"title="Chỉnh sửa" class="btn btn-sm btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#removeModal{{ $item->id }}" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#removeModal{{ $item->id }}" title="Xóa"><i class="fa-solid fa-minus"></i></a>
                                {{-- Modal --}}
                                <div class="modal fade" id="removeModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Xóa sản phẩm</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <span>Bạn có chắc muốn xóa sản phẩm {{ $item->product_name }}?</span>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('cancel-product',$item->id) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">OK</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </tr>

                        @endforeach
                        @else
                        <tr>
                            <td colspan="8">Không có sản phẩm nào</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- {{ $products->appends(request()->all())->links("pagination::bootstrap-4") }} --}}

@endsection
@section('script')

   @parent

    <!-- Page level plugins -->
    {{-- <script src="{{ asset('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js') }}"></script> --}}




@endsection
