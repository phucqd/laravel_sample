@extends('master')
@section('content')
<!-------------------------------------------------------------------------------------------->
	    <div class="modal fade" id="datHangThanhCong" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header well">
            <h4 class="modal-title"><strong>Đặt hàng thành công !</strong></h4>
          </div>
          <div class="modal-body" id="thongTinDonHang">
              <div class="col-md-6">
                  <div class="col-md-12">
                      Họ tên : <i id="tenKhHd">@if(Auth::check()) {!! Auth::user()->full_name !!}  @endif</i>
                  </div>
                  <div class="col-md-12">
                      Địa chỉ : <i id="diaChiKhHd">@if(Auth::check()) {!! Auth::user()->address !!}  @endif</i>
                  </div>
                  <div class="col-md-12">
                      Số điện thoại : <i id="soDtKhHd">@if(Auth::check()) {!! Auth::user()->phone !!}  @endif</i>
                  </div>
                  <div class="col-md-12">
                      Email : <i id="emailKhHd">@if(Auth::check()) {!! Auth::user()->email !!}  @endif</i>
                  </div>
                  <div class="col-md-12">
                      Hình thức thanh toán: <i id="cachThanhToanHd"></i>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="col-md-12">
	                   <div class="col-md-12">
		                   	<table class="table">
							    <thead>
							      <tr>
							        <th>Tên sản phẩm </th>
							        <th>Số Lượng</th>
							        <th>Đơn giá</th>
							      </tr>
							    </thead>
							    <tbody id="item_payment_table">
							   
							    </tbody>
						  </table>
	                   </div>
                    <div class="col-md-12">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-5">
                          Tổng thanh toán :
                        </div>
                        <div class="col-md-3">
                          <i id="tongThanhToanHD"></i><u>đ</u>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="col-md-12" id="loiCamOn">
                  <strong>Cảm ơn bạn đã ủng hộ cửa hàng chúng tôi. Sản phẩm sẽ sớm được chuyển đến bạn...</strong>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="closeDatHangThanhCong">Close</button>
          </div>
        </div>
      </div>
    </div>
