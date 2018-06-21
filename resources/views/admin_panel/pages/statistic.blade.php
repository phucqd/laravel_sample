@extends('admin_panel.master')
@section('content')
	<div class="container-fluid content show-grid">

		<div class="col-md-12 col-lg-12">
			<div class="col-md-12 well" id="top_bar_title">
		        <strong>Thống kê doanh thu</strong>
		    </div>
		    <div class="col-md-12 col-lg-12">
		    	<canvas id="pie-chart" width="550" height="200"></canvas>
		    </div>
		</div>
		<div class="col-md-12">
	        <div class="col-md-4">
	            <div class="col-md-12 well">
	              <strong>Hôm nay</strong>
	            </div>
	            <div class="col-md-12 tkspBanChay" id="tkspBanChay">
	              <table class="table table-hover">
	                <thead>
	                  <tr>
	                  </tr>
	                </thead>
	                <tbody>
	                      <tr>
	                        <td>Tổng doanh thu: <b class="highlight">{!! number_format($today_total) !!}.vnđ </b></td>
	                      </tr>
	                      <tr>
	                      	<td>Số sản phẩm bán ra: <b class="highlight">{!! $today_sales !!}</b></td>
	                      </tr>
	                      <tr>
	                      	<td>
	                      		<b class="highlight">Top 10 sản phẩm bán chạy nhất</b> <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
	                      	</td>
	                      </tr>

                  			@foreach($today_best_sale as $item)
	                  			<tr>
	                  				<td>
                  						{!! $item->name !!} <span class="badge">{!! $item->sum_pr !!}</span>
                  					</td>
	                  			</tr>
                  			@endforeach

	                </tbody>
	              </table>
	            </div>
	        </div>
	        <div class="col-md-4">
	          <div class="col-md-12 well">
	            <strong>Tuần này</strong>
	          </div>
	          <div class="col-md-12 tkspBanChay" id="tkspBanChay">
	            <table class="table table-hover">
	              <thead>
	                <tr>
	                </tr>
	              </thead>
	              <tbody>
	                    <tr>
	                      <td>Tổng doanh thu: <b class="highlight">{!! number_format($week_total) !!}.vnđ</b></td>
	                    </tr>
	                    <tr>
	                      <td>Số sản phẩm bán ra: <b class="highlight">{!! $week_sales !!}</b></td>
	                    </tr>
	                    <tr>
	                      	<td>
	                      		<b class="highlight">Top 10 sản phẩm bán chạy nhất</b> <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
	                      	</td>
	                     </tr>

              			@foreach($week_best_sales as $item)
                  			<tr>
                  				<td>
                  					{!! $item->name !!} 
                  					<span class="badge">{!! $item->sum_pr !!}</span>
                  				</td>
                  			</tr>
              			@endforeach
	              </tbody>
	            </table>
	          </div>
	        </div>
	        <div class="col-md-4">
	          <div class="col-md-12 well">
	            <strong>Tháng này</strong>
	          </div>
	          <div class="col-md-12 tkspBanChay" id="tkspBanChay">
	            <table class="table table-hover">
	              <thead>
	                <tr>
	                </tr>
	              </thead>
	              <tbody>
	                    <tr>
	                      <td>Tổng doanh thu: <b class="highlight">{!! number_format($month_total) !!}.vnđ</b></td>
	                    </tr>
	                    <tr>
	                      <td>Số sản phẩm bán ra: <b class="highlight">{!! $month_sales !!}</b></td>
	                    </tr>
	                     <tr>
	                      	<td>
	                      		<b class="highlight">Top 10 sản phẩm bán chạy nhất</b> <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
	                      	</td>
	                     </tr>

              			@foreach($month_best_sales as $item)
                  			<tr>
                  				<td>
                  					{!! $item->name !!} <span class="badge">{!! $item->sum_pr !!}</span>
                  				</td>
                  			</tr>
              			@endforeach
	              </tbody>
	            </table>
	          </div>
	        </div>
    </div>
	</div>
@stop