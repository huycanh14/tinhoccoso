@extends('admin.layout.index')
@section('title')
Smarshop - Admin | Brand Update
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thương hiệu
                    <small>Sửa</small>
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
                 <form action="admin/brand/update/{{$brand->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                    <div class="form-group">
                        <label>Tên thương hiệu</label>
                        <input class="form-control" name="name" placeholder=" Nhập tên thương hiệu" value="{{$brand->name}}" />
                    </div>

                    <div class="form-group">
                        <label>Miêu tả</label>
                        <input class="form-control" name="description" placeholder="Miêu tả thương hiệu" value="{{$brand->description}}"/>
                    </div>

                    <div class="form-group">
                        <label>Hình ảnh</label>
                        @if ($brand->image !="")
                            <p>
                                <img width="400px" src="img/brands/{{$brand->image}}" alt="">
                            </p>
                        @endif
                        
                        <input type="file" name="image" >
                    </div>

                    <div class="form-group">
                        <label>Trạng thái</label>
                        <label class="radio-inline">
                            <input name="status" value="1" @if ($brand->status == 1)
                                {{"checked"}}
                            @endif checked="" type="radio">Kích hoạt
                        </label>
                        <label class="radio-inline">
                            <input name="status" @if ($brand->status == 0)
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