@extends('admin.layout.index')
@section('title')
 Smarshop - Admin | Admin Create
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Người quản lý
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
                <form action="admin/user/create" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    
                    <div class="form-group">
                        <label>Tên đầy đủ</label> <span style="color: red;">(*)</span>
                        <input class="form-control" name="fullname" placeholder="Hãy nhập tên đầy đủ" />
                    </div>
                    <div class="form-group">
                        <label>Email</label> <span style="color: red;">(*)</span>
                        <input class="form-control" name="email" placeholder="Hãy nhập Email" />
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label><span style="color: red;">(*)</span>
                        <input class="form-control" name="phone" placeholder="Hãy nhập số điện thoại" />
                    </div>

                    <div class="form-group">
                        <label>Địa chỉ</label> <span style="color: red;">(*)</span>
                        <input class="form-control" name="address" placeholder="Hãy nhập địa chỉ" />
                    </div>

                    <div class="form-group">
                        <label>Mật khẩu</label><span style="color: red;">(*)</span>
                        <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" />
                    </div>

                    <div class="form-group">
                        <label>Nhập lại Mật khẩu</label><span style="color: red;">(*)</span>
                        <input type="password" class="form-control" name="passwordAgain" placeholder="Nhập lại mật khẩu" />
                    </div>

                    <div class="form-group">
                        <label>Hình ảnh</label><span style="color: red;">(*)</span>
                        <input type="file" name="image" >
                    </div>

                    <div class="form-group">
                        <label>Chức vụ</label>
                        <label class="radio-inline">
                            <input name="role" value="1" checked="" type="radio">Quản lý
                        </label>
                        <label class="radio-inline">
                            <input name="role" value="0" type="radio">Nhân viên
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