@extends('admin_panel.master')
@section('content')
<div class="inner-block">
<!--market updates updates-->
    <div class="market-updates">
            <div class="col-md-4 market-update-gd">
                <div class="market-update-block clr-block-1">
                    <div class="col-md-8 market-update-left">
                        <h4>{!! $user_today !!}</h4>
                        <h4>Người dùng mới</h4>
                    </div>
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-envelope-o"> </i>
                    </div>
                  <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-4 market-update-gd">
                <div class="market-update-block clr-block-2">
                 <div class="col-md-8 market-update-left">
                    <h4>{!! number_format($earned_today) !!}.vnđ</h4>
                    <h4>Doanh thu</h4>

                  </div>
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-money" aria-hidden="true"></i>
                    </div>
                  <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-4 market-update-gd">
                <div class="market-update-block clr-block-3">
                    <div class="col-md-8 market-update-left">
                        <h4>{!! $cout_bill !!}</h4>
                        <h4>Đơn đặt hàng</h4>
                    </div>
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-file-text-o"> </i>
                    </div>
                  <div class="clearfix"> </div>
                </div>
            </div>
           <div class="clearfix"> </div>
    </div>
</div>
<div class="col-md-12" class="content">
        <canvas id="line-chart" width="60vh" height="25vh"></canvas>
</div>
@stop
