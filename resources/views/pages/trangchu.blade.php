@extends('layout.index')
@section('title')
	Smarshop - Trang chủ
@endsection
@section('content')
<div class="fullwidthbanner-container">
	<div class="fullwidthbanner">
		<div class="bannercontainer" >
			<div class="banner" >
				<ul>
					<!-- THE FIRST SLIDE -->
					@foreach ($banner as $item)
					<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
						<div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
							<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="img/banner/{{$item->img}}" data-src="img/banner/{{$item->img}}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('img/banner/{{$item->img}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
							</div>
						</div>

					</li>
					@endforeach

				</ul>
			</div>
		</div>

		<div class="tp-bannertimer"></div>	
	</div>
	<!--slider-->
</div>
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="beta-products-list">
						<h4>Sản phẩm mới</h4>
						<div class="beta-products-details">
							{{-- <p class="pull-left">438 styles found</p> --}}
							<div class="clearfix"></div>
						</div>

						<div class="row">
							@foreach ($product_new as $item)
								
								<div class="col-sm-3">
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
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="chi-tiet-san-pham/{{$item->id}}/{{$item->slug}}">Details <i class="fa fa-chevron-right"></i></a>
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
						<h4>Sản phẩm khuyến mại</h4>
						<div class="beta-products-details">
							{{-- <p class="pull-left">438 styles found</p> --}}
							<div class="clearfix"></div>
						</div>
						<div class="row">
							@foreach ($product_sale as $item)
								<div class="col-sm-3">
									<div class="single-item">
										<div class="ribbon-wrapper" style="z-index: 1"><div class="ribbon sale">Sale</div></div>

										<div class="single-item-header">
											<a href="chi-tiet-san-pham/{{$item->id}}/{{$item->slug}}"><img src="{{$item->img}}" alt="" height="250px"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title" style="height: 50px;">{{$item->name}}</p>
											<p class="single-item-price">
												<span class="flash-del" >{{number_format($item->price * 1.2)}}</span>
												<span class="flash-sale">{{number_format($item->price)}} VNĐ</span>
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="chi-tiet-san-pham/{{$item->id}}/{{$item->slug}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							@endforeach
							
						</div>
						<div class="space40">&nbsp;</div>
					</div> <!-- .beta-products-list -->
				</div>
			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->
</div>
@endsection
