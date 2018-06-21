@extends('admin_panel.master')
@section('content')
	<div class="container-fluid content show-grid">
		@if(Session::has('flashMessages'))
			<div class="alert alert-{!! Session::get('level') !!} ">
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
		<div class="list_product">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cate_list as $item)
                        <tr class="odd gradeX" align="center" id="cate{!! $item->id !!}">
                            <td>{!! $item->id !!}</td>
                            <td>{!! $item->name !!}</td>
                            <td class="center" style="max-width: 10vh;">
                              <div class="form-group">
                                <button class="btn btn-link edit_cate_a" value="{!! $item->id !!}">
                                <i class="fa fa-pencil fa-fw"></i> 
                                Edit
                              </button>
                              <button class="btn btn-link delete_cate" value="{!! $item->id !!}">
                                <i class="fa fa-trash-o" aria-hidden="true"></i> 
                                Delete
                              </button>
                              </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $cate_list->links() !!}
		</div>
        <div class="col-md-12" id="">
                <div class="col-md-12 row">
                    <div class="col-md-3 row">
                        <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#add_cate">Thêm mới <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-md-9">
                        <div class="alert alert-success row alert-sm collapse">
                            successfull
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
                        </div>
                    </div>
                </div>
                <!--------------------------------Form them loai san pham---------------------------------------->
                <div class="col-md-12 collapse row" id="add_cate">
                    <form role="form" action="{!! URL::route('postAddCate') !!}" method="post">
                      <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                      <div class="form-group">
                        <label for="">Tên loại sản phẩm</label>
                        <input type="text" class="form-control" id="cate_name" name="cate_name" placeholder="Nhập tên loại sản phẩm">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả</label>
                        <textarea class="form-control" rows="5" name="cate_desc"></textarea>
                      </div>
                      <div class="form-group">
                           <button type="submit" class="btn btn-info">Submit</button>
                      </div>
                    </form>
                </div>
                <!---------------------------Form sua loai san pham---------------------------------------------->
                <div class="col-md-12 collapse row" id="edit_cate">
                    <form role="form" action="{!!  URL::route('postEditCate',[]) !!}" method="post">
                      <input type="hidden" name="_token" id="cate_edit_token" value="{!! csrf_token() !!}">
                      <div class="form-group">
                        <label for="">Sửa tên loại sản phẩm</label>
                        <input type="hidden" name="cate_edit_id" id="cate_edit_id" />
                        <input type="text" class="form-control" id="cate_edit_name" name="cate_edit_name" placeholder="Nhập tên loại sản phẩm">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Chỉnh sửa mô tả</label>
                        <textarea class="form-control" rows="5" name="cate_edit_desc" id="cate_edit_desc"></textarea>
                      </div>
                      <div class="form-group">
                           <button type="submit" class="btn btn-info" id="btn_edit_cate">Submit</button>
                      </div>
                    </form>
                </div>
        </div>
	</div>
@stop