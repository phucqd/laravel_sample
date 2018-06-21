<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Mail\SubmitOrderMail;
use Carbon\Carbon;
use Cart;
use App\User;
use Mail;
use Auth;
use App\Bills;
use App\Customer;
use App\BillDetail;
use App\Product;
use App\Events\customerOrder;

class CartController extends Controller
{

	public function viewCart(){
		$cart_content = Cart::content();
		$cart_number = Cart::count();
		$cart_total = 0;
		foreach ($cart_content as  $item) {
			$cart_total += $item->price * $item->qty;
		}
		return view('pages.viewcart',compact('cart_content','cart_number','cart_total'));
	}
	//----------------------------------------------------------------------------------------------------
	public function addCart(Request $request){
		$item_id = $request->id;
		$item = Product::select('id','name','unit_price','image')->where('id',$item_id)->first();
	    Cart::add(['id' => $item_id,'name' => $item->name,'qty' => 1,'price' => $item->unit_price,'options' => ['images' => $item->image]]);
		echo Cart::count();
	}
	//---------------------------------------------------------------------------------------------------
	public function removeItem(Request $request){
		$item_remove_id = $request->id;
		Cart::remove($item_remove_id);
		if (Cart::count() == 0) {
			echo 0;
		}else{
			/* Tính tổng hóa đơn */
			$cart_content = Cart::content();
			$cart_number = Cart::count();
			$cart_total = 0;
			foreach ($cart_content as  $item) {
				$cart_total += $item->price * $item->qty;
			}
			echo number_format($cart_total).'vnđ';
		}
	}
	//--------------------------------------------------------------------------------------------------
	public function postUpdateItem(Request $request){
		$item_update_id = $request->id;
		$item_update_qty = $request->qty;
		Cart::update($item_update_id, $item_update_qty);
		/* Tính tổng hóa đơn */
		$cart_content = Cart::content();
		$cart_number = Cart::count();
		$cart_total = 0;
		$item_price_update = 0 ;
		foreach ($cart_content as  $item) {
			$cart_total += $item->price * $item->qty;
			if ($item->rowId == $item_update_id) {
				$item_price_update = $item->price * $item->qty;
			}
		}
		$result = array(
				'item_price_update' => number_format($item_price_update).'vnđ',
				'cart_total_update' => number_format($cart_total).'vnđ'
			);
		echo json_encode($result);
	}

	//--------------------------------------------------------------------------------------------------
	public function postPayment(PaymentRequest $request){
		$bill = new Bills;
		$customer = new Customer;
		/* Lưu vào bảng customer */
		$customer->name = $request->txt_ten_kh;
		$customer->address = $request->txt_dia_chi_kh;
		$customer->phone_number = $request->txt_sdt_kh;
		$customer->email = $request->txt_email_kh;
		$customer->gender = $request->txt_gioi_tinh_kh;
		$customer->save();


		/* Tính tổng hóa đơn */
		$cart_content = Cart::content();
		$cart_number = Cart::count();
		$cart_total = 0;
		foreach ($cart_content as  $item) {
			$cart_total += $item->price * $item->qty;
		}

		/* Lưu vào bảng bill */
		$bill->id_customer = $customer->id;
		$bill->note = $request->txt_ghi_chu;
		$bill->payment = $request->txt_hinh_thuc_tt;
		$bill->total = $cart_total;
		$bill->date_order = Carbon::today('Asia/Ho_Chi_Minh');
		$bill->status = 'Đang chờ';
		$bill->save();

		/* Luu vao bang bill detail */

		foreach ($cart_content as $item) {
			$bill_detail = new BillDetail;
			$bill_detail->id_bill = $bill->id;
			$bill_detail->id_product = $item->id;
			$bill_detail->quantity = $item->qty;
			$bill_detail->unit_price = $item->price;
			$bill_detail->save();
		}

		foreach ($cart_content as $item_info) {
			echo '<tr><td>'.$item_info->name.'</td><td>'.$item_info->qty.'</td><td>'.number_format($item_info->price).'vnđ</td></tr>';
		}

		try {
			$userInfo = Customer::find($customer->id);
			$userBillInfor = Bills::where('id_customer',$customer->id)->orderBy('id', 'desc')->first();
			//Mail::to($userInfo->email)->send(new SubmitOrderMail($userInfo, $userBillInfor));
			event(new customerOrder($userBillInfor));
			Cart::destroy();
		} catch (Exception $e) {
			Cart::destroy();
		}
	}
//-------------------------------------------------------------------
	public function postUserPayment(Request $request){
		$bill = new Bills;
		/* Tính tổng hóa đơn */
		$cart_content = Cart::content();
		$cart_number = Cart::count();
		$cart_total = 0;
		foreach ($cart_content as  $item) {
			$cart_total += $item->price * $item->qty;
		}
		/* Luu vao bang bill */
		$bill->id_user = Auth::user()->id;
		$bill->date_order = Carbon::today('Asia/Ho_Chi_Minh');
		$bill->total = $cart_total;
		$bill->payment = $request->hinh_thuc;
		$bill->note = $request->ghi_chu;
		$bill->save();
		/* Luu vao bang bill detail */

		foreach ($cart_content as $item) {
			$bill_detail = new BillDetail;
			$bill_detail->id_bill = $bill->id;
			$bill_detail->id_product = $item->id;
			$bill_detail->quantity = $item->qty;
			$bill_detail->unit_price = $item->price;
			$bill_detail->save();
		}
		foreach ($cart_content as $item_info) {
			echo '<tr><td>'.$item_info->name.'</td><td>'.$item_info->qty.'</td><td>'.number_format($item_info->price).'vnđ</td></tr>';
		}
		try {
			$userInfo = User::find(Auth::user()->id);
			$userBillInfor = Bills::where('id_user',$userInfo->id)->orderBy('id', 'desc')->first();
			Mail::to($userInfo->email)->send(new SubmitOrderMail($userInfo, $userBillInfor));
			Cart::destroy();
		} catch (Exception $e) {
			Cart::destroy();
		}
	}

	public function userCancelOrder($orderId){

		$oderCancelDetails = BillDetail::where('id_bill', $orderId)->get();
		foreach ($oderCancelDetails as $detail) {
			BillDetail::destroy($detail->id);
		}
		Bills::destroy($orderId);
		return view('pages.countTimeAfterDelete');
	}
}
