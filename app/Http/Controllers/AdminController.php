<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Http\Requests\CateAddRequest;
use App\Http\Requests\AddCategoryRequest;
use App\Product;
use App\User;
use App\Bills;
use App\Customer;
use App\BillDetail;
use Carbon\Carbon;
use DB; 
use File;
use Storage;
use App\ProductType;
class AdminController extends Controller
{
   public function getAdminPanel(){
        $time = Carbon::today('Asia/Ho_Chi_Minh');
        $cout_bill = DB::table('bills')->whereDate('created_at',$time)->count();
        //--------------
        $earned_today = Bills::whereDate('created_at',$time)->sum('total');
        //--------------
        $user_today = DB::table('users')->whereDate('created_at',$time)->count();
        //--------------
        return view('admin_panel.pages.panel',compact('cout_bill','earned_today','user_today'));
   }

   public function getProductAdd(){
        $category = ProductType::all();
        return view('admin_panel.pages.product_add',compact('category'));
   }

   public function postProductAdd(AddProductRequest $request){
        $product_add = new Product;
        $fileName = $request->file('fImages')->getClientOriginalName();
        $product_add->id_type= $request->loai_sp;
        $product_add->name = $request->txtName;
        $product_add->unit_price = $request->txtPrice;
        $product_add->promotion_price = $request->txtPromotion_price;
        $product_add->unit = $request->don_vi;
        $product_add->new = $request->sp_moi;
        $product_add->description = $request->txtDescipt;
        $product_add->image = $fileName;
        $request->file('fImages')->move('source/image/product/', $fileName);
        $product_add->save();
        return redirect()->route('getProductAdd')->with(['flashMessages'=>'Thêm mới sản phẩm thành công', 'level' => 'success']);
   }

   public function getListProduct(){
        $product_list = Product::select('id','name','unit_price','promotion_price', 'image')->paginate(10);
        return view('admin_panel.pages.product_list',compact('product_list'));
   }

   public function getDeleteProduct($id){
        $delete_image = Product::select('image')->where('id',$id)->first();
        File::delete('source/image/product/'.$delete_image->image);
        Product::destroy($id);
        return redirect()->route('getListProduct')->with(['flashMessages'=>'Xóa sản phẩm thành công', 'level' => 'success']);
   }

   public function getEditProduct($id){
        $category = ProductType::all();
        $product_info  = Product::find($id);
        return view('admin_panel.pages.product_edit',compact('category','product_info'));
   }

  public function postEditProduct(EditProductRequest $request, $id){
        $product_edit = Product::find($id);
        if ($request->hasFile('fImages')) {
          $fileName = $request->file('fImages')->getClientOriginalName();
          $request->file('fImages')->move('source/image/product/', $fileName);
          $product_edit->image = $fileName;
        }
        $product_edit->id_type= $request->loai_sp;
        $product_edit->name = $request->txtName;
        $product_edit->unit_price = $request->txtPrice;
        $product_edit->promotion_price = $request->txtPromotion_price;
        $product_edit->unit = $request->don_vi;
        $product_edit->new = $request->sp_moi;
        $product_edit->description = $request->txtDescipt;
        $product_edit->save();
        return redirect()->back()->with(['flashMessages'=>'Sửa sản phẩm thành công', 'level' => 'success']);  
  }

  public function getCateList(){
    $cate_list = ProductType::select('id','name','description')->paginate(10);
    return view('admin_panel.pages.cate_list', compact('cate_list'));
  }

  public function postAddCate(AddCategoryRequest $request){
    $cate_add = new ProductType;
    $cate_add->name  = $request->cate_name;
    $cate_add->description = $request->cate_desc;
    $cate_add->save();
    return redirect()->route('getCateList')->with(['flashMessages' => 'Thêm mới loại sản phẩm thành công', 'level' => 'success']);
  }

  public function postEditDataCate(Request $request){
      $cate_edit = ProductType::find($request->id);
      $result  = array(
        'name' => $cate_edit->name, 
        'desc' => $cate_edit->description
        );
      return json_encode($result);
  } 

  public function postEditCate(Request $request){
      $id = $request->cate_edit_id;
      $cate_update = ProductType::find($id);
      $cate_update->name  = $request->cate_edit_name;
      $cate_update->description = $request->cate_edit_desc;
      $cate_update->save();
      return redirect()->route('getCateList')->with(['flashMessages' => 'Chỉnh sửa loại sản phẩm thành công', 'level' => 'success']);
  }

