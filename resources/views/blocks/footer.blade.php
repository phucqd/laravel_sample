
<div id="footer" class="color-div">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="widget">
					<h4 class="widget-title">Instagram Feed</h4>
					<div id="instagram-feed">
						<div>
							<a href="https://www.instagram.com" target="_blank"><img src="{!! url('source/assets/dest/images/instagram.png') !!}"/></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="widget">
					<h4 class="widget-title">Loại sản phẩm</h4>
					<div>
						<ul>
								<?php
									$product_types = DB::table('type_products')->select('id','name')->take(3)->get();
								?>
								@foreach($product_types as $type)
								<li><a href="{!! URL::route('getLoaiSanPhamPage',[$type->id]) !!}">{!! $type->name !!}</a></li>
								@endforeach
								<li>.........</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="col-sm-10">
					<div class="widget">
						<h4 class="widget-title">Contact Us</h4>
						<div>
							<div class="contact-info">
								<p>Đặng Minh Trường</p>
								<p>Học viện Nông Nghiệp Việt Nam -Ngô Xuân Quảng - Trâu Quỳ - Gia Lâm - Hà Nội</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="widget">
					<h4 class="widget-title">Map</h4>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1862.2972314961635!2d105.93353556629718!3d21.008887208677052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xfa363bfa9d88553d!2zQ-G7rWEgSMOgbmcgQsOhY2ggS2hvYSBTw6FjaA!5e0!3m2!1svi!2s!4v1490962282509" width="250px" height="150px" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>
		</div> <!-- .row -->
	</div> <!-- .container -->
</div> 
<div class="copyright">
	<div class="container">
		<p class="pull-left">Privacy policy. (&copy;) 2014</p>
		<p class="pull-right pay-options">
			<a href="#"><img src="{!! url('source/assets/dest/images/pay/master.jpg') !!}" alt="" /></a>
			<a href="#"><img src="{!! url('source/assets/dest/images/pay/pay.jpg') !!}" alt="" /></a>
			<a href="#"><img src="{!! url('source/assets/dest/images/pay/visa.jpg') !!}" alt="" /></a>
			<a href="#"><img src="{!! url('source/assets/dest/images/pay/paypal.jpg') !!}" alt="" /></a>
		</p>
		<div class="clearfix"></div>
	</div> <!-- .container -->
</div> 