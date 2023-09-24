@extends('admin.main')

@section('head')

    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('Sub_button')
    <a class="btn btn-success" href="/admin/products/list">
        <i class="fa fa-arrow-left"></i> Quay về danh sách</a>
    <a class="btn btn-primary" href="/admin/products/addimg/{{$products->id}} ">
        <i class="fa fa-image"></i> Thêm ảnh chi tiết
    </a>
@endsection

@section('content')

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên Sản Phẩm</label>
                        <input type="text" name="name" value="{{$products->name}}" class="form-control"  placeholder="Nhập tên sản phẩm">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Danh Mục</label>
                        <select class="form-control" name="menu_id">
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}" {{$products->menu_id == $menu->id ? 'selected' : ''}} >{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Giá Gốc</label>
                        <input type="number" name="price" value="{{ $products->price }}"  class="form-control" >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Giá Giảm</label>
                        <input type="number" name="price_sale" value="{{ $products->price_sale }}"  class="form-control" >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="menu">Số lượng</label>
                        <input type="number" name="quantity" value="{{ $products->quantity }}"  min="0" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mô Tả </label>
                        <textarea style="height: 200px" name="description" class="form-control">{{ $products->description }}</textarea>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="menu">Cấu hình </label>
                        <textarea style="height: 280px" class="form-control" name="systemConfig">{{ $products->systemConfig }}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Mô Tả Chi Tiết</label>
                <textarea name="content" id="content" class="form-control">{{ $products->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="menu">Ảnh Sản Phẩm</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show" style="padding-top: 20px">
                    <a href="{{$products->thumb}}" target="_blank" >
                        <img style="border-radius: 5%; max-width: 30vmax; max-height: 30vmax" src="{{$products->thumb}}">
                    </a>
                </div>
                <input type="hidden" name="thumb" id="thumb" value="{{$products->thumb}}">
            </div>

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" {{$products->active==1 ? 'checked =""' : ''}}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" {{$products->active==0 ? 'checked =""' : ''}} >
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Sửa Sản Phẩm</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content',{
            height: '500px'
        });
    </script>
@endsection
