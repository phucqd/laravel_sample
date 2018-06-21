@extends('master')
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Đăng nhập</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="{!! url('user/logout') !!}">Home</a> / <span>Đăng nhập</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		
		<form action="{!! url('/user/login') !!}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					@if(Session::has('messages'))
						<div class="alert alert-{!! Session::get('level') !!}">
							{!! Session::get('messages') !!}
							<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						</div>
					@endif
					<h4>Đăng nhập</h4>
					<div class="space20">&nbsp;</div>

					
					<div class="form-block">
						<label for="email">Email address*</label>
						<input type="email" id="email" name="txtemail" value="{!! old('txtemail') !!}" required>
					</div>
					<div class="form-block">
						<label for="phone">Password*</label>
						<input type="password" id="phone" name="xtxPassword" value="{!! old('xtxPassword') !!}" required>
					</div>
					<div class="form-block">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->
@stop