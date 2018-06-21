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
			<form role="form" method="post" action="{!! URL::route('postProductAdd') !!}" enctype="multipart/form-data">
				<div class="col-md-6">
					  <input type="hidden" name="_token" value="{!! csrf_token() !!}">
					  <div class="form-group">
					      <label for="sel1">Loại sản phẩm</label>
					      <select class="form-control" name="loai_sp">
					       	@foreach($category as $item)
					       		<option value="{!! $item->id !!}"> {!! $item->name !!}</option>
					       	@endforeach
					      </select>
				      </div>
					  <div class="form-group">
					    <label for="">Tên sản phẩm</label>
					    <input type="text" class="form-control" name="txtName" placeholder="Nhập tên sản phẩm" required>
					  </div>
					   <div class="form-group">
					    <label for="">Giá sản phẩm</label>
					    <input type="text" class="form-control" name="txtPrice" placeholder="Nhập giá sản phẩm" required>
					  </div>
					  <div class="form-group">
					    <label for="">Giá khuyến mãi</label>
					    <input type="text" class="form-control" name="txtPromotion_price" placeholder="Nhập giá khuyến mãi sản phẩm">
					  </div>
					  <div class="form-group">
					      <label for="sel1">Đơn vị</label>
					      <select class="form-control" id="sel1" name="don_vi">
					        <option value="Cái">Cái</option>
					        <option value="Hộp">Hộp</option>
					      </select>
				      </div>
				</div>
				<div class="col-md-6">
						<div class="form-group">
						  <label for="comment">Mô tả:</label>
						  <textarea class="form-control" rows="9" name="txtDescipt"></textarea>
						</div>
						<div class="checkbox">
						    <label>
						      <input type="radio" name="sp_moi" value="1" checked > Sản phẩm mới
						      <input type="radio" name="sp_moi"   value="0"> Không
						    </label>
						</div>
						<div class="form-group">
							  <label for="comment">Ảnh sản phẩm</label>
							  <input type="file" name="fImages" />
						</div>
						<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</form>
	</div>
</div>
@stop