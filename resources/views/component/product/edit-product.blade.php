@extends('layouts.master')
@section('title')
    Chỉnh sửa sản phẩm
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
                <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa sản phẩm</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Cập nhật thành công.</h3>
                    <a href="{{ route('products') }}">Danh sách sản phẩm</a>
                @else
                    <form action="{{route('post-editProduct',$product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="product_code">Mã sản phẩm</label>
                                <input type="text" class="form-control" required = "Mã sản phẩm không được để trống" name="product_code" id="product_code" value="{{ $product->product_barcode }}" placeholder="Mã sản phẩm" readonly >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="product_name">Tên sản phẩm</label>
                                <input type="text" class="form-control" required = "Tên sản phẩm không được để trống" name="product_name" id="product_name" placeholder="Tên sản phẩm" value="{{ $product->product_name }}" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="price">Giá bán</label>
                                <input type="text" class="form-control" id="price" required = "Giá bán không được để trống" min="0" name="price" placeholder="Giá bán" value="{{ $product->price }}">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="brand">Thương hiệu</label>
                                <select name="brand" id="brand" class="form-control" required = "Thương hiệu không được để trống">
                                    @foreach ($brand as $item)
                                        @if ($item->status ==1)
                                            <option value="{{ $item->id }}" @if ($item->id == $product->brand_id)
                                                selected
                                            @endif>{{ $item->brand_name }}</option>

                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="product_type">Loại sản phẩm</label>
                                <select name="product_type" id="product_type" class="form-control" required = "Loại sản phẩm không được để trống">
                                    <option value="">-- Loại sản phẩm --</option>
                                    @foreach ($product_type as $item)
                                        @if ($item->status == 1)
                                            <option value="{{ $item->id }}" @if ($item->id == $product->product_type_id)
                                                selected
                                            @endif>{{ $item->product_type_name }}</option>

                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2 pt-2">
                                <label for="img_product" class="mt-4 btn btn-primary">Cập nhật ảnh</label>
                                {{-- <input type="file" id="images" accept="image/*" multiple required name="images[]"> --}}
                                <input type="file" accept="image/*" multiple name="images[]" class="images" id="img_product"  style="display:none">
                            </div>

                            {{-- <div class="form-group col-md-5">
                                <label for="">Kích thước:</label>
                                <div class="sizes">
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" name="size_name[]" value="S" id="sizeS" @for($i = 0;$i<count($size);$i++) @if ($size[$i]->size_name == "S") checked @endif  @endfor >
                                        <label class="form-check-label" for="sizeS">S</label>
                                    </div>
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" name="size_name[]" value="M" id="sizeM" @for($i = 0;$i<count($size);$i++) @if ($size[$i]->size_name == "M") checked @endif  @endfor>
                                        <label class="form-check-label" for="sizeM">M</label>
                                    </div>
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" name="size_name[]" value="L" id="sizeL" @for($i = 0;$i<count($size);$i++) @if ($size[$i]->size_name == "L") checked @endif  @endfor>
                                        <label class="form-check-label" for="sizeL">L</label>
                                    </div>
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" name="size_name[]" value="XL" id="sizeXL" @for($i = 0;$i<count($size);$i++) @if ($size[$i]->size_name == "XL") checked @endif  @endfor>
                                        <label class="form-check-label" for="sizeXL">XL</label>
                                    </div>
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" name="size_name[]" value="XXL" id="size2XL" @for($i = 0;$i<count($size);$i++) @if ($size[$i]->size_name == "XXL") checked @endif  @endfor>
                                        <label class="form-check-label" for="size2XL">XXL</label>
                                    </div>
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" name="size_name[]" value="Free size" id="free_size" @for($i = 0;$i<count($size);$i++) @if ($size[$i]->size_name == "Free size") checked @endif  @endfor>
                                        <label class="form-check-label" for="free_size">Free size</label>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <div class="form-row pl-4">
                            <div class="form-group col-md-3">
                                @if (!empty($pics))
                                <div class="d-flex preview">
                                    @for ($i = 0;$i<count($pics);$i++)
                                        <img class="mr-2" height="150" width="200" src="{{ asset('assets/img/products') }}/{{ $pics[$i]->picture_value }}">
                                    @endfor
                                </div>
                                @endif

                            </div>
                        </div>

                        <div class="row ml-1">
                            <button onclick="add_append();" type="button"  class="btn btn-info btn-color"><i class="fa-solid fa-circle-plus mr-2"></i>Thêm màu</button>
                        </div>
                        <div class="add_color_and_size" >
                            @if (!empty($colors))
                                @for ($i =0;$i<count($colors);$i++)
                                <div class="form-group form-inline ml-md-4">
                                    <label for="color"> Tên màu :</label>
                                    <input type="text" name="color_id[]" placeholder="" value="{{ $colors[$i]->id }}" class="form-control col-md-3 mx-sm-3" hidden>
                                    <input type="text" id="color" name="color_name[]" value="{{ $colors[$i]->color_name }}" placeholder="Tên màu" class="form-control col-md-1 mx-sm-3">
                                    <img src="{{ asset('assets/img/product_colors') }}/{{$colors[$i]->picture }}" width="60">&ensp;
                                    {{-- <label for="image_colors" class="btn btn-info ml-4">Sửa ảnh </label> --}}
                                    {{-- <input type="file" accept="image/*" name="image_colors[]" id='img' onchange="img(this);"> --}}
                                    <input type="text" name="image_colors[{{$i}}]" id="temp" hidden value="-1">
                                    {{-- <input type="file" accept="image/*" name="image_colors[{{$i}}]" id="image_colors"  style="display:none"> --}}
                                    <button type="button" class="ml-4 btn-xoa btn btn-outline-danger" onclick="deleteRow(this);" hidden><i class="fa-solid fa-minus"></i></button>
                                    <div class="form-group ml-3">
                                        <label for="status">Trạng thái </label> &ensp;
                                        <select name="color_status[]" class="form-control">
                                            @if ($colors[$i]->status==0)
                                                <option value="0" selected>Ngưng hoạt động</option>
                                                <option value="1">Đang hoạt động</option>
                                            @else
                                                <option value="0" >Ngưng hoạt động</option>
                                                <option value="1" selected>Đang hoạt động</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                @endfor
                            @endif
                        </div>

                        <div class="row ml-1">
                            <button onclick="add_size();" type="button"  class="btn btn-info btn-color"><i class="fa-solid fa-circle-plus mr-2"></i>Thêm size</button>
                        </div>
                        <div class="add_size" >
                            @if (!empty($sizes))
                                @for ($i =0;$i<count($sizes);$i++)
                                <div class="form-group form-inline ml-md-4">
                                    <label for="color"> Tên size :</label>
                                    <input type="text" name="size_id[]" placeholder="" value="{{ $sizes[$i]->id }}" class="form-control col-md-3 mx-sm-3" hidden>
                                    <input type="text" id="size" name="size_name[]" placeholder="Tên size" class="form-control col-md-3 mx-sm-3" value="{{ $sizes[$i]->size_name }}">
                                    <button type="button" class="btn-xoa btn btn-outline-danger" onclick="deleteRow(this);" hidden><i class="fa-solid fa-minus"></i></button>
                                    <div class="form-group ml-2">
                                        <label for="status">Trạng thái </label> &ensp;
                                        <select name="size_status[]" class="form-control">
                                            @if ($sizes[$i]->status==0)
                                                <option value="0" selected>Ngưng hoạt động</option>
                                                <option value="1">Đang hoạt động</option>
                                            @else
                                                <option value="0" >Ngưng hoạt động</option>
                                                <option value="1" selected>Đang hoạt động</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                @endfor
                            @endif
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

    const ipnFileElement = document.querySelector('.images')
    const resultElement = document.querySelector('.preview')
    const validImageTypes = ['image/gif', 'image/jpeg', 'image/png']

    ipnFileElement.addEventListener('change', function(e) {
        const files = e.target.files
        const file = files[0]
        const fileType = file['type']

        if (!validImageTypes.includes(fileType)) {
            resultElement.insertAdjacentHTML(
            'beforeend',
            '<span class="preview-img">Chọn ảnh đi :3</span>'
            )
            return
        }
        document.querySelectorAll(".preview img").forEach(img => img.remove());
        for (let index = 0; index < files.length; index++) {
            const fileReader = new FileReader()
            fileReader.readAsDataURL(files[index])

            fileReader.onload = function() {
                const url = fileReader.result
                resultElement.insertAdjacentHTML(
                'beforeend',
                `<img class="mr-2" height="150" width="200" src="${url}" alt="${file.name}">`
                )
            }
        }
    })

</script>
@parent
@endsection
