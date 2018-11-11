@extends('admin.layout.index')
@section('title')
    Smarshop - Admin | Product Review - {{$product->name}}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Phản hồi sản phẩm - <i>{{$product->name}}</i>
                    <small>Danh sách</small>
                </h1>
            </div>
             <p>
                 <img src="{{$product_image->img}}" alt="" width="200px">
             </p>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>Tên khách hàng</th>
                        <th>Nội dung</th>
                        <th>Đánh giá</th>
                        <th>Trạng thái</th>
                        <th>Thời gian</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $stt = 1;
                    @endphp
                    @foreach ($product_reviews as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$stt}}</td>
                            <td>{{$item->fullname}}</td>
                            <td>{{$item->content}}</td>
                            <td>
                                @for ($i = 0; $i < $item->rate ; $i++)
                                    <i class="fa fa-star" style="color: #c8c208;"></i>
                                @endfor
                            </td>
                            <td>
                                @if ($item->status == 1)
                                    Kích hoạt
                                @else
                                    Vô hiệu
                                @endif
                            </td>
                            <td>{{date_format($item->updated_at, "d/m/Y")}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#" onclick="return checkDelete();"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/product_review/update/{{$product->id}}/{{$item->id}}">Edit</a></td>
                        </tr>
                        @php
                            $stt++;
                        @endphp
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