<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use App\Bills;
use App\Mail\SubmitOrderMail;
use Illuminate\Http\Request;

class SendMailController extends Controller
{

	public function getSendOderMail($user_id){
		$userInfo = User::find($user_id);
		$userBillInfor = Bills::where('id_user',$userInfo)->orderBy('id', 'desc')->first();
		Mail::to($userInfo->email)->send(new SubmitOrderMail($userInfo, $userBillInfor));
	}
}