<!-------------------------------------------------------------------------------------------->
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Shopping Cart</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="index.html">Home</a> / <span>Shopping Cart</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		@if($cart_number != 0)
		<div class="table-responsive" id="show_cart_table">
			<!-- Shop Products Table -->
			<table class="shop_table beta-shopping-cart-table" cellspacing="0">
				<thead>
					<tr>
						<th class="product-name">Sản phẩm</th>
						<th class="product-price">Đơn giá</th>
						<th class="product-quantity">Số lượng</th>
						<th class="product-subtotal">Tổng</th>
						<th class="product-remove">Xóa</th>
					</tr>
				</thead>
					<tbody>
						<form id="update_cart_item" method="post">
							<input type="hidden" name="_token" id="update_cart_token" value="{!! csrf_token() !!}">
							@foreach($cart_content as $item)
								<tr class="cart_item" id="remove_tr{!! $item->id !!}">
									<td class="product-name">
										<div class="media">
											<img class="pull-left" src="{!! url('source/image/product/'.$item->images) !!}" alt="">
											<div class="media-body">
												<p class="font-large table-title">{!! $item->name !!}</p>
											</div>
										</div>
									</td>

									<td class="product-price">
										<span class="amount">{!! number_format($item->price) !!}.vnđ</span>
									</td>

									<td class="product-quantity">
										<div class="form-group has-success has-feedback" id="{!! $item->rowId !!}">
										  <label class="control-label" for="inputSuccess2"></label>
									      <input type="text" class="form-control product-qty" id="{!! $item->id !!}" value="{!! $item->qty !!}" >
									      <span class="form-control-feedback loader"><img src="{!! url('source/image/slide/loader.gif') !!}" ></span>
									    </div>
									</td>
									<td class="product-subtotal">
										<span class="amount" id="item{!! $item->id !!}">{!! number_format($item->price * $item->qty) !!}.vnđ</span>
									</td>

									<td class="product-remove">
										<button class="remove btn-xs" type="button" title="Remove this item" name="{!! $item->id !!}" value="{!! $item->rowId !!}"><i class="fa fa-trash-o"></i></button>
									</td>
								</tr>
							@endforeach
						</form>
					</tbody>
				<tfoot>
					<tr>
						<td colspan="6" class="actions"></td>
					</tr>
				</tfoot>
			</table>
			<!-- End of Shop Table Products -->
		</div>
		@else
		<div class="col-md-12" id="show_cart_empty">
			<div>Bạn hiện chưa có sản phẩm nào trong giỏ hàng</div>
		</div>
		@endif
		<div class="col-md-12" hidden id="show_cart_empty">
			<div>Thật tiếc, bạn vừa bỏ hết sản phẩm trong giỏ hàng</div>
		</div>
		<!-- Cart Collaterals -->
		<div class="cart-collaterals">
			<div class="col-md-8">
					@if(Auth::check())
						@if($cart_number != 0)
							<form id="user_payment">
								<input type="hidden" name="_token" id="user_payment_token" value="{!! csrf_token() !!}">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="sel1">Hình thức thanh toán</label>
									  <select class="form-control" id="sel1" name="user_hinh_thuc_tt">
									    <option value="Khi nhận hàng">Khi nhận hàng</option>
									    <option value="Thẻ điện thoại">Thẻ điện thoại</option>
									  </select>
									</div>
									<div class="form-group">
										  <label for="comment">Ghi chú thêm</label>
										  <textarea class="form-control" rows="6" id="user_ghi_chu"></textarea>
										</div>
								</div>
							</form>
						@endif
					@else
						<div  id="thanh_toan_ngay" class="collapse">
						<form role="form" id="form-thanh-toan" action="{!! url('cart/payment') !!}" method="post">
							<input type="hidden" id="token" name="_token" value="{!! csrf_token() !!}">
							<div class="col-md-6">
									<div class="form-group">
										<label for="">Họ tên khách hàng</label>
										<input type="text" class="form-control" id="txt_ten_kh" name="txt_ten_kh" placeholder="Họ tên">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Địa chỉ nhận hàng</label>
										<input type="text" class="form-control" id="txt_dia_chi_kh" name="txt_dia_chi_kh" placeholder="Địa chỉ">
									</div>
								<div class="form-group">
									<label for="">SĐT khách hàng</label>
									<input type="text" class="form-control" id="txt_sdt_kh" name="txt_sdt_kh" placeholder="SĐT">
								</div>
								<div class="form-group">
									<label for="">Địa chỉ email</label>
									<input type="text" class="form-control" id="txt_email_kh" name="txt_email_kh" placeholder="email">
								</div>
								<div class="form-group">
								  <label for="sel1">Hình thức thanh toán</label>
								  <select class="form-control" id="sel1" id="txt_hinh_thuc_tt" name="txt_hinh_thuc_tt">
								    <option value="Khi nhận hàng">Khi nhận hàng</option>
								    <option value="Thẻ điện thoại">Thẻ điện thoại</option>
								  </select>
								</div>
								<div class="form-group">
									<label class="radio-inline">Anh<input type="radio" name="txt_gioi_tinh_kh" value="nam" checked></label>
									<label class="radio-inline">Chị<input type="radio" name="txt_gioi_tinh_kh" value="nữ"></label>	
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									  <label for="comment">Ghi chú thêm</label>
									  <textarea class="form-control" rows="15" id="txt_ghi_chu" name="txt_ghi_chu"></textarea>
									</div>
								<div class="form-group">
									<button type="button" id="submit_payment" class="btn btn-primary">Hoàn tất</button>
								</div>
							</div>
						</form>
					@endif
				</div>
			</div>
			<div class="cart-totals col-md-4">
				<div class="cart-totals-row"><h5 class="cart-total-title">Cart Totals</h5></div>
				<div class="cart-totals-row"><span>Cart Subtotal:</span> <span class ="check_out_sum" id="bill_total">{!! number_format($cart_total) !!}.vnđ</span></div>
				<div class="cart-totals-row"><span>Ship fees:</span> <span class="">free ship</span></div>
				@if($cart_number != 0)

						@if(Auth::check())
							<div class="cart-totals-row">
								<button type="button" class="btn btn-info" id="btn-user-payment">Thanh toán</button>
							</div>
						@else
							<div class="cart-totals-row">
								<a href="{!! url('user/login') !!}" class="btn btn-info" role="button">Đăng nhập để thanh toán</a>
							</div>
							<div class="cart-totals-row">
								<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#thanh_toan_ngay">Thanh toán không cần đăng nhập</button>
							</div>
						@endif 
				@else
					<div class="cart-totals-row">
						<a href="#" class="btn btn-info disabled" role="button" >Đăng nhập để thanh toán</a> 
					</div>
					<div class="cart-totals-row">
						<button type="button" class="btn btn-link disabled" data-toggle="collapse" data-target="#thanh_toan_ngay">Thanh toán không cần đăng nhập</button>
					</div>
				@endif
			</div>
			<div class="clearfix"></div>
		</div>
		<!-- End of Cart Collaterals -->


	</div> <!-- #content -->
</div> <!-- .container -->
@stop