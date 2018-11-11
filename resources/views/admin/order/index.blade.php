@extends('admin.layout.index')
@section('title')
    @if (isset($orderNew))
       Smarshop - Admin | Order New Index
    @else
        Smarshop - Admin | Order Old Index
    @endif
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Đơn hàng @if (isset($orderNew)) mới @else cũ@endif
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{ session('thongbao') }}
                    </div>
                @endif
            </div>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Tổng tiền</th>
                        <th>Chi tiết</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$item->id}}</td>
                            <td>{{$item->fullname}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->address}} - {{$item->huyen}} - {{$item->tinh}}</td>
                            <td>{{$item->amount}} VNĐ</td>
                            {{-- <td>{{number_format($item->amount)}} VNĐ</td> --}}
                            @if (isset($orderNew))
                                <td class="center"><i class="fa fa-eye fa-fw"></i> <a href="admin/order_item/index/{{$item->id}}">View</a></td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return checkDelete();" href="admin/order_new/delete/{{$item->id}}"> Delete</a></td>
                            @endif
                            @if (isset($orderOld))
                                <td class="center"><i class="fa fa-eye fa-fw"></i> <a href="admin/order_item/index/{{$item->id}}">View</a></td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return checkDelete();" href="admin/order_old/delete/{{$item->id}}"> Delete</a></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection

@section('script')
    <script type="text/javascript">
    function checkDelete()
    {
        if (!confirm('Bạn chắc chắn muốn xóa ?')) {
            return false;
        }
    }
</script>
@endsection