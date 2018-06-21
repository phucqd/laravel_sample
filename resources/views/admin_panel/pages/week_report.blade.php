 
		 @foreach($oders_data as $bill_today)
		 <div class="container-fluid donHang" id="bill{!! $bill_today->id !!}">
			<div class="col-md-3">
        		{!! getProductName($bill_today) !!}
        	</div>
        	<div class="col-md-2">
			   	Tổng thanh toán {!! $bill_today->total !!}.vnđ
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
