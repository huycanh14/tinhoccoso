@extends('layout.index')
@section('title')
	Smarshop - Tìm kiếm {{$search}}
@endsection
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Tìm kiếm: {{$search}}</h6> 
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{{ route('index') }}">Home</a> / <span>Tìm kiếm</span>
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
				<div class="col-sm-12">
					<div class="beta-products-list">
						<h4>Sản phẩm</h4>
						<div class="beta-products-Chi tiết">
							{{-- <p class="pull-left">438 styles found</p> --}}
							<div class="clearfix"></div>
						</div>

						<div class="row">
							@foreach ($products as $item)
								
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
											<a class="add-to-cart pull-left" href="add-to-cart/{{$item->id}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="chi-tiet-san-pham/{{$item->id}}/{{$item->slug}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							@endforeach
						</div>
						{{-- <div class="row">{{$products->appends(['tukhoa' => $search])->links()}}</div> --}}
						<div class="row"> {{ $products->appends(Request::all())->links() }}</div>
					</div> <!-- .beta-products-list -->

					<div class="space50">&nbsp;</div>
				</div>
			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->
</div>
@endsection