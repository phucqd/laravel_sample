<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    protected $table = "bills";
    public function bill_detail(){
    	return $this->hasMany('App\BillDetail','id_bill','id');
    }

    public function customer(){
    	return $this->belongsTo('App\Customer','id_customer','id');
    }

    public function user(){
    	return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
 