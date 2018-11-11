<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                {{-- <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a> --}}
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Danh mục sản phẩm<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('product_category_index') }}">Danh sách danh mục</a>
                    </li>
                    <li>
                        <a href="{{ route('product_category_create') }}">Thêm danh mục</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Thương hiệu sản phẩm<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('brand_index') }}">Danh sách thương hiệu</a>
                    </li>
                    <li>
                        <a href="{{ route('brand_create') }}">Thêm thương hiệu</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-cube fa-fw"></i> Sản phẩm<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('product_index') }}">Danh sách sản phẩm</a>
                    </li>
                    <li>
                        <a href="{{ route('product_create') }}">Thêm sản phẩm</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-cube fa-fw"></i> Đơn hàng<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('order_new_index') }}">Đơn hàng mới</a>
                    </li>
                    <li>
                        <a href="{{ route('order_old_index') }}">Đơn hàng cũ</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-users fa-fw"></i> Khách hàng<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('customer_index') }}">Danh sách</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">List User</a>
                    </li>
                    <li>
                        <a href="#">Add User</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>