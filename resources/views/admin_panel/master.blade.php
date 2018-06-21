<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Shoppy an Admin Panel Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<link href="{!! url('admin_panel/css/bootstrap.css') !!}" rel="stylesheet" type="text/css" media="all">
<link href="{!! url('admin_panel/css/style.css') !!}" rel="stylesheet" type="text/css" media="all"/>
<link href="{!! url('admin_panel/css/font-awesome.css') !!}" rel="stylesheet"> 
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"/>
</head>
<body>  
<div class="page-container">    
   <div class="left-content">
       <div class="mother-grid-inner">
            <!--header start here-->
                <div class="header-main">
                    <div class="header-left">
                            <div class="logo-name">
                                     <a href="index.html">
                                    <img id="logo" src="{!! url('admin_panel/images/logo-cake.png') !!}" alt="Logo" height="50px" />
                                  </a>                              
                            </div>
                            <div class="clearfix"> </div>
                         </div>
                         <div class="header-right">
                            <div class="profile_details_left">
                                <div class="clearfix"> </div>
                            </div>
                            <div class="profile_details">       
                                <ul>
                                    <li class="dropdown profile_details_drop">
                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <div class="profile_img">   
                                               @if(Auth::check())
                                                  <span class="prfil-img"><img src="{!! url('source/image/user').'/'.Auth::user()->avata !!}" alt="" height="50px"> </span> 
                                                  <div class="user-name">
                                                        <p>{!! Auth::user()->full_name !!}</p>
                                                        <span>Administrator</span>
                                                  </div>
                                                @endif
                                                <i class="fa fa-angle-down lnr"></i>
                                                <i class="fa fa-angle-up lnr"></i>
                                                <div class="clearfix"></div>    
                                            </div>  
                                        </a>
                                        <ul class="dropdown-menu drp-mnu"> 
                                            <li> <a href="{!! URL::route('getUserProfile') !!}"><i class="fa fa-user"></i> Profile</a> </li> 
                                            @if(Auth::check())
                                                <li> <a href="{!! url('user/logout') !!}"><i class="fa fa-sign-out"></i> Logout</a> </li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"> </div>               
                        </div>
                     <div class="clearfix"> </div>  
                </div>
                @yield('content')
<div class="copyrights">
     <p>© AlleyBakers. All Rights Reserved</p>
</div>  
<!--COPY rights end here-->
</div>
</div>
<!--slider menu-->
    <div class="sidebar-menu">
            <div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
                  <!--<img id="logo" src="" alt="Logo"/>--> 
              </a> </div>         
            <div class="menu">
              <ul id="menu" >
                <li id="menu-home" ><a href="{!! url('/admin') !!}"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                <li><a href="#"><i class="fa fa-product-hunt" aria-hidden="true"></i><span>Sản phẩm</span><span class="fa fa-angle-right" style="float: right"></span></a>
                  <ul>
                    <li><a href="{!! url('/admin/product/list') !!}">Danh sách</a></li>  
                    <li><a href="{!! url('/admin/product/add') !!}">Thêm mới</a></li>               
                  </ul>
                </li>
                <li id="menu-comunicacao" ><a href="{!! URL::route('getTodayReport') !!}"><i class="fa fa-book nav_icon"></i><span>Quản lý đơn hàng</span></a></li>
                  <li><a href="{!! URL::route('getCateList') !!}"><i class="fa fa-list" aria-hidden="true"></i><span>Loại sản phẩm</span></a></li>
                <li id="menu-academico" ><a href="{!! URL::route('getStatisticPage') !!}"><i class="fa fa-bar-chart"></i><span>Thống kê</span></a>
                </li>
              </ul>
            </div>
     </div>
    <div class="clearfix"></div>
</div>
<script src="{!! url('admin_panel/js/jquery-2.1.1.min.js') !!}"></script> 
<script src="{!! url('admin_panel/js/jquery-ui.js') !!}"></script>
<script src="{!! url('admin_panel/js/jquery.nicescroll.js') !!}"></script>
<script src="{!! url('admin_panel/js/scripts.js') !!}"></script>
<script src="{!! url('admin_panel/js/bootstrap.js') !!}"></script>
<script src="{!! url('admin_panel/js/Chart.min.js') !!}"></script>
<script src="{!! url('admin_panel/js/sweetalert.min.js') !!}"></script>
<script src="{!! url('admin_panel/js/admin_script.js') !!}"></script>
</body>