  public function getTodayReport(){
    $today = Carbon::today('Asia/Ho_Chi_Minh');
    $order_today = Bills::whereDate('created_at',$today)->get();
    return view('admin_panel.pages.today_report',compact('order_today'));
  }

  public function getChartData(){
    $mo = Carbon::now()->startOfWeek();
    $tu = $mo->copy()->addDay();
    $we = $tu->copy()->addDay();
    $th = $we->copy()->addDay();
    $fr = $th->copy()->addDay();
    $sa = $fr->copy()->addDay();
    $su = Carbon::now()->endOfWeek();
   /*------------------------------------*/
   $mo_data = Bills::select('total')->whereDate('created_at',$mo)->sum('total');
   $tu_data = Bills::select('total')->whereDate('created_at',$tu)->sum('total');
   $we_data = Bills::select('total')->whereDate('created_at',$we)->sum('total');
   $th_data = Bills::select('total')->whereDate('created_at',$th)->sum('total');
   $fr_data = Bills::select('total')->whereDate('created_at',$fr)->sum('total');
   $sa_data = Bills::select('total')->whereDate('created_at',$sa)->sum('total');
   $su_data = Bills::select('total')->whereDate('created_at',$su)->sum('total');
   $result = array(
                    'T2' => $mo_data,
                    'T3' => $tu_data,
                    'T4' => $we_data,
                    'T5' => $th_data,
                    'T6' => $fr_data,
                    'T7' => $sa_data,
                    'CN' => $su_data
                 );
    echo json_encode($result);
  }
   /*------------------------------------*/
  public function getOderCancel(Request $request){
      $bill_details = BillDetail::where('id_bill',$request->bill_id);
      $bill_details->delete();
      $bill = Bills::find($request->bill_id);
      $bill->delete();
  }
  public function getupdateStatus(Request $request){
      $bill_update_status = Bills::find($request->id_bill);
      $bill_update_status->status = $request->status;
      $bill_update_status->save();
      echo 1;
  }

