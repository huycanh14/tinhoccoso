@extends('admin.layout.index')
@section('title')
Smarshop - Admin | Product Update
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sản phẩm
                    <small>{{$product->name}}</small>
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
                <form action="admin/product/update/{{$product->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="form-group">
                        <label>Tên sản phẩm</label> <span style="color: red;">(*)</span>
                        <input class="form-control" name="name" placeholder="Nhập tên sản phẩm" value="{{$product->name}}" />
                    </div>

                    <div class="form-group">
                        <label>Thư mục sản phẩm</label> <span style="color: red;">(*)</span>
                        <select class="form-control" name="product_category_id" >
                            @foreach ($product_categories as $item)
                                <option 
                                @if ($product->product_category_id == $item->id)
                                    {{"selected"}}
                                @endif
                                value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Thương hiệu</label> <span style="color: red;">(*)</span>
                        <select class="form-control" name="brand_id">
                            @foreach ($brands as $item)
                                <option 
                                @if ($product->brand_id == $item->id)
                                    {{"selected"}}
                                @endif
                                 value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        @if ($product->img != "")
                            <p>
                                <img src="{{$product->img}}" alt="" width="400px">
                            </p>
                        @endif
                        <input type="file" name="image" >
                    </div>

                    <div class="form-group">
                        <label>Giá sản phẩm</label> <span style="color: red;">(*)</span>
                        <input class="form-control" name="price" placeholder="Nhập giá sản phẩm" value="{{$product->price}}" />
                    </div>

                    <div class="form-group">
                        <label>Màu sắc</label> <span style="color: red;">(*)</span>
                        <input class="form-control" name="colors" placeholder="Nhập giá sản phẩm" value="{{$product->colors}}" />
                    </div>

                    <div class="form-group">
                        <label>Số lượng</label> <span style="color: red;">(*)</span>
                        <input class="form-control" name="qty" placeholder="Nhập giá sản phẩm" value="{{number_format($product->qty)}}"/>
                    </div>

                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="content" class="form-control ckeditor" rows="3" id="demo" >{!!$product->content!!}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Miêu tả</label>
                        <textarea name="description" class="form-control ckeditor" rows="5" id="demo" >{!!$product->description!!}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Sản phẩm mới</label>
                        <label class="radio-inline">
                            <input @if ($product->is_new == 1)
                                {{"checked"}}
                            @endif name="is_new" value="1" checked="" type="radio">Đúng
                        </label>
                        <label class="radio-inline">
                            <input @if ($product->is_new == 0)
                                {{"checked"}}
                            @endif name="is_new" value="0" type="radio">Sai
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Sản phẩm giảm giá</label>
                        <label class="radio-inline">
                            <input @if ($product->is_sale == 1)
                                {{"checked"}}
                            @endif name="is_sale" value="1" checked="" type="radio">Đúng
                        </label>
                        <label class="radio-inline">
                            <input @if ($product->is_sale == 0)
                                {{"checked"}}
                            @endif name="is_sale" value="0" type="radio">Sai
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Sản phẩm bán chạy</label>
                        <label class="radio-inline">
                            <input @if ($product->is_featured == 1)
                                {{"checked"}}
                            @endif name="is_featured" value="1" checked="" type="radio">Đúng
                        </label>
                        <label class="radio-inline">
                            <input @if ($product->is_featured == 0)
                                {{"checked"}}
                            @endif name="is_featured" value="0" type="radio">Sai
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Trạng thái</label>
                        <label class="radio-inline">
                            <input @if ($product->status == 1)
                                {{"checked"}}
                            @endif name="status" value="1" checked="" type="radio">Kích hoạt
                        </label>
                        <label class="radio-inline">
                            <input @if ($product->status == 0)
                                {{"checked"}}
                            @endif name="status" value="0" type="radio">Vô hiệu
                        </label>
                    </div>

                    <button type="submit" class="btn btn-default">Sửa</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection