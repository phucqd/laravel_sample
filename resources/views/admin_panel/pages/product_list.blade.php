@extends('admin_panel.master')
@section('content')
	<div class="container-fluid content">
		@if(Session::has('flashMessages'))
			<div class="alert alert-{!! Session::get('level') !!} ">
				{!! Session::get('flashMessages') !!}
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
		@endif
		<div class="list_product">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Images</th>
                        <th>Unit Price</th>
                        <th>Promotion Price</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product_list as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{!! $item->id !!}</td>
                            <td>{!! $item->name !!}</td>
                            <td><img src="{!! url('source/image/product/', [$item->image]) !!}" height="30px" width="60px" alt=""></td>
                            <td>{!! number_format($item->unit_price).'vnđ' !!}</td>
                            <td>{!! number_format($item->promotion_price).'vnđ' !!}</td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> 
                                <button type="button" class="btn btn-link btn-delete-product" value="{!! $item->id !!}">Delete</button> 
                                <a id="link{!! $item->id !!}" type="hidden" href="{!! url('admin/product/delete',[$item->id]) !!}"></a>
                            </td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! url('admin/product/edit',[$item->id]) !!}">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $product_list->links() !!}
		</div>
	</div>
@stop