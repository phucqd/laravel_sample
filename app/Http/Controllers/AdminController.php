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
    public function testHighline()
    {
          $val = 1;
              return $val;   
    }
}
