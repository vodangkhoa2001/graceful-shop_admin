@extends('layouts.master')
@section('title')
    Thêm sản phẩm mới
@endsection
@section('head')
    @parent
    <style>
        .sizes{
            display:flex;
        }
        .btn-color{
            float: right;
            right: 2%;
            width: 200px;
            margin-bottom:20px;
        }
        /* .card-body{
            padding-bottom: 110px !important;
        } */
        select{
            border: none;
        }
    </style>
@endsection

@section('content')
<div class="row">

    <div class="col-lg">



        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('products') }}">Danh sách</a>
                <h6 class="m-0 font-weight-bold text-primary">Thêm sản phẩm mới</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Thêm sản phẩm thành công.</h3>
                    <div class="row">
                        <a href="{{ route('get-AddProduct') }}">Tiếp tục</a>
                        <a href="{{ route('products') }}">Danh sách sản phẩm</a>
                    </div>
                @else
                <form action="{{route('post-AddProduct')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="product_code">Mã sản phẩm</label>
                            <input type="text" class="form-control" name="product_code" id="product_code" value="{{ $productCode }}" placeholder="Mã sản phẩm" readonly >
                            </div>
                            <div class="form-group col-md-6">
                            <label for="product_name">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Tên sản phẩm" value="{{ old('product_name') }}" >
                            </div>
                        </div>
                      <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="brand">Thương hiệu</label>
                                <select name="brand" id="brand" class="form-control">
                                    <option value="">-- Chọn thương hiệu --</option>
                                    @foreach ($brand as $item)
                                        @if ($item->status ==1)
                                            <option value="{{ $item->id }}">{{ $item->brand_name }}</option>

                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="stock">Số lượng</label>
                                <input type="number" class="form-control" id="stock" name="stock" placeholder="Số lượng" value="{{ old('stock') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="import_price">Giá nhập</label>
                                <input type="text" class="form-control" id="import_price" name="import_price" placeholder="Giá nhập" value="{{ old('import_price') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="price">Giá bán</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Giá bán" value="{{ old('price') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row pl-4 pr-4">
                        <div class="form-group col-md-6">
                            <label for="discount_price">Giá giảm</label>
                            <input class="form-control" type="text" placeholder="Giá giảm" id="discount_price" name="discount_price" value="{{ old('discount_price') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="product_type">Loại sản phẩm</label>
                            <select name="product_type" id="product_type" class="form-control">
                                <option value="">-- Loại sản phẩm --</option>
                                @foreach ($product_type as $item)
                                    <option value="{{ $item->id }}">{{ $item->product_type_name }}</option>
                                @endforeach
                            </select>
                        </div>


                    <div class="form-row pl-4">
                        <div class="form-group col-md-7">
                            <label for="">Kích thước:</label>
                            <div class="sizes">
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" name="size_name" value="S" id="sizeS">
                                    <label class="form-check-label" for="sizeS">S</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" name="size_name" value="M" id="sizeM">
                                    <label class="form-check-label" for="sizeM">M</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" name="size_name" value="L" id="sizeL">
                                    <label class="form-check-label" for="sizeL">L</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" name="size_name" value="XL" id="sizeXL">
                                    <label class="form-check-label" for="sizeXL">XL</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" name="size_name" value="XXL" id="size2XL">
                                    <label class="form-check-label" for="size2XL">XXL</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" name="size_name" value="Free size" id="free_size">
                                    <label class="form-check-label" for="free_size">Free size</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="images">Hình ảnh</label>
                        <input type="file" id="images" accept="image/*" multiple required name="images">

                        </div>
                    </div>

                    </div>

                    <button onclick="add_append();" type="button"  class="btn btn-info ml-4 btn-color"><i class="fa-solid fa-circle-plus mr-2"></i>Thêm màu</button>
                    <div class="add_color_and_size">

                    </div>
                    <div class="form-group m-4">
                        <label for="editor">Nội dung</label>
                        <textarea class="editor" name="description" class="form-control ckeditor" value="{{ old('description') }}">
                        </textarea>
                    </div>


                    <div class="d-flex justify-content-end p-4">
                        <button class="btn btn-primary col-2"  type="submit">Thêm sản phẩm</button>

                    </div>
                    </div>

                </form>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/add-and-remove-list.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">


   function chooseImage(fileInput){
       if(fileInput.files && fileInput.files[0]){
           var reader = new FileReader();
           reader.onload = function (e){
               $('#image').attr('src',e.target.result);
           }
           reader.readAsDataURL(fileInput.files[0]);
       }
   }
</script>
@parent
@endsection
