@extends('layout.index')
@section('title')
	Smarshop - Chi tiết sản phẩm: {{$product->name}}
@endsection

@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Sản phẩm: {{$product->name}}</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{{ route('index') }}">Home</a> / <span>Sản phẩm: {{$product->name}}</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		<div class="row">
			<div class="col-sm-9">

				<div class="row">
					<div class="col-sm-4">
						<img src="{{$product->img}}" alt="">
					</div>
					<div class="col-sm-8">
						<div class="single-item-body">
							<p class="single-item-title">{{$product->name}}</p>
							<p class="single-item-price">
								<span>{{number_format($product->price)}} VNĐ</span>
							</p>
						</div>

						<div class="clearfix"></div>
						<div class="space20">&nbsp;</div>

						<div class="single-item-desc">
							{!!$product->content!!}
						</div>
						<div class="space20">&nbsp;</div>

						<p>Options:</p>
						<div class="single-item-options">
							{{-- <select class="wc-select" name="size">
								<option>Size</option>
								<option value="XS">XS</option>
								<option value="S">S</option>
								<option value="M">M</option>
								<option value="L">L</option>
								<option value="XL">XL</option>
							</select> --}}
							
							<select class="wc-select" name="color">
								<option>Color</option>
								@php
									$color = explode(',', $product->colors);
								@endphp
								@foreach ($color as $item)
									<option value="{{$item}}" style="text-transform: uppercase;">{{$item}}</option>
								@endforeach
							</select>
							<select class="wc-select" name="color">
								<option>Qty</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
							<a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i></a>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="space40">&nbsp;</div>
				<div class="woocommerce-tabs">
					<ul class="tabs">
						<li><a href="#tab-description">Description</a></li>
						<li><a href="#tab-reviews">Reviews</a></li>
					</ul>

					<div class="panel" id="tab-description">
						{!!$product->description!!}
					</div>
					<div class="panel" id="tab-reviews">
						@if (count($product_review) != 0)
							@foreach ($product_review as $item)
								<div class="row">
									<div class="col-md-3">
										<b>{{$item->customer_name}}</b>
									</div>
									<div class="col-md-9"><i>Thời gian: {{date_format($item->updated_at, "d/m/Y")}}</i></div>

								</div>
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-10"><p>{{$item->content}} </p></div>
									
								</div>
								<hr>
							@endforeach
							<div class="row">{{$product_review->links()}}</div>
						@else
							<p>No Reviews</p>
						@endif
						
					</div>
				</div>
				<div class="space50">&nbsp;</div>
				<div class="beta-products-list">
					<h4>Sản phẩm liên quan</h4>

					<div class="row">
						@foreach ($product_relate as $item)
							<div class="col-sm-4">
								<div class="single-item">
									@if ($item->is_sale == 1)
										<div class="ribbon-wrapper" style="z-index: 1"><div class="ribbon sale">Sale</div></div>
									@endif
									<div class="single-item-header">
										<a href="chi-tiet-san-pham/{{$item->id}}/{{$item->slug}}"><img src="{{$item->img}}" alt="" height="250px"></a>
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
										<a class="add-to-cart pull-left" href="#"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="chi-tiet-san-pham/{{$item->id}}/{{$item->slug}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div> <!-- .beta-products-list -->
			</div>
			<div class="col-sm-3 aside">
				<div class="widget">
					<h3 class="widget-title">Sản phẩm bán chạy</h3>
					<div class="widget-body">
						<div class="beta-sales beta-lists">
							@foreach ($product_best_sellers as $item)
								<div class="media beta-sales-item">
									<a class="pull-left" href="chi-tiet-san-pham/{{$item->id}}/{{$item->slug}}"><img src="{{$item->img}}" alt="" height="100"></a>
									<div class="media-body">
										<p>{{$item->name}}</p>
										<span class="beta-sales-price">{{number_format($item->price)}} VNĐ</span>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div> <!-- best sellers widget -->
				<div class="widget">
					<h3 class="widget-title">Sản phẩm mới</h3>
					<div class="widget-body">
						<div class="beta-sales beta-lists">
							@foreach ($product_new as $item)
								<div class="media beta-sales-item">
									<a class="pull-left" href="chi-tiet-san-pham/{{$item->id}}/{{$item->slug}}"><img src="{{$item->img}}" alt="" height="100"></a>
									<div class="media-body">
										<p>{{$item->name}}</p>
										<span class="beta-sales-price">{{number_format($item->price)}} VNĐ</span>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div> <!-- best sellers widget -->
			</div>
		</div>
	</div> <!-- #content -->
</div>
@endsection