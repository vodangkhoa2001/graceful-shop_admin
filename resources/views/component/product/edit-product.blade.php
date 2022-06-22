@extends('layouts.master')
@section('title')
    {{ $title }}
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
            <div class="card-header py-3 d-flex">
                <a class="mr-3" href="{{ route('products') }}">Danh sách</a>
                <h6 class="m-0 font-weight-bold text-primary">{{$title}}</h6>
            </div>
            <div class="card-body">
                <form action="{{route('post-AddProduct')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="product_code">Mã sản phẩm</label>
                            <input type="text" class="form-control" name="product_code" id="product_code" value="{{ $product->product_barcode }}" placeholder="Mã sản phẩm" readonly >
                            </div>
                            <div class="form-group col-md-6">
                            <label for="product_name">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Tên sản phẩm" value="{{ $product->product_name }}" >
                            </div>
                        </div>
                      <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="brand">Thương hiệu</label>
                                <select name="brand" id="brand" class="form-control">
                                    @foreach ($brand as $item)
                                        @if ($item->status ==1)
                                            <option value="{{ $item->id }}" @if ($item->id == $product->brand_id)
                                                selected
                                            @endif>{{ $item->brand_name }}</option>

                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="stock">Số lượng</label>
                                <input type="number" class="form-control" id="stock" name="stock" placeholder="Số lượng" value="{{ $product->stock }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="import_price">Giá nhập</label>
                                <input type="text" class="form-control" id="import_price" name="import_price" placeholder="Giá nhập" value="{{ $product->import_price }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="price">Giá bán</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Giá bán" value="{{ $product->price }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row pl-4 pr-4">
                        <div class="form-group col-md-4">
                            <label for="discount_price">Giá giảm</label>
                            <input class="form-control" type="text" placeholder="Giá giảm" id="discount_price" name="discount_price" value="{{ $product->discount_price }}">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="product_type">Loại sản phẩm</label>
                            <select name="product_type" id="product_type" class="form-control">
                                <option value="">-- Loại sản phẩm --</option>
                                @foreach ($product_type as $item)
                                    @if ($item->status == 1)
                                        <option value="{{ $item->cotegory_id }}" @if ($item->id == $product->product_type_id)
                                            selected
                                        @endif>{{ $item->product_type_name }}</option>

                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row pl-4">
                        <div class="form-group col-md-3">
                            {{-- @if (!empty($product->pictures))
                                <img width="200" height="200" src="{{ asset('assets/img/products') }}/{{ $product->pictures }}" alt="">
                            @else
                            @endif --}}
                            <input type="file" accept="image/*" multiple required name="image" >
                        </div>
                    </div>

                    <button onclick="add_append();" type="button"  class="btn btn-info ml-4 btn-color"><i class="fa-solid fa-circle-plus mr-2"></i>Thêm màu</button>
                    <div class="add_color_and_size" >
                        {{-- @if (!empty($colors($product->id)))
                            @foreach ($colors as $item)
                            <div class="form-group form-inline">
                                <label for="color">Màu <span class="counter"></span>: </label>
                                <input type="color" id="color" class="form-control col-md-1 mx-sm-3">
                                <label for="">Kích thước:</label>
                                <div class="sizes">
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" id="sizeS">
                                        <label class="form-check-label" for="sizeS">S</label>
                                    </div><div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" id="sizeL">
                                        <label class="form-check-label" for="sizeL">L</label>
                                    </div>
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" id="sizeXL">
                                        <label class="form-check-label" for="sizeXL">XL</label>
                                    </div><div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" id="size2XL">
                                        <label class="form-check-label" for="size2XL">XXL</label>
                                    </div>
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" id="free_size">
                                        <label class="form-check-label" for="free_size">Free size</label>
                                    </div>
                                    <button type="button" class="btn-xoa" onclick="remove();">Xoa</button>
                                </div>
                            @endforeach
                        @endif --}}
                    </div>
                    <div class="form-group m-4">
                        <label for="editor">Nội dung</label>
                        <textarea class="editor" name="description" class="form-control ckeditor">
                            {{ $product->description }}
                        </textarea>
                    </div>

                    <div class="form-group m-4">
                        <label for="status">Trạng thái</label>
                        <select name="status" class="form-control">
                            @if ($product->status==0)
                                <option value="0" selected>Ngưng hoạt động</option>
                                <option value="1">Đang hoạt động</option>
                            @else
                                <option value="0" >Ngưng hoạt động</option>
                                <option value="1" selected>Đang hoạt động</option>
                            @endif

                        </select>
                    </div>
                    <div class="d-flex justify-content-end p-4">
                        <button class="btn btn-primary col-2"  type="submit">Cập nhật</button>

                    </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
   function add_append() {

       let txt1 = '<div class="form-group form-inline"><label for="color"> Tên màu <span class="counter"></span>: </label><input type="text" value="" id="color" class="form-control col-md-1 mx-sm-3"><label for="">Kích thước:</label><div class="sizes"><div class="form-check ml-3"><input class="form-check-input" type="checkbox" id="sizeS"><label class="form-check-label" for="sizeS">S</label></div><div class="form-check ml-3">'+
       '<input class="form-check-input" type="checkbox" id="sizeL"><label class="form-check-label" for="sizeL">L</label></div><div class="form-check ml-3"><input class="form-check-input" type="checkbox" id="sizeXL"><label class="form-check-label" for="sizeXL">XL</label></div><div class="form-check ml-3">'
       +' <input class="form-check-input" type="checkbox" id="size2XL"><label class="form-check-label" for="size2XL">XXL</label></div><div class="form-check ml-3"><input class="form-check-input" type="checkbox" id="free_size"><label class="form-check-label" for="free_size">Free size'
       +'</label></div> <button type="button" class="btn-xoa onclick="remove();"">Xoa</button></div>';
       $('.add_color_and_size').append(txt1);

   }
   function remove(e){
    let xoa = document.querySelector('.add_color_and_size');
       xoa.addEventListener('click',remove);
       e.target.remove();
   }

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
