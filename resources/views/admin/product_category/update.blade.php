@extends('admin.layout.index')
@section('title')
Smarshop - Admin | Product Category update
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh mục sản phẩm
                    <small>{{$product_category->name}}</small>
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
                <form action="admin/product-category/update/{{$product_category->id}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>Tên danh mục</label> <span style="color: red;">(*)</span>
                        <input class="form-control" name="name" placeholder="Hãy nhập tên danh mục sản phẩm" value="{{$product_category->name}}" />
                    </div>
                    <div class="form-group">
                        <label>Miêu tả</label>
                        <input class="form-control" name="description" placeholder="Nhập tên miêu tả sản phẩm" value="{{$product_category->description}}" />
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <label class="radio-inline">
                            <input name="status" value="1" @if ($product_category->status == 1)
                                {{"checked"}}
                            @endif checked="" type="radio">Kích hoạt
                        </label>
                        <label class="radio-inline">
                            <input name="status" @if ($product_category->status == 0)
                                {{"checked"}}
                            @endif value="0" type="radio">Vô hiệu
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