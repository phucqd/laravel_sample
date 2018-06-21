
@extends('master')
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Sản phẩm</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="index.html">Home</a> / <span>Sản phẩm</span>
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
						<?php
						$product_types = DB::table('type_products')->select('id','name')->get();
						?>
						@foreach($product_types as $type)
						<li><a href="{!! URL::route('getLoaiSanPhamPage',[$type->id]) !!}">{!! $type->name !!}</a></li>
						@endforeach
					</ul>
				</div>
				<div class="col-sm-9">
					<div class="beta-products-list">
						<h4>New Products</h4>
						<div class="beta-products-details">
							<div class="clearfix"></div>
						</div>

						<div class="row">
							@foreach($product_types_new as $product_new)
							<div class="col-sm-4">
								<div class="single-item">
									<div class="single-item-header">
										<a href="{!! URL::route('getProductPage',[$product_new->id]) !!}"><img src="{!! url('source//image/product/'.$product_new->image) !!}" alt="" height="250px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{!! $product_new->name !!}</p>
										<p class="single-item-price">
											<span>{!! number_format($product_new->unit_price) !!}.vnđ</span>
										</p>
									</div>
									<div class="single-item-caption">
										<button class="add-to-cart pull-left" value="{!! $product_new->id !!}" href=""><i class="fa fa-shopping-cart"></i></button>
										<a class="beta-btn primary" href="{!! URL::route('getProductPage',[$product_new->id]) !!}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div> <!-- .beta-products-list -->

					<div class="space50">&nbsp;</div>

					<div class="beta-products-list">
						<h4>Top Products</h4>
						<div class="beta-products-details">
							<div class="clearfix"></div>
						</div>
						<div class="row">
							@foreach($product_types_promo as $product_promo)
							<div class="col-sm-4">
								<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
								<div class="single-item">
									<div class="single-item-header">
										<a href="{!! URL::route('getProductPage',[$product_promo->id]) !!}"><img src="{!! url('source//image/product/'.$product_promo->image) !!}" alt="" height="250px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{!! $product_promo->name !!}</p>
										<p class="single-item-price">
											<span class="flash-del">{!! number_format($product_promo->unit_price) !!}.vnđ</span>
											<span class="flash-sale">{!! number_format($product_promo->promotion_price) !!}.vnđ</span>
										</p>
									</div>
									<div class="single-item-caption">
										<button class="add-to-cart pull-left" value="{!! $product_promo->id !!}" href=""><i class="fa fa-shopping-cart"></i></button>
										<a class="beta-btn primary" href="{!! URL::route('getProductPage',[$product_promo->id]) !!}">Details <i class="fa fa-chevron-right"></i></a>
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
</div> <!-- .container -->
@stop
