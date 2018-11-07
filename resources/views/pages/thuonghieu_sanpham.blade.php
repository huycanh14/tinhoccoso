@extends('layout.index')
@section('title')
	Smarshop - Thương hiệu: {{$brand->name}}
@endsection
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Thương hiệu: {{$brand->name}}</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{{ route('index') }}">Home</a> / <span>Thương hiệu: {{$brand->name}}</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-3">
					<ul class="aside-menu">
 						@foreach ($brands as $item)
 							<li><a href="thuong-hieu-san-pham/{{ $item->id }}">{{$item->name}}</a></li>
 						@endforeach
					</ul>
				</div>
				<div class="col-sm-9">
					<div class="beta-products-list">
						<h4>Sản phẩm mới</h4>
						<div class="beta-products-details">
							{{-- <p class="pull-left">{{count($product_new)}} sản phẩm</p> --}}
							<div class="clearfix"></div>
						</div>

						<div class="row">
							@foreach ($product_new as $item)
							
							<div class="col-sm-4" >
								<div class="single-item" style="display: block; height: 400px;">
									@if ($item->is_sale == 1)
										<div class="ribbon-wrapper" style="z-index: 1"><div class="ribbon sale">Sale</div></div>
									@endif
									<div class="single-item-header">
										<a href="product.html"><img src="{{$item->img}}" alt="" height="250px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title" style="height: 50px;">{{$item->name}} VNĐ</p>
										<p class="single-item-price">
											@if ($item->is_sale == 1)
												<span class="flash-del" >{{number_format($item->price * 1.2)}}</span>
												<span class="flash-sale">{{number_format($item->price)}} VNĐ</span>
											@else
												<span >{{number_format($item->price)}} VNĐ</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>

							@endforeach
						</div>
						<div class="row">{{$product_new->links()}}</div>
					</div> <!-- .beta-products-list -->

					<div class="space50">&nbsp;</div>

					<div class="beta-products-list">
						<h4>Các sản phẩm</h4>
						<div class="beta-products-details">
							{{-- <p class="pull-left">{{count($products)}}</p> --}}
							<div class="clearfix"></div>
						</div>
						<div class="row">
							@foreach ($products as $item)
							<div class="col-sm-4">
								<div class="single-item" style="display: block; height: 400px;">
									@if ($item->is_sale == 1)
										<div class="ribbon-wrapper" style="z-index: 1"><div class="ribbon sale">Sale</div></div>
									@endif
									<div class="single-item-header">
										<a href="product.html"><img src="{{$item->img}}" alt="" height="250px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title" style="height: 50px;">{{$item->name}}</p>
										<p class="single-item-price">
											@if ($item->is_sale == 1)
												<span class="flash-del" >{{number_format($item->price * 1.2)}}</span>
												<span class="flash-sale">{{number_format($item->price)}} VNĐ</span>
											@else
												<span >{{number_format($item->price)}} VNĐ</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						<div class="row">{{$products->links()}}</div>
						<div class="space40">&nbsp;</div>

					</div> <!-- .beta-products-list -->
				</div>
			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection