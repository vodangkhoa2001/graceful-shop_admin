@extends('layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('head')
    @parent
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
                    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                            <a href="#" target="_blank" rel="noopener noreferrer" style="float:right">Thêm mới</a>
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
                                            <th width="15%">Số lượng đang bán</th>
                                            <th width="2%">VAT(%)</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($products))

                                        @foreach ($products as $key=>$item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->productName }}</td>
                                            <td>{{ $item->importPrice }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->discountPrice }}</td>
                                            <td>{{ $item->stock }}</td>
                                            <td>{{ $item->vat }}</td>
                                            <td><a href="#">Xem chi tiết</a> <br> <a href="#">Xóa</a></td>
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

@endsection
@section('script')

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>


@endsection
