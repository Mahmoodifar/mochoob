<?php

namespace App\Http\Controllers\Customer\Profile;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    public function index()
    {
      return view('customer.profile.my-favorites');
    }

    public function delete(Product $product)
    {
        $user = auth()->user();
        $user->products()->detach($product);
        return redirect()->route('customer.profile.my-favorites')->with('success','محصول با موفقیت از لیست علاقه مندی ها حذف شد');
    }
}
