@extends('layouts.master')
@section('title')
    Danh sách voucher
@endsection
@section('head')
    @parent
    {{-- <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
@endsection
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Danh sách voucher</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách voucher</h6>
                            <a href="{{ route('get-CreateVoucher') }}" rel="noopener noreferrer" style="float:right">Thêm mới</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Code</th>
                                            <th>Giá yêu cầu</th>
                                            <th>Giá giảm</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th>Mô tả</th>
                                            <th>Trạng thái</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($voucher))
                                        @foreach ($voucher as $key=>$item)

                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->voucher_code }}</td>
                                                <td>{{ $item->min_total_price }}</td>
                                                <td>{{ $item->discount_price }}</td>
                                                <td>{{ $item->start_date }}</td>
                                                <td>{{ $item->end_date }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>@if ($item->status==0)
                                                    <span class="text-danger">Không hoạt động</span>
                                                @else
                                                    <span class="text-success">Hoạt động</span>
                                                @endif</td>
                                                <td>
                                                    <a href="{{ route('detail-voucher',$item->id) }}">Chi tiết</a>
                                                    <a class="btn text-primary" href="{{ route('get-EditVoucher',$item->id) }}">Sửa</a> <br>

                                                    <a id="btn-delete" class="text-primary btn">Xóa</a></td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="9">Không có voucher nào</td>
                                        </tr>
                                        @endif
                                        <!-- Modal content -->


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection
@section('script')
    @parent
    <script>

    </script>

@endsection
