@extends('admin.layout.index')
@section('title')
    Smarshop - Admin | Order Item Index - #{{$order->id}}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách đơn hàng
                    <small>#{{$order->id}}</small>
                </h1>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <div class="row">
                        <div class="col col-md-2"><b>Tên khách hàng</b></div>
                        <div class="col col-md-10">{{$order->fullname}}</div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col col-md-2"><b>Email</b></div>
                        <div class="col col-md-10">{{$order->email}}</div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col col-md-2"><b>Số điện thoại</b></div>
                        <div class="col col-md-10">{{$order->phone}}</div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col col-md-2"><b>Ngày đặt hàng</b></div>
                        <div class="col col-md-10">{{date_format($order->updated_at, "d/m/Y")}}</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col col-md-2"><b>Địa chỉ nhận hàng</b></div>
                        <div class="col col-md-10">{{$order->address}}, {{$order->province->name}}, {{$order->district->name}}</div>
                    </div>
                </div>
            <div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $stt = 1;
                        $amount = 0;
                    @endphp
                    @foreach ($order_item as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$stt}}</td>
                            <td>{{$item->product->name}}</td>
                            <td>{{$item->qty}}</td>
                            <td>{{number_format($item->price)}} VNĐ</td>
                            <td>{{number_format($item->qty * $item->price)}} VNĐ</td>
                        </tr>
                        @php
                            $stt++;
                            $amount += $item->qty * $item->price;
                        @endphp
                    @endforeach
                </tbody>
            </table>

            <div class="col-lg-12">
               <div class="form-group">
                    <div class="row">
                        <div class="col col-md-2"><b>Tổng số tiền:</b></div>
                        <div class="col col-md-10"><b>{{number_format($amount)}} VNĐ</b></div>
                        {{-- <div class="col col-md-10"><b>{{$amount}} VNĐ</b></div> --}}
                    </div>
                </div>
            </div>

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
                <form action="admin/order_item/index/{{$order->id}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="form-group">
                        <label>Đơn hàng</label>
                        <label class="radio-inline">
                            <input @if ($order->status == 1)
                                {{"checked"}}
                            @endif name="status" value="1" checked="" type="radio">Chưa giao
                        </label>
                        <label class="radio-inline">
                            <input @if ($order->status == 0)
                                {{"checked"}}
                            @endif name="status" value="0" type="radio">Đã giao
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Lưu</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection