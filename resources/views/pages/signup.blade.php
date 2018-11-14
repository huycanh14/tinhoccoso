@extends('layout.index')
@section('title')
	Smarshop - Đăng ký
@endsection

@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Đăng kí</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="index.html">Home</a> / <span>Đăng kí</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
        <div class="row">
        	<div class="col-sm-3"></div>
			<div class="col-sm-6">
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
        </div>
		<form action="{{ route('customer_signup') }}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<h4>Đăng kí</h4>
					<div class="space20">&nbsp;</div>

					<div class="form-block">
						<label for="email">Địa chỉ Email*</label>
						<input type="email" id="email" name="email" value="" required>
					</div>

					<div class="form-block">
						<label for="your_last_name">Họ và tên*</label>
						<input type="text" id="your_last_name" name="fullname" value="" required>
					</div>

					<div class="form-block">
						<label>Giới tính </label>
						<input  type="radio" class="input-radio" name="gender" value="1" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
						<input  type="radio" class="input-radio" name="gender" value="0" style="width: 10%"><span>Nữ</span>
									
					</div>

					<div class="form-block">
						<label for="adress">Địa chỉ*</label>
						<input type="text" id="adress" value="" name="address" required>
					</div>
					
					<div class="form-block">
						<label for="adress">Tỉnh/Thành phố*</label>
						<select name="province_id" id="Province" class="Province">
							@foreach ($provinces as $item)
								<option value="{{$item->id}}">{{$item->name}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-block">
						<label for="adress">Quận/Huyện*</label>
						<select value="" name="district_id" id="District">
						</select>
					</div>

					<div class="form-block">
						<label for="phone">Số điện thoại*</label>
						<input type="text" id="phone" name="phone" value="" required>
					</div>
					<div class="form-block">
						<label for="phone">Mật khẩu*</label>
						<input type="password" id="password" value="" name="password" required>
					</div>
					<div class="form-block">
						<label for="phone">Nhập lại Mật khẩu*</label>
						<input type="password" id="passwordAgain" value="" name="passwordAgain" required>
					</div>
					<div class="form-block">
						<button type="submit" class="btn btn-primary">Đăng ký</button>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->
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