  /*------------------------------------*/
  public function getStatisticPage(){
      $monday = Carbon::now()->startOfWeek();
      $sunday = Carbon::now()->endOfWeek();
      $this_month = Carbon::now()->month;
      $first_day_this_month = Carbon::now()->startOfMonth();
      $today = Carbon::today('Asia/Ho_Chi_Minh');
      $tomorrow = $today->copy()->addDay();
      /*---------*/
      $today_total = Bills::select('total')->whereDate('created_at',$today)->sum('total');
      $today_sales = BillDetail::select('id_product','quantity')->whereDate('created_at',$today)->sum('quantity');
      /*---------*/
      $week_total  = Bills::select('total')->whereBetween('created_at', [$monday, $sunday])->sum('total');
      $week_sales  = BillDetail::select('id_product','quantity')->whereBetween('created_at', [$monday, $sunday])->sum('quantity');
      /*---------*/
      $month_total = Bills::select('total')->whereMonth('created_at', $this_month)->sum('total');
      $month_sales = BillDetail::select('id_product','quantity')->whereMonth('created_at', $this_month)->sum('quantity');
      /*---------*/
      $today_best_sale = DB::select(DB::raw("SELECT bill_detail.id_product, products.name,
                                              SUM(quantity) as sum_pr
                                              FROM bill_detail INNER JOIN products ON bill_detail.id_product = products.id WHERE bill_detail.created_at 
                                              BETWEEN  '$today' AND '$tomorrow'
                                              GROUP BY bill_detail.id_product
                                              ORDER BY sum_pr DESC
                                              LIMIT 10
                                              "));
      $week_best_sales = DB::select(DB::raw("SELECT bill_detail.id_product, products.name,
                                              SUM(quantity) as sum_pr
                                              FROM bill_detail INNER JOIN products ON bill_detail.id_product = products.id WHERE bill_detail.created_at 
                                              BETWEEN  '$monday' AND '$sunday'
                                              GROUP BY bill_detail.id_product
                                              ORDER BY sum_pr DESC
                                              LIMIT 10
                                              "));
      $month_best_sales = DB::select(DB::raw("SELECT bill_detail.id_product, products.name,
                                              SUM(quantity) as sum_pr
                                              FROM bill_detail INNER JOIN products ON bill_detail.id_product = products.id WHERE bill_detail.created_at 
                                              BETWEEN  '$first_day_this_month' AND '$tomorrow'
                                              GROUP BY bill_detail.id_product
                                              ORDER BY sum_pr DESC
                                              LIMIT 10
                                              "));
      /*---------*/
      return view('admin_panel.pages.statistic',compact('today_total','today_sales','week_total','week_sales','month_total','month_sales', 'today_best_sale','week_best_sales','month_best_sales'));
  }
  /*-----------------------------------*/
  public function getWeekReport(){
      $monday = Carbon::now()->startOfWeek();
      $sunday = Carbon::now()->endOfWeek();
      $oders_data  = Bills::whereBetween('created_at', [$monday, $sunday])->get();
      return view('admin_panel.pages.week_report', compact('oders_data'))->render();
  }

  public function getMonthReport(){
      $this_month = Carbon::now()->month;
      $oders_data = Bills::whereMonth('created_at', $this_month)->get();
      return view('admin_panel.pages.week_report',compact('oders_data'))->render();
  }

  public function getStartEndDateReport(Request $request){
      $start_date = $request->start;
      $end_date = $request->end;
      $oders_data = Bills::whereBetween('created_at', [$start_date, $end_date])->get();
      return view('admin_panel.pages.week_report', compact('oders_data'))->render();
  }

  public function getProcessingReport(){
    $oders_data = Bills::where('status', 'Đang chờ')->get();
    return view('admin_panel.pages.week_report', compact('oders_data'))->render();
  }
  public function getWeekProcessing(){
    $monday = Carbon::now()->startOfWeek();
    $sunday = Carbon::now()->endOfWeek();
    $oders_data = Bills::whereBetween('created_at', [$monday, $sunday])->where('status', 'Đang chờ')->get();
    return view('admin_panel.pages.week_report', compact('oders_data'))->render();
  }
  public function getWeekDone(){
      $monday = Carbon::now()->startOfWeek();
      $sunday = Carbon::now()->endOfWeek();
      $oders_data = Bills::whereBetween('created_at', [$monday, $sunday])->where('status', 'Hoàn tất')->get();
      return view('admin_panel.pages.week_report',compact('oders_data'))->render();
  }
  public function getMonthProcessing(){
      $this_month = Carbon::now()->month;
      $oders_data = Bills::whereMonth('created_at', $this_month)->where('status', 'Đang chờ')->get();
      return view('admin_panel.pages.week_report',compact('oders_data'))->render();
  }
  public function getMonthDone(){
      $this_month = Carbon::now()->month;
      $oders_data = Bills::whereMonth('created_at', $this_month)->where('status', 'Hoàn tất')->get();
      return view('admin_panel.pages.week_report',compact('oders_data'))->render();
  }
  public function getStartEndProcessing(Request $request){
      $start_date = $request->start;
      $end_date = $request->end;
      $oders_data = Bills::whereBetween('created_at', [$start_date, $end_date])->where('status', 'Đang chờ')->get();
      return view('admin_panel.pages.week_report', compact('oders_data'))->render();
  }
  public function getStartEndDone(Request $request){
      $start_date = $request->start;
      $end_date = $request->end;
      $oders_data = Bills::whereBetween('created_at', [$start_date, $end_date])->where('status', 'Hoàn tất')->get();
      return view('admin_panel.pages.week_report', compact('oders_data'))->render();
  }

  public function getPiceChartData(){ 
    $today = Carbon::today('Asia/Ho_Chi_Minh');
    $tomorrow = $today->copy()->addDay();
    $first_day_this_month = Carbon::now()->startOfMonth();
    $month_data = DB::select(DB::raw("
                                      SELECT type_products.name,
                                      SUM(quantity) as sum_pr
                                      FROM bill_detail 
                                      INNER JOIN products ON bill_detail.id_product = products.id 
                                      INNER JOIN type_products ON products.id_type = type_products.id
                                      WHERE bill_detail.created_at  
                                      BETWEEN  '$first_day_this_month' AND '$tomorrow'
                                      GROUP BY products.id_type
                                      ORDER BY sum_pr DESC
                                    "));
      echo json_encode($month_data);
  }

  public function getDeleteCate($id){
    $checkDelete = ProductType::find($id);
    if ($checkDelete->products()->count() == 0) {
      ProductType::destroy($id);
      return "deleted";
    }else{
      return 0;
    }
  }
}
	