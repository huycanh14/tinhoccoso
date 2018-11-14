@extends('layout.index')
@section('title')
	Smarshop - Đặt hàng
@endsection

@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Đặt hàng</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="index.html">Trang chủ</a> / <span>Đặt hàng</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		<form action="{{ route('checkout') }}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="col-sm-6">
					<h4>Đặt hàng</h4>
					<div class="space20">&nbsp;</div>

					<div class="">
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
					</div>

					<div class="form-block">
						<label for="name">Họ tên*</label>
						<input type="text" name="fullname" id="name" placeholder="Họ tên" value="@if (Session::has('user')){{Session('user')->fullname}} @endif" required>
					</div>
					{{-- <div class="form-block">
						<label>Giới tính </label>
						<input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
						<input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>
									
					</div> --}}

					<div class="form-block">
						<label for="email">Email*</label>
						<input type="email" name="email" id="email" required placeholder="expample@gmail.com" value="
						@if (Session::has('user'))
							{{Session('user')->email}}
						@endif">
					</div>

					<div class="form-block">
						<label for="adress">Tỉnh/Thành phố*</label>
						<select name="province_id" id="Province" class="Province">
							@if (Session::has('user'))
								<option value="{{Session('user')->province_id}}">{{Session('user')->province->name}}</option>
							@endif
							@foreach ($provinces as $item)
								<option value="{{$item->id}}" 
									@if (Session::has('user') && Session('user')->province_id == $item->id)
										{{"selected"}}
									@endif>
								{{$item->name}}
								</option>
							@endforeach
						</select>
					</div>

					<div class="form-block">
						<label for="adress">Quận/Huyện*</label>
						<select value="" name="district_id" id="District">
						</select>
					</div>
					
					<div class="form-block">
						<label for="adress">Địa chỉ*</label>
						<input type="text" name="address" id="adress" placeholder="Street Address"  
						value="@if (Session::has('user')){{Session('user')->address}}@endif" required>
					</div>

					<div class="form-block">
						<label for="phone">Điện thoại*</label>
						<input type="text" name="phone" id="phone" required value="@if (Session::has('user')){{Session('user')->phone}}@endif">
					</div>
					
					<div class="form-block">
						<label for="notes">Ghi chú</label>
						<textarea id="notes" name="note"></textarea>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="your-order">
						<div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
						<div class="your-order-body" style="padding: 0px 10px">
							@if (Session::has('cart'))
								@foreach ($product_cart as $product)
									<div class="your-order-item">
										<div>
										<!--  one item	 -->
											<div class="media">
												<img width="25%" src="{{$product['product_image']['img']}}" alt="" class="pull-left">
												<div class="media-body">
													<p class="font-large">{{$product['item']['name']}}</p>
													<span class="color-gray your-order-info">Đơn giá: {{number_format($product['item']['price'])}} VNĐ</span>
													<span class="color-gray your-order-info">Số lượng: {{$product['qty']}}</span>
												</div>
											</div>
										<!-- end one item -->
										</div>
										<div class="clearfix"></div>
									</div>
								@endforeach
							@else
								<div class="your-order-item">
										<div>
										<!--  one item	 -->
											<div class="media">
												<h3>Đơn hàng đang trống</h3>
											</div>
										<!-- end one item -->
										</div>
										<div class="clearfix"></div>
									</div>
							@endif
							<div class="your-order-item">
								<div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
								<div class="pull-right"><h5 class="color-black">@if (Session::has('cart'))
									{{number_format(Session('cart')->totalPrice)}}
									@else 0
									@endif VNĐ</h5></div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
						
						<div class="your-order-body">
							<ul class="payment_methods methods">
								<li class="payment_method_bacs">
									<input id="payment_method_bacs" type="radio" class="input-radio" name="payment" value="COD" checked="checked" data-order_button_text="">
									<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
									<div class="payment_box payment_method_bacs" style="display: block;">
										Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
									</div>						
								</li>

								<li class="payment_method_cheque">
									<input id="payment_method_cheque" type="radio" class="input-radio" name="payment" value="ATM" data-order_button_text="">
									<label for="payment_method_cheque">Chuyển khoản </label>
									<div class="payment_box payment_method_cheque" style="display: none;">
										Chuyển tiền đến tài khoản sau:
										<br>- Số tài khoản: 123 456 789
										<br>- Chủ TK: Nguyễn A
										<br>- Ngân hàng ACB, Chi nhánh TPHCM
									</div>						
								</li>
								
							</ul>
						</div>

						<div class="text-center"><input type="submit" class="beta-btn primary" value="Đặt hàng"></div>
					</div> <!-- .your-order -->
				</div>
			</div>
		</form>
	</div> <!-- #content -->
</div>
@endsection

@section('script')
	<script>
		$(document).ready(function($) {
			var province_id = $("#Province").val();
			$.get("ajax/districts/" + province_id, function(data){
				$("#District").html(data);
			});
			$('#Province').change(function(event) {
				province_id = $("#Province").val();
				$.get("ajax/districts/" + province_id, function(data){
					$("#District").html(data);
				});
			});
		});
	</script>
@endsection