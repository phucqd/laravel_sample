<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Slide, App\ProductType;
use App\Product;
use App\User;
use Auth;
use App\Bills;
use Hash;
use Cart;
class PageController extends Controller
{
	public function getIndexPage(){
		$slide = Slide::select('id','image')->get();
		$products = Product::select('id','name','image','unit_price','promotion_price')->where('new',1)->paginate(8);
		$promotion_products = Product::select('id','name','image','unit_price','promotion_price')->where('promotion_price','!=',0)->paginate(8,['*'],'sales');
		return view('pages.trangchu',compact('slide','products','promotion_products'));
	}
//------------------------------------------------------------------------
	public function getProductPage($id){
		$promotion_products_collect = Product::select('id','name','image','unit_price','promotion_price')->where('promotion_price','!=',0)->get();
		$promotion_products = $promotion_products_collect->random(4);
		$products_new = Product::select('id','name','image','unit_price','promotion_price')->where('new',1)->take(4)->get();
		$product_details = Product::all()->where('id',$id)->first();
		$collect =  Product::all()->where('id_type',$product_details->id_type)->where('id','!=',$product_details->id);
		$product_ramdom = $collect->random(3);
		return view('pages.sanpham',compact('product_details','product_ramdom','promotion_products','products_new'));
	}
//------------------------------------------------------------------------
	public function getLoaiSanPhamPage($id){
		$product_types_promo = Product::select('id','name','image','unit_price','promotion_price')->where([
			['id_type', '=', $id],
			['promotion_price', '!=', 0]
			])->get();
   	//-----------
		$product_types_new = Product::select('id','name','image','unit_price','promotion_price')->where([
			['id_type', '=', $id],
			['new', '==', 1]
			])->get();
   	//------------
		return view('pages.product_type',compact('product_types_promo','product_types_new'));
	}
//------------------------------------------------------------------------
	public function getLienHePage(){
		return view('pages.contacts');
	}
//------------------------------------------------------------------------
	public function getGioiThieuPage(){
		return view('pages.about');
	}
//------------------------------------------------------------------------
	public function getSignup(){
		return view('pages.register');
	}
//------------------------------------------------------------------------
	public function getLogin(){
		return view('pages.login');
	}
//------------------------------------------------------------------------
	public function getLogOut(){
		Auth::logout();
		return redirect()->route('root');
	}
//------------------------------------------------------------------------
	public function postSignup(SignUpRequest $request){
		$user = new User;
		$user->full_name = $request->txtUserName;
		$user->email = $request->txtEmail;
		$user->password = Hash::make($request->txtPassword);
		$user->phone = $request->txtPhone;
		$user->address = $request->txtAdress;
		$user->user_rights = 1;
		$user->remember_token = $request->_token;
		$user->save();
		return redirect()->route('getLogin')->with(['messages'=>'Register successfull','level' => 'success']);
	}
//------------------------------------------------------------------------
	public function postLogin(Request $request){
		if (Auth::attempt(['email' => $request->txtemail, 'password' => $request->xtxPassword])) {
			if (Auth::user()->user_rights != 0 ) {
				return redirect()->route('root');
			}
			else{
				return redirect()->route('root');
			}
		}
		else{
			return redirect()->back()->with(['messages'=>'Sai thông tin đăng nhập !','level'=>'danger']);
		}
	}
//----------------------------------------------------------------------
	public function searchItem(Request $request){
			$result = Product::select('id','name')->where('name','like','%'.$request->key_word.'%')->get();
			echo $result;
	}
// ----------------------------------------------------------------------
	public function getUserProfile(){
		$order_today  = Bills::where('id_user', Auth::user()->id)->get();
		$user_infor = User::where('id',Auth::user()->id)->first();
		return view('pages.profile',compact('order_today','user_infor'));
	}
// ----------------------------------------------------------------------
	public function postEditUser(Request $request){
		$edit_user = User::find(Auth::user()->id);
		$edit_user->full_name = $request->edit_name;
		$edit_user->email = $request->edit_email;
		$edit_user->phone = $request->edit_phone;
		$edit_user->address = $request->edit_address;
		if (Hash::check($request->password, Auth::user()->password)) {
			$edit_user->save();
			return redirect()->route('getUserProfile')->with(['flashMessages' => 'Cập nhật thông tin thành công !', 'level' => 'success']);
		}else{
			return redirect()->route('getUserProfile')->with(['flashMessages' => 'Mật khẩu không chính xác !', 'level' => 'danger']);
		}
	}
// ------------------------------------------------------------------------
	public function postChangePassWord(ChangePasswordRequest $request){
		$edit_pass = User::find(Auth::user()->id);
		if (Hash::check($request->current_pass, Auth::user()->password)) {
			$edit_pass->password = Hash::make($request->new_pass);
			$edit_pass->save();
			return redirect()->route('getUserProfile')->with(['flashMessages' => 'Cập nhật mật khẩu thành công !', 'level' => 'success']);
		}	
		else{
			return redirect()->route('getUserProfile')->with(['flashMessages' => 'Mật khẩu hiện tại không chính xác !', 'level' => 'danger']);
		}
	}
//-----------------------------------------------------------------------
	public function postChangeAvata(Request $request){
		$chage_avata = User::find(Auth::user()->id);
		$new_avata = $request->file('profile-image-upload')->getClientOriginalName();
		$chage_avata->avata = $new_avata;
		$request->file('profile-image-upload')->move('source/image/user/', $new_avata);
		$chage_avata->save();
		return redirect()->route('getUserProfile')->with(['flashMessages' => 'Cập nhật avata thành công !', 'level' => 'success']);
	}	
//-----------------------------------------------------------------------
}
