@extends('admin.layout.index')
@section('title')
    Smarshop - Admin | Product Review - {{$product->name}}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{$product->name}}
                    <small>Bình luận</small>
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
                <form action="admin/product_review/update/{{$product->id}}/{{$product_review->id}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="form-group">
                        <div class="row">
                            <div class="col col-md-3"><b>Tên khách hàng</b></div>
                            <div class="col col-md-9">{{$product_review->fullname}}</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col col-md-3"><b>Email</b></div>
                            <div class="col col-md-9">{{$product_review->email}}</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col col-md-3"><b>Số điện thoại</b></div>
                            <div class="col col-md-9">{{$product_review->phone}}</div>
                        </div>
                    </div>

                     <div class="form-group">
                        <div class="row">
                            <div class="col col-md-3"><b>Đánh giá</b></div>
                            <div class="col col-md-9">
                                @for ($i = 0; $i < $product_review->rate ; $i++)
                                    <i class="fa fa-star" style="color: #c8c208;"></i>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col col-md-3"><b>Thời gian</b></div>
                            <div class="col col-md-9">{{date_format($product_review->updated_at, "d/m/Y")}}</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nội dung</label>
                        <input class="form-control" name="content" placeholder="" value="{{$product_review->content}}" />
                    </div>

                    <div class="form-group">
                        <label>Trạng thái</label>
                        <label class="radio-inline">
                            <input @if ($product_review->status == 1)
                                {{"checked"}}
                            @endif name="status" value="1" checked="" type="radio">Kích hoạt
                        </label>
                        <label class="radio-inline">
                            <input @if ($product_review->status == 0)
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