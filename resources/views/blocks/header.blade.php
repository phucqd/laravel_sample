	<div id="header">
		<div class="header-top">
			<div class="container">
				<div class="pull-left auto-width-left">
					<ul class="top-menu menu-beta l-inline">
						<li><a href=""><i class="fa fa-home"></i> Quảng Minh, Quảng Trạch, Quảng Bình</a></li>
						<li><a href=""><i class="fa fa-phone"></i> 0965 296 242</a></li>
					</ul>
				</div>
				<div class="pull-right auto-width-right">
					<ul class="top-details menu-beta l-inline">
						@if(Auth::check())
							<li><a href="{!! URL::route('getUserProfile') !!}"><i class="fa fa-user"></i>{!! Auth::user()->full_name !!}</a></li>
							<li><a href="{!! url('user/logout') !!}">Đăng xuất</a></li>
						@else
							<li><a href="{!! url('user/register') !!}">Đăng kí</a></li>
							<li><a href="{!! url('user/login') !!}">Đăng nhập</a></li>
						@endif
					</ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-top -->
		<div class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="{!! url('/') !!}" id="logo"><img src="{!! url('source/assets/dest/images/logo-cake.png') !!}" width="200px" alt=""></a>
				</div>
				<div class="pull-right beta-components space-left ov">
					<div class="space10">&nbsp;</div>
					<div class="beta-comp">
						<form role="search" method="get" id="searchform">
							<input type="hidden" name="_token" value="{!! csrf_token() !!}" id="search_token">
							<input type="text" class="form-control dropdown" data-toggle="dropdown" name="search_item" id="search_item" placeholder="Nhập từ khóa..." />
							<ul class="col-xs-12 col-md-12 dropdown-menu dropdown-menu dropdown-menu-center" id="search_result_show" role="menu">
                             <li id="markToAdd" class="dropdown-header">Kết quả tìm kiếm</li>
                             <li class="divider"></li>
                           </ul>
							<button class="fa fa-search" type="submit" id="searchsubmit"></button>
						</form>
					</div>

					<div class="beta-comp">
						<div class="cart">
						<a href="{!! url('cart/viewcart') !!}"><i class="fa fa-shopping-cart fa-2x"></i> Giỏ hàng (<span id="show_sl">{!! $itemInCart !!}</span>)</a>
						</div> <!-- .cart -->
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
						<li><a href="{!! URL::route('getIndexPage') !!}">Trang chủ</a></li>
						<li><a >Sản phẩm</a>
							<ul class="sub-menu">
								<?php
									$product_types = DB::table('type_products')->select('id','name')->get();
								?>
								@foreach($product_types as $type)
								<li><a href="{!! URL::route('getLoaiSanPhamPage',[$type->id]) !!}">{!! $type->name !!}</a></li>
								@endforeach
							</ul>
						</li>
						<li><a href="{!! URL::route('getGioiThieuPage') !!}">Giới thiệu</a></li>
						<li><a href="{!! URL::route('getLienHePage') !!}">Liên hệ</a></li>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->
	</div>