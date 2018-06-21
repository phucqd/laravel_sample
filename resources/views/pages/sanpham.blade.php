    @extends('master')
    @section('content')
    <div class="inner-header">
    	<div class="container">
    		<div class="pull-left">
    			<h6 class="inner-title">Product</h6>
    		</div>
    		<div class="pull-right">
    			<div class="beta-breadcrumb font-large">
    				<a href="index.html">Home</a> / <span>Product</span>
    			</div>
    		</div>
    		<div class="clearfix"></div>
    	</div>
    </div>

    <div class="container">
    	<div id="content">
    		<div class="row">
    			<div class="col-sm-9">

    				<div class="row">
    					<div class="col-sm-4">
    						<img src="{!! url('source//image/product/'.$product_details->image) !!}" alt="">
    					</div>
    					<div class="col-sm-8">
    						<div class="single-item-body">
    							<p class="single-item-title">{!! $product_details->name !!}</p>
    							<p class="single-item-price">
    								<span>{!! number_format($product_details->unit_price) !!}.vnđ</span>
    							</p>
    						</div>

    						<div class="clearfix"></div>
    						<div class="space20">&nbsp;</div>

    						<div class="single-item-desc">
    							<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo ms id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe.</p>
    						</div>
    						<div class="space20">&nbsp;</div>

    						<p>Thêm vào giỏ hàng</p><br/>
    						<div class="single-item-options">
    							<button class="add-to-cart" href="" value="{!! $product_details->id !!}"><i class="fa fa-shopping-cart"></i></button>
    							<div class="clearfix"></div>
    						</div>
    					</div>
    				</div>

    				<div class="space40">&nbsp;</div>
    				<div class="woocommerce-tabs">
    					<ul class="tabs">
    						<li><a href="#tab-description">Description</a></li>
    						<li><a href="#tab-reviews">Reviews (0)</a></li>
    					</ul>

    					<div class="panel" id="tab-description">
    						<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
    						<p>Consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequaturuis autem vel eum iure reprehenderit qui in ea voluptate velit es quam nihil molestiae consequr, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? </p>
    					</div>
    					<div class="panel" id="tab-reviews">
    						<p>No Reviews</p>
    					</div>
    				</div>
    				<div class="space50">&nbsp;</div>
    				<div class="beta-products-list">
    					<h4>Related Products</h4>

    					<div class="row">
                            @foreach($product_ramdom as $random_item)
                            <div class="col-sm-4">
                             <div class="single-item">
                                <div class="single-item-header">
                                   <a href="{!! URL::route('getProductPage',[$random_item->id]) !!}"><img src="{!! url('source//image/product/'.$random_item->image) !!}" alt="" height="250px"></a>
                               </div>
                               <div class="single-item-body">
                                   <p class="single-item-title">{!! $random_item->name !!}</p>
                                   <p class="single-item-price">
                                      <span>{!! number_format($random_item->unit_price) !!}.vnđ</span>
                                  </p>
                              </div>
                              <div class="single-item-caption">
                               <button class="add-to-cart pull-left" href="" value="{!! $random_item->id !!}"><i class="fa fa-shopping-cart"></i></button>
                               <a class="beta-btn primary" href="{!! URL::route('getProductPage',[$random_item->id]) !!}">Details <i class="fa fa-chevron-right"></i></a>
                               <div class="clearfix"></div>
                           </div>
                       </div>
                   </div>
                   @endforeach
               </div>
           </div> <!-- .beta-products-list -->
       </div>
       <div class="col-sm-3 aside">
        <div class="widget">
           <h3 class="widget-title">Best Sellers</h3>
           <div class="widget-body">
              <div class="beta-sales beta-lists">
                @foreach($promotion_products as $best_sallers)
                <div class="media beta-sales-item">
                    <a class="pull-left" href="{!! URL::route('getProductPage',[$best_sallers->id]) !!}"><img src="{!! url('source//image/product/'.$best_sallers->image) !!}" alt=""></a>
                    <div class="media-body">
                       {!! $best_sallers->name !!}
                       <span class="beta-sales-price">{!! number_format($best_sallers->unit_price) !!}.vnđ</span>
                   </div>
               </div>
               @endforeach
           </div>
       </div>
   </div> <!-- best sellers widget -->
   <div class="widget">
       <h3 class="widget-title">New Products</h3>
       <div class="widget-body">
          <div class="beta-sales beta-lists">
            @foreach($products_new as $news_item)
            <div class="media beta-sales-item">
                <a class="pull-left" href="{!! URL::route('getProductPage',[$news_item->id]) !!}"><img src="{!! url('source//image/product/'.$news_item->image) !!}" alt=""></a>
                <div class="media-body">
                   {!! $news_item->name !!}
                   <span class="beta-sales-price">{!! number_format($news_item->unit_price) !!}.vnđ</span>
               </div>
           </div>
           @endforeach
       </div>
   </div>
</div> <!-- best sellers widget -->
</div>
</div>
</div> <!-- #content -->
</div> <!-- .container -->
@stop
<!-- #footer -->

<!-- .copyright -->
<!--customjs-->
</body>
</html>