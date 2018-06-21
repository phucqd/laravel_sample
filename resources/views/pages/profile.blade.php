@extends('master')
@section('content')
	<div class="container-fluid ">
		<div id="profile_pages">
			<div class="col-md-4 left_profile">
				<div class="col-md-12">
					<div class="col-md-12">
						<div  align="left"> <img alt="User Pic" src="{!! url('source/image/user/'.$user_infor->avata) !!}" id="profile-image1" class="img-circle img-responsive" > 
                			<form action="{!! URL::route('postChangeAvata') !!}" method="post" enctype="multipart/form-data">
                				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
                				<input id="profile-image-upload" name="profile-image-upload" class="hidden" type="file">
                				<button type="submit" style="display: none" id="submit_change_avata"></button>
                			</form>
							<div style="color:#999;" >click here to change profile image</div>
                     	</div>
					</div>
					<div class="col-md-12">
						<b>Họ tên:  {!! $user_infor->full_name !!}</b>
					</div>
					<div class="col-md-12">
						<b>Địa chỉ: {!! $user_infor->address !!}</b>
					</div>
					<div class="col-md-12">
						<b>SĐT:  {!! $user_infor->phone !!}</b>
					</div>
					<div class="col-md-12">
						<b>email : {!! $user_infor->email !!}</b>
					</div>
					@if(Auth::user()->user_rights == 0)
						<div class="col-md-12 row">
							<a class="btn btn-link" href="{!! URL::route('getAdminPanel') !!}">Đi đến trang quản trị</a>
						</div>
					@endif
				</div>
				<div class="col-md-12">
					
				</div>
			</div>
			<!---------------------------------------------->
			@if(count($errors) > 0 )
				<div class="col-md-8"> 
					@foreach($errors->all() as $error)
					<div class="alert alert-danger">
						{!! $error !!}
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					</div>
					@endforeach
				</div>
			@endif
			@if(Session::has('flashMessages'))
				<div class="col-md-8 alert alert-{!! Session::get('level') !!}">
						{!! Session::get('flashMessages') !!}
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				</div>
			@endif
			<!---------------------------------------------->
			<div class="col-md-8 row">
				  <ul class="nav nav-tabs">
				    <li class="active"><a data-toggle="tab" href="#home">Lịch sửa mua hàng</a></li>
				    <li><a data-toggle="tab" href="#menu1">Chỉnh sửa trang cá nhân</a></li>
				    <li><a data-toggle="tab" href="#menu2">Đổi mật khẩu</a></li>
				  </ul>
				  <div class="tab-content">
				    <div id="home" class="tab-pane fade in active">
				      	<div class="col-md-12" id="hienThiDonHang">
							 @foreach($order_today as $bill_today)
							 <div class="container-fluid donHang" id="bill{!! $bill_today->id !!}">
								<div class="col-md-4">
					        		{!! getProductName($bill_today) !!}
					        	</div>
					        	<div class="col-md-3">
								   	Tổng thanh toán {!! number_format($bill_today->total) !!}.vnđ <br/>
								   	
						        </div>
						        <div class="col-md-5">
						        	Ngày đặt hàng : {!! $bill_today->created_at !!}<br/>
								   	Trạng thái: {!! $bill_today->status !!}
						        </div>
						     </div>
							 @endforeach
   	  	 				</div>
					</div>
					<div id="menu1" class="tab-pane fade">
				      	<div class="col-md-12 row">
							<form action="{!! URL::route('postEditUser') !!}" method="post" class="beta-form-checkout">
								<input type="hidden" name="_token" value="{!! csrf_token() !!}">
								<div class="row">
										<div class="space20">&nbsp;</div>
										
										<div class="form-block">
											<label for="email">Email address*</label>
											<input type="email" id="email" name="edit_email" value="{!! old('edit_email',isset($user_infor->full_name) ? $user_infor->email : null) !!}" required>
										</div>

										<div class="form-block">
											<label for="your_last_name">Fullname*</label>
											<input type="text" id="your_last_name" name="edit_name" value="{!! old('edit_name',isset($user_infor->full_name) ? $user_infor->full_name : null) !!}" required>
										</div>

										<div class="form-block">
											<label for="adress">Address*</label>
											<input type="text" id="adress" name="edit_address" value="{!! old('edit_address',isset($user_infor->full_name) ? $user_infor->address : null) !!}" required>
										</div>
										<div class="form-block">
											<label for="phone">Phone*</label>
											<input type="text" id="phone" name="edit_phone" value="{!! old('edit_phone',isset($user_infor->full_name) ? $user_infor->phone : null) !!}" required>
										</div>
										<div class="form-block">
											<label for="phone">Password</label>
											<input type="password" id="" name="password" value="{!! old('password') !!}" required>
										</div>
										<div class="form-block">
											<button type="submit" class="btn btn-primary">Update</button>
										</div>
								</div>
							</form>
						</div>
				    </div>
				    <div id="menu2" class="tab-pane fade">
				    	<div class="space20">&nbsp;</div>
				    	<form action="{!! URL::route('postChangePassWord') !!}" method="post">
				    		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				    		<div class="row">
					    		<div class="form-block">
									<label for="phone">Mật khẩu hiện tại*</label>
									<input type="password" id="phone" name="current_pass" value="{!! old('current_pass') !!}" required>
								</div>
								<div class="form-block">
									<label for="phone">Mật khẩu mới*</label>
									<input type="password" id="phone" name="new_pass" value="{!! old('new_pass') !!}" required>
								</div>
								<div class="form-block">
									<label for="phone">Nhập lại mật khẩu mới*</label>
									<input type="password" id="phone" name="re_new_pass" value="{!! old('re_new_pass') !!}" required>
								</div>
								<div class="form-block">
									<button type="submit" class="btn btn-primary">Update Password</button>
								</div>
				    		</div>
				    	</form>
				    </div>
				   </div>
			</div>
			</div>
		</div>
	</div>
@stop