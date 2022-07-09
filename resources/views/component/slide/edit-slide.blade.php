@extends('layouts.master')
@section('title')
    Chỉnh sửa slide
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
                <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa slide</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Cập nhật slide thành công.</h3>
                    <a href="{{ route('list-slide') }}">Danh sách slide</a>
                @else
                <form action="{{ route('post-EditSlide',$slide->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                    @endif
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="picture">Ảnh slide</label>
                                <img src="{{ asset('assets/img/slideshows') }}/{{ $slide->picture }}" >
                                <label for="picture" class="btn btn-primary mt-4">Thay đổi</label>
                                <input type="file" accept="image/*" name="picture" id="picture" placeholder="Icon" style="display:none" >
                                @error('picture')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="description">Mô tả slide</label>
                                <textarea name="description" id="description" class="form-control editor" >

                                    {{ $slide->description}}

                                </textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control">
                                @if ($slide->status = 0)
                                    <option value="0" selected>Không hoạt đồng</option>
                                    <option value="1">Hoạt động</option>
                                @else
                                    <option value="0">Không hoạt đồng</option>
                                    <option value="1" selected>Hoạt động</option>
                                @endif
                            </select>
                        </div>

                    <div class="d-flex justify-content-end p-4">
                        <button class="btn btn-primary col-2"  type="submit">Cập nhật</button>

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
    @parent
@endsection
