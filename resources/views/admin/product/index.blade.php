@extends('admin.layout.index')
@section('title')
Smarshop - Admin | Product Index
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
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
                        <th>Tên</th>
                        <th>Hình ảnh</th>
                        <th>Thư mục sản phẩm</th>
                        <th>Thương hiệu</th>
                        <th>Trạng thái</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                        <th>Đánh giá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        {{-- expr --}}
                    <tr class="odd gradeX" align="center">
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            @if ($item->img != "")
                                <img src="{{$item->img}}" width="100px;" alt="">
                            @endif
                        </td>
                        <td>
                            @for ($i = 0; $i < count($product_categories); $i++)
                                @if ($product_categories[$i]['id'] == $item->product_category_id)
                                    {{$product_categories[$i]->name}}
                                @endif
                            @endfor
                        </td>
                        <td>
                            @for ($i = 0; $i < count($brands); $i++)
                                @if ($brands[$i]['id'] == $item->brand_id)
                                    {{$brands[$i]->name}}
                                @endif
                            @endfor
                        </td>
                         <td>
                            @if ($item->status == 1)
                                Kích hoạt
                            @else
                                Vô hiệu
                            @endif
                        </td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return checkDelete();" href="admin/product/delete/{{$item->id}}"> Xóa</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/product/update/{{$item->id}}">Sửa</a></td>
                        <td class="center"><i class="fa fa-comments fa-fw"></i> <a href="admin/product_review/index/{{$item->id}}">Nhận xét</a></td>
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