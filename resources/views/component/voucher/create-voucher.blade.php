@extends('layouts.master')
@section('title')
    Tạo voucher
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
                <h6 class="m-0 font-weight-bold text-primary">Tạo voucher</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Thêm voucher thành công.</h3>
                    <a href="{{ route('list-voucher') }}">Danh sách voucher</a>
                @else
                <form action="{{ route('post-CreateVoucher') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="voucher_code">Code</label>
                                <input type="text" class="form-control" name="voucher_code" id="voucher_code" placeholder="Voucher code" value="{{ old('voucher_code') }}" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="min_total_price">Giá yêu cầu</label>
                                <input type="number" class="form-control" name="min_total_price" id="min_total_price" placeholder="Giá yêu cầu" value="{{ old('min_total_price') }}" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="discount_price">Giá giảm</label>
                                <input type="number" class="form-control" name="discount_price" id="discount_price" placeholder="Giá giảm" value="{{ old('discount_price') }}" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="start_date">Ngày bắt đầu</label>
                                <input type="date" class="form-control datepicker" name="start_date" id="start_date"  value="{{ old('start_date') }}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="end_date">Ngày kết thúc</label>
                                <input type="date" class="form-control datepicker" name="end_date" id="end_date"  value="{{ old('end_date') }}" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea name="description" id="description" class="editor"></textarea>
                            </div>
                        </div>
                    <div class="d-flex justify-content-end p-4">
                        <button class="btn btn-primary col-2"  type="submit">Thêm Voucher</button>

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
