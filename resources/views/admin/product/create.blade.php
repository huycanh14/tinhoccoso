@extends('admin.layout.index')
@section('title')
Smarshop - Admin | Product Create
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sản phẩm
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $item)
                            {{ $item }} <br>
                        @endforeach
                    </div>
                @endif
                @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{ session('thongbao') }}
                    </div>
                @endif
                <form action="admin/product/create" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="form-group">
                        <label>Tên sản phẩm</label> <span style="color: red;">(*)</span>
                        <input class="form-control" name="name" placeholder="Nhập tên sản phẩm" />
                    </div>

                    <div class="form-group">
                        <label>Thư mục sản phẩm</label> <span style="color: red;">(*)</span>
                        <select class="form-control" name="product_category_id">
                            @foreach ($product_categories as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Thương hiệu</label> <span style="color: red;">(*)</span>
                        <select class="form-control" name="brand_id">
                            @foreach ($brands as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input type="file" name="image" >
                    </div>

                    <div class="form-group">
                        <label>Giá sản phẩm</label> <span style="color: red;">(*)</span>
                        <input class="form-control" name="price" placeholder="Nhập giá sản phẩm" />
                    </div>

                    <div class="form-group">
                        <label>Màu sắc</label> <span style="color: red;">(*)</span>
                        <input class="form-control" name="colors" placeholder="Nhập giá sản phẩm" />
                    </div>

                    <div class="form-group">
                        <label>Số lượng</label> <span style="color: red;">(*)</span>
                        <input class="form-control" name="qty" placeholder="Nhập giá sản phẩm" />
                    </div>

                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="content" class="form-control ckeditor" rows="3" id="demo" ></textarea>
                    </div>

                    <div class="form-group">
                        <label>Miêu tả</label>
                        <textarea name="description" class="form-control ckeditor" rows="5" id="demo" ></textarea>
                    </div>

                    <div class="form-group">
                        <label>Sản phẩm mới</label>
                        <label class="radio-inline">
                            <input name="is_new" value="1" checked="" type="radio">Đúng
                        </label>
                        <label class="radio-inline">
                            <input name="is_new" value="0" type="radio">Sai
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Sản phẩm giảm giá</label>
                        <label class="radio-inline">
                            <input name="is_sale" value="1" checked="" type="radio">Đúng
                        </label>
                        <label class="radio-inline">
                            <input name="is_sale" value="0" type="radio">Sai
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Sản phẩm bán chạy</label>
                        <label class="radio-inline">
                            <input name="is_featured" value="1" checked="" type="radio">Đúng
                        </label>
                        <label class="radio-inline">
                            <input name="is_featured" value="0" type="radio">Sai
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Trạng thái</label>
                        <label class="radio-inline">
                            <input name="status" value="1" checked="" type="radio">Kích hoạt
                        </label>
                        <label class="radio-inline">
                            <input name="status" value="0" type="radio">Vô hiệu
                        </label>
                    </div>

                    <button type="submit" class="btn btn-default">Thêm</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection