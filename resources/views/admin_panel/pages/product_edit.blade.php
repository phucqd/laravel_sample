@extends('admin_panel.master')
@section('content')
	<div class="container-fluid content">
		<div class="add_product">
			@if(Session::has('flashMessages'))
				<div class="alert alert-{!! Session::get('level') !!}">
					{!! Session::get('flashMessages') !!}
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				</div>
			@endif
			@if(count($errors) > 0)
				@foreach($errors->all() as $error)
					<div class="alert alert-danger">
						{!! $error !!}
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					</div>
				@endforeach
			@endif
			<form role="form" method="post" action="{!! URL::route('postEditProduct',[$product_info->id]) !!}" enctype="multipart/form-data">
				<div class="col-md-6">
					  <input type="hidden" name="_token" value="{!! csrf_token() !!}">
					  <div class="form-group">
					      <label for="sel1">Loại sản phẩm</label>
					      <select class="form-control" name="loai_sp">
					       	@foreach($category as $item)
					       		@if( $product_info->id_type == $item->id)
					       			<option value="{!! $item->id !!}" selected> {!! $item->name !!}</option>
					       		@else
					       			<option value="{!! $item->id !!}"> {!! $item->name !!}</option>
					       		@endif
					       	@endforeach
					      </select>
				      </div>
					  <div class="form-group">
					    <label for="">Tên sản phẩm</label>
					    <input type="text" class="form-control" name="txtName" placeholder="Nhập tên sản phẩm" value="{!! $product_info->name !!}" required>
					  </div>
					   <div class="form-group">
					    <label for="">Giá sản phẩm</label>
					    <input type="text" class="form-control" name="txtPrice" value="{!! $product_info->unit_price !!}" placeholder="Nhập giá sản phẩm" required>
					  </div>
					  <div class="form-group">
					    <label for="">Giá khuyến mãi</label>
					    <input type="text" class="form-control" name="txtPromotion_price" value="{!! $product_info->promotion_price !!}" placeholder="Nhập giá khuyến mãi sản phẩm">
					  </div>
					  <div class="form-group">
					      <label for="sel1">Đơn vị</label>
					      <select class="form-control" id="sel1" name="don_vi">
					      	@if($product_info->unit == 'cái')
					      		<option value="cái" selected>Cái</option>
					      		<option value="hộp">Hộp</option>
					      	@else
						        <option value="hộp" selected>Hộp</option>
						        <option value="cái">Cái</option>
					        @endif
					      </select>
				      </div>
				</div>
				<div class="col-md-6">
							<div class="form-group">
							  <label for="comment">Mô tả:</label>
							  <textarea class="form-control" rows="9" name="txtDescipt">{!! $product_info->description !!}</textarea>
							</div>
							<div class="col-md-8 col-sm-12 row">
								<div class="checkbox">
								    <label>
								      @if($product_info->new == 0)
								      	<input type="radio" name="sp_moi" value="1" > Sản phẩm mới
								      	<input type="radio" name="sp_moi"   value="0" checked> Không
								      @else
									      <input type="radio" name="sp_moi" value="1" checked > Sản phẩm mới
									      <input type="radio" name="sp_moi"   value="0"> Không
									  @endif
								    </label>
								</div>
								<div class="form-group">
									  <label for="comment">Ảnh sản phẩm</label>
									  <input type="file" name="fImages" />
								</div>
							</div>
						<div class="form-group col-md-4 col-sm-12 row">
							<img src="{!! url('source/image/product').'/'.$product_info->image !!}" height="100px" alt="">
						</div>
						<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</form>
	</div>
</div>
@stop