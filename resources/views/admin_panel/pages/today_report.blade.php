@extends('admin_panel.master')
@section('content')
	<!------------------------------------------------------>
	<div class="modal fade" id="biil_destroy_success" role="dialog">
		<div class="modal-dialog modal-sm" id="">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Thành công !</h4>
	        </div>
	        <div class="modal-body">
	          <p id="bill_cancel_id"></p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	    </div>
	</div>
	<!------------------------------------------------------>
	<div class="container-fluid content">
			<div class="col-md-12" id="locDonHang">
				<form class="" role="form">
					<input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}">
		        <!-------->
			        <div class="col-md-5">
			          <div class="col-md-6 col-xs-12">
			            <div class="form-group">
			              <label class="sr-only" for=""></label>
			              <input type="text" class="form-control" id="timTuNgay" placeholder="Tìm từ ngày">
			            </div>
			          </div>
			          <div class="col-md-6 col-xs-12">
			            <div class="form-group">
			                <label class="sr-only" for=""></label>
			                <input type="text" class="form-control" id="timDenNgay" placeholder="Đến ngày">
			            </div>
			          </div>
			        </div>
		        <!-------->
			        <div class="col-md-6">
			          <div class="col-md-6 col-xs-12">
			            <div class="form-group">
			            <select class="form-control" id="timTheoTuanThang" name="timTheoTuanThang">
			              <option value="null">Tìm trong</option>
			              <option value="timTrongTuan">Tuần này</option>
			              <option value="timTrongThang">Tháng này</option>
			            </select>
			            </div>
			          </div>
			          <div class="col-md-6 col-xs-12">
			            <div class="form-group">
			              <select class="form-control" id="timTheoTinhTrang" name="timTheoTinhTrang">
			                <option value="null">Tình trạng đơn hàng</option>
			                <option  value="dangCho">Đang chờ</option>
			                <option  value="hoanTat">Hoàn tất</option>
			              </select>
			            </div>
			          </div>
			        </div>
		        <!-------->
			        <div class="col-md-1 col-xs-12">
			          <button type="button" class="btn btn-sm btn-success" id="timKiemDonHang">Lọc</button>
			        </div>
		      </form>
			</div>
			<!-------------------------------------------------------->
			<div class="col-md-12 hidden-xs" id="xdh-Colum">
		      <div class="col-md-3 colInXdh">
		          <strong>Chi tiết đơn hàng</strong>
		      </div>
		      <div class="col-md-2  colInXdh1">
		          <strong>Chi tiết hóa đơn</strong>
		      </div>
		      <div class="col-md-3  colInXdh">
		        <strong>Thông tin khách hàng</strong>
		      </div>
		      <div class="col-md-2  colInXdh1">
		          <strong>Tình trạng</strong>
		      </div>
		      <div class="col-md-2  colInXdh">
		          <strong>Lựa chọn</strong>
		      </div>
		    </div>
		<!-------------------------------------------------------->
		 <div class="col-md-12" id="hienThiDonHang">
				 @foreach($order_today as $bill_today)
				 <div class="container-fluid donHang" id="bill{!! $bill_today->id !!}">
					<div class="col-md-3">
		        		{!! getProductName($bill_today) !!}
		        	</div>
		        	<div class="col-md-2">
					   	Tổng thanh toán {!! number_format($bill_today->total) !!}.vnđ
			        </div>
			        <div class="col-md-3">
			           	{!! getCustomerInfo($bill_today) !!}
			        </div>
			        <div class="col-md-2">
			           	<div class="form-group">
					      <select class="form-control" id="status{!! $bill_today->id !!}">
					      		@if($bill_today->status == 'Đang chờ')
					      			<option id="option1{!! $bill_today->id !!}" value="{!! $bill_today->status !!}" selected>{!! $bill_today->status !!}</option>
					      			<option id="option2{!! $bill_today->id !!}" value="Hoàn tất">Hoàn tất</option>
					      		@else
					      			<option id="option1{!! $bill_today->id !!}" value="{!! $bill_today->status !!}" selected>{!! $bill_today->status !!}</option>
					      			<option id="option2{!! $bill_today->id !!}" value="Đang chờ">Đang chờ</option>
					      		@endif
				
					      </select>
				      </div>
			        </div>
			        <div class="col-md-2">
		         		@if($bill_today->status == 'Hoàn tất')
		         			<button type="button" id="btn{!! $bill_today->id !!}" class="btn btn-success btn-sm bill_update disabled">Cập nhật</button>
		         		@else
		         			<button type="button" id="btn{!! $bill_today->id !!}" class="btn btn-success btn-sm bill_update" value="{!! $bill_today->id !!}">Cập nhật</button>
		         		@endif
		         		<button type="button" class="btn btn-danger btn-sm bill_cancel" value="{!! $bill_today->id !!}">Hủy</button>
		        	</div>
			     </div>
				 @endforeach
   	  	 </div>
	</div>
@stop