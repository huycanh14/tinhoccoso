<div id="header">
	<div class="header-top">
		<div class="container">
			<div class="pull-left auto-width-left">
				<ul class="top-menu menu-beta l-inline">
					<li><a href=""><i class="fa fa-home"></i> 123 Cổ Nhuế, Bắc Từ Liêm, Hà Nội</a></li>
					<li><a href=""><i class="fa fa-phone"></i> 0163 296 7751</a></li>
				</ul>
			</div>
			<div class="pull-right auto-width-right">
				<ul class="top-details menu-beta l-inline">
					@if (Session::has('user'))
						<li><a href="#"><i class="fa fa-user"></i>{{Session('user')->fullname}}</a></li>
						<li><a href="{{ route('customer_logout') }}"><i class="fa fa-sign-out fa-fw"></i>Đăng xuất</a></li>
					@else
						<li><a href="{{ route('customer_signup') }}">Đăng kí</a></li>
						<li><a href="{{ route('customer_login') }}">Đăng nhập</a></li>
					@endif
				</ul>
			</div>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .header-top -->
	<div class="header-body">
		<div class="container beta-relative">
			<div class="pull-left">
				<a href="{{ route('index') }}" id="logo"><img src="img/logo1.png" width="100px" alt=""></a>
			</div>
			<div class="pull-right beta-components space-left ov">
				<div class="space10">&nbsp;</div>
				<div class="beta-comp">
					<form role="search" method="get" id="searchform" action="{{ route('tim_kiem') }}">
						<input type="text" value="" name="search" id="s" placeholder="Nhập từ khóa..." />
						<button class="fa fa-search" type="submit" id="searchsubmit"></button>
					</form>
				</div>

				<div class="beta-comp">
					@if (Session::has('cart'))
						<div class="cart">
							<div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (@if(Session::has('cart')){{Session('cart')->totalQty}} @else Trống  @endif) <i class="fa fa-chevron-down"></i></div>
							<div class="beta-dropdown cart-body">
								
									@foreach ($product_cart as $product)
										<div class="cart-item">
											<a href="delete-cart/{{$product['item']['id']}}" class="cart-item-delete"><i class="fa fa-times"></i></a>
											<div class="media">
												<a class="pull-left" href="#"><img src="{{$product['product_image']['img']}}" alt=""></a>{{-- {{$product['item']['img']}} ưertyu
												{{$product['image']}} --}}
												<div class="media-body">
													<span class="cart-item-title">{{$product['item']['name']}}</span>
													{{-- <span class="cart-item-options">{{$product['item']['color']}}</span> --}}
													<span class="cart-item-amount">{{$product['qty']}} * <span>{{number_format($product['item']['price'])}} VNĐ</span></span>
												</div>
											</div>
										</div>
									@endforeach
								
									<div class="cart-caption">
										<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{number_format(Session('cart')->totalPrice)}} VNĐ</span></div>
										<div class="clearfix"></div>

										<div class="center">
											<div class="space10">&nbsp;</div>
											<a href="{{ route('checkout') }}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
										</div>
									</div>
								
							</div>
						</div> <!-- .cart -->
					@endif
				</div>
			</div>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .header-body -->
	<div class="header-bottom" style="background-color: #0277b8;">
		<div class="container">
			<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
			<div class="visible-xs clearfix"></div>
			<nav class="main-menu">
				<ul class="l-inline ov">
					<li><a href="{{ route('index') }}">Trang chủ</a></li>
					<li><a href="" class="none-click-product">Sản phẩm</a>
						<ul class="sub-menu">
							@foreach ($product_categories as $item)
								<li><a style="z-index: 10" href="loai-san-pham/{{$item->id}}">{{$item->name}} </a></li>
							@endforeach
						</ul>
					</li>
					<li><a href="#" class="none-click-product">Thương hiệu</a>
						<ul class="sub-menu">
							@foreach ($brands as $item)
								<li><a style="z-index: 10" href="thuong-hieu-san-pham/{{$item->id}}">{{$item->name}} </a></li>
							@endforeach
						</ul>
					</li>
					<li><a href="{{ route('about') }}">Giới thiệu</a></li>
					<li><a href="{{ route('contacts') }}">Liên hệ</a></li>
				</ul>
				<div class="clearfix"></div>
			</nav>
		</div> <!-- .container -->
	</div> <!-- .header-bottom -->
</div> 

