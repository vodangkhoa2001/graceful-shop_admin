@extends('layouts.master')
@section('title')
    {{ $title }}
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
                <h6 class="m-0 font-weight-bold text-primary">{{$title}}</h6>
            </div>
            <div class="card-body">
                <form action="{{route('post-editProduct',$product->id)}}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="product_code">Mã sản phẩm</label>
                          <input type="text" class="form-control" id="product_code" placeholder="Mã sản phẩm" >
                        </div>
                        <div class="form-group col-md-6">
                          <label for="product_name">Tên sản phẩm</label>
                          <input type="text" class="form-control" id="product_name" placeholder="Tên sản phẩm" readonly>
                        </div>
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-3">
                            <label for="brand">Thương hiệu</label>
                            <input type="text" class="form-control" id="brand" placeholder="Brand" readonly>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="stock">Số lượng</label>
                          <input type="number" class="form-control" id="stock" placeholder="Số lượng">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="import_price">Giá nhập</label>
                          <input type="text" class="form-control" id="import_price" placeholder="Giá nhập" readonly>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="import_price">Giá bán</label>
                          <input type="text" class="form-control" id="import_price" placeholder="Giá bán">
                        </div>
                      </div>
                      <div class="form-inline">
                        <div class="form-group form-inline col-lg-6" id="add_color_and_size">
                        <label for="color">Màu</label>
                        <input type="color" id="color" class="form-control col-md-1 mx-sm-3">
                        <label for="">Kích thước:</label>
                        <div class="form-check ml-3">
                            <input class="form-check-input" type="checkbox" id="sizeS">
                            <label class="form-check-label" for="sizeS">
                            S
                            </label>
                        </div>
                        <div class="form-check ml-3">
                            <input class="form-check-input" type="checkbox" id="sizeL">
                            <label class="form-check-label" for="sizeL">
                            L
                            </label>
                        </div>
                        <div class="form-check ml-3">
                            <input class="form-check-input" type="checkbox" id="sizeXL">
                            <label class="form-check-label" for="sizeXL">
                            XL
                            </label>
                        </div>
                        <div class="form-check ml-3">
                            <input class="form-check-input" type="checkbox" id="size2XL">
                            <label class="form-check-label" for="size2XL">
                            XXL
                            </label>
                        </div>
                        <div class="form-check ml-3">
                            <input class="form-check-input" type="checkbox" id="free_size">
                            <label class="form-check-label" for="free_size">
                            Free size
                            </label>
                        </div>
                    </div>
                        <button onclick="add_append();" type="button"  class="btn btn-info ml-4"><i class="fa-solid fa-circle-plus mr-2"></i>Thêm màu</button>
                      </div>
                </form>
            </div>
        </div>

    </div>



</div>
@endsection
@section('script')

    <script type="text/javascript">
   function add_append() {
       var selector = document.getElementById("add_color_and_size");
       selector.append('<div class="form-inline">\n'+'
                        <div class="form-group form-inline col-lg-6" id="add_color_and_size_2">\n'+'
                        <label for="color">Màu</label>\n'+'
                        <input type="color" id="color" class="form-control col-md-1 mx-sm-3">\n'+'
                        </div>');
   }
</script>
    @parent
    <script>

    </script>
@endsection
