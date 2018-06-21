@extends('master')
@section('content')
@include('blocks.slide')
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="beta-products-list">
						<h4>New Products</h4>
						<div class="beta-products-details">
							<div class="clearfix"></div>
						</div>

						<div class="row">
							@foreach($products as $item)
							<div class="col-sm-3">
								@if($item->promotion_price != 0)
								<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
								@endif
								<div class="single-item">
									<div class="single-item-header">
										<a href="{!! URL::route('getProductPage',[$item->id]) !!}"><img src="{!! url('source/image/product/'.$item->image) !!}" alt="" height="250px" /></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{!! $item->name !!}</p>
										<p class="single-item-price">
											@if($item->promotion_price != 0)
											<span class="flash-del">{!! number_format($item->unit_price) !!}.vnđ</span>
											<span class="flash-sale">{!! number_format($item->promotion_price) !!}.vnđ</span>
											@else
											<span>{!! $item->unit_price !!}.vnđ</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption">
										<button class="add-to-cart pull-left" value="{!! $item->id !!}" href=""><i class="fa fa-shopping-cart"></i></button>
										<a class="beta-btn primary" href="{!! URL::route('getProductPage',[$item->id]) !!}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
							<div class="col-sm-12">
								<ul class="pager">
									@if($products->currentPage() != 1 )
									<li class=""><a href="{!! $products->url($products->currentPage() - 1) !!}">Previous</a></li>
									@endif
									@for($i=1; $i<=$products->lastPage(); $i = $i + 1)
									<li class="{!! ($products->currentPage() == $i) ? 'active' : '' !!}"><a href="{!! $products->url($i) !!}">{!! $i !!}</a></li>
									@endfor
									@if($products->currentPage() != $products->lastPage() )
									<li class=""><a href="{!! $products->url($products->currentPage() + 1) !!}">Next</a></li>
									@endif
								</ul>
							</div>
						</div>
					</div> <!-- .beta-products-list -->

					<div class="space50">&nbsp;</div>

					<div class="beta-products-list">
						<h4>Top Products</h4>
						<div class="beta-products-details">
							<div class="clearfix"></div>
						</div>
						<div class="row">
							@foreach($promotion_products as $promo)
								<div class="col-sm-3">
									<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									<div class="single-item">
										<div class="single-item-header">
											<a href="{!! URL::route('getProductPage',[$promo->id]) !!}"><img src="{!! url('source//image/product/'.$promo->image) !!}" alt="" height="250px"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{!! $promo->name !!}</p>
											<p class="single-item-price">
												<span class="flash-del">{!! number_format($promo->unit_price) !!}.vnđ</span>
												<span class="flash-sale">{!! number_format($promo->promotion_price) !!}.vnđ</span>
											</p>
										</div>
										<div class="single-item-caption">
											<button class="add-to-cart pull-left" value="{!! $promo->id !!}"><i class="fa fa-shopping-cart"></i></button>
											<a class="beta-btn primary" href="{!! URL::route('getProductPage',[$promo->id]) !!}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							@endforeach
							<div class="col-sm-12">
								<ul class="pager">
									@if($promotion_products->currentPage() != 1 )
									<li class=""><a href="{!! $promotion_products->url($promotion_products->currentPage() - 1) !!}">Previous</a></li>
									@endif
									@for($i=1; $i<=$promotion_products->lastPage(); $i = $i + 1)
									<li class="{!! ($promotion_products->currentPage() == $i) ? 'active' : '' !!}"><a href="{!! $promotion_products->url($i) !!}">{!! $i !!}</a></li>
									@endfor
									@if($promotion_products->currentPage() != $promotion_products->lastPage() )
									<li class=""><a href="{!! $promotion_products->url($promotion_products->currentPage() + 1) !!}">Next</a></li>
									@endif
								</ul>
							</div>
						</div>
						<div class="space40">&nbsp;</div>
					</div> <!-- .beta-products-list -->
				</div>
			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->
</div> <!-- .container -->
@stop