@extends('layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('head')
    @parent

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
                                            <th>Tên KH</th>
                                            <th>Mã Voucher</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th width="15%">Trạng thái</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($invoices))

                                        @foreach ($invoices as $key=>$item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->full_name }}</td>
                                            <td>{{ $item->voucher_code }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->until_price }}</td>
                                            <td>@if ($item->status==0)
                                                <span class="text-danger">Đã hủy</span>
                                            @elseif($item->status==1)
                                                <span class="text-warning">Đã xác nhận</span>
                                            @elseif($item->status==2)
                                                <span class="text-warning">Đã đến kho</span>
                                            @elseif($item->status==3)
                                                <span class="text-warning">Đang vận chuyển</span>
                                            @else
                                                <span class="text-success">Đã giao</span>
                                            @endif</td>
                                            <td><a href="{{ route('get-EditInvoice',$item->id) }}">Chỉnh sửa</a> <br> <a href="#">Xóa</a></td>
                                        </tr>

                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7">Không có đơn hàng nào</td>
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


@endsection
