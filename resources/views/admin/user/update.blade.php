@extends('admin.layout.index')
@section('title')
 Smarshop - Admin | Admin Update
@endsection
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>{{$user->fullname}}</small>
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
                <form action="admin/user/update/{{$user->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="form-group">
                        <label>Họ Tên</label>
                        <input class="form-control" name="fullname" placeholder="Nhập tên người dùng" value="{{$user->fullname}}" />
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        @if ($user->img != "")
                            <p>
                                <img src="img/users/{{$user->img}}" alt="" width="200px">
                            </p>
                        @endif
                        <input type="file" name="image" >
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" readonly="readonly" placeholder="Nhập địa chỉ email" value="{{$user->email}}" />
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input class="form-control" name="phone" placeholder="Nhập tên người dùng" value="{{$user->phone}}" />
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input class="form-control" name="address" placeholder="Nhập tên người dùng" value="{{$user->address}}" />
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id='changePassword' name="changePassword">
                        <label>Đổi mật khẩu</label>
                        <input type="password" class="form-control password" name="password" disabled="" placeholder="Nhập mật khẩu" />
                    </div>

                    <div class="form-group">
                        <label>Nhập lại mật khẩu</label>
                        <input type="password" class="form-control password" name="passwordAgain" disabled="" placeholder="Nhập lại mật khẩu" />
                    </div>
                    
                    <div class="form-group">
                        <label>Chức vụ</label>
                        <label class="radio-inline">
                            <input name="role" value="1" 
                            @if ($user->role == 1)
                                 {{"checked"}}
                             @endif type="radio">Quản lý
                        </label>
                        <label class="radio-inline">
                            <input name="role" value="0"
                            @if ($user->role == 0)
                                 {{"checked"}}
                             @endif type="radio">Nhân viên
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Trạng thái</label>
                        <label class="radio-inline">
                            <input name="status" value="1" 
                            @if ($user->status == 1)
                                 {{"checked"}}
                             @endif type="radio">Kích hoạt
                        </label>
                        <label class="radio-inline">
                            <input name="status" value="0"
                            @if ($user->status == 0)
                                 {{"checked"}}
                             @endif type="radio">Vô hiệu
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
<!-- /#page-wrapper -->
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#changePassword').change(function(){
                if($(this).is(":checked"))
                {
                    $(".password").removeAttr('disabled');
                }
                else
                {
                    $(".password").attr('disabled', '');
                }
            });
        });
    </script>
@endsection