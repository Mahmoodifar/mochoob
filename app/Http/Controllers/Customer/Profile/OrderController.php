<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Models\Market\Gallery;
use App\Models\Market\Product;
use App\Models\Market\OrderItem;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {

        if(isset(request()->type))
        {
            $orders = auth()->user()->orders()->where('order_status',request()->type)->orderBy('id','desc')->get();
        }else{
            $orders = auth()->user()->orders()->orderBy('id','desc')->get();
        }

        return view('customer.profile.orders', compact('orders'));
    }
}
