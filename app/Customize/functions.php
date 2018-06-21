 <?php
function getProductName($bill_today)
{	
	$bill_details = DB::table('bill_detail')->select('id','id_product','quantity','unit_price')->where('id_bill',$bill_today->id)->get();
	foreach ($bill_details as $item) {
		$product = DB::table('products')->select('id','name')->where('id',$item->id_product)->get();
			foreach ($product as $it) {
				echo $it->name.'<span class="badge">'.$item->quantity.'</span><br/>';
			}
	} 
}

function getCustomerInfo($bill_today){
	if ($bill_today->id_customer != null ) {
      $customer_info = DB::table('customer')->find($bill_today->id_customer);
      echo 'Họ tên: '.$customer_info->name.'<br/>';
      echo 'Địa chỉ: '.$customer_info->address.'<br/>';
    }else{
      $customer_info = DB::table('users')->find($bill_today->id_user);
      echo 'Họ tên: '.$customer_info->full_name.'<br/>';
      echo 'Địa chỉ: '.$customer_info->address.'<br/>';
	}
}