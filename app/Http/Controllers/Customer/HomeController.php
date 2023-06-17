<?php

namespace App\Http\Controllers\Customer;

use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Models\Content\Banner;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        //TODO DELETE FAKE
        Auth::loginUsingId(1);

        $slideShowImages = Banner::where('position', 0)->where('status', 1)->get();
        $topBanners = Banner::where('position', 1)->where('status', 1)->take(2)->get();
        $middleBanners = Banner::where('position', 2)->where('status', 1)->take(2)->get();
        $bottomBanner = Banner::where('position', 3)->where('status', 1)->first();
        $brands = Brand::all();
        $mostVisitedProducts = Product::latest()->take(10)->get();
        $offerProducts = Product::latest()->take(10)->get();
        return view('customer.home', compact('slideShowImages', 'topBanners', 'middleBanners', 'bottomBanner', 'brands', 'mostVisitedProducts', 'offerProducts'));
    }

    public function products(Request $request)
    {

        switch ($request->sort) {
            case "1":
                $column = 'created_at';
                $direction = 'DESC';
                break;

                //TODO for rating sort
                // case "2":
                //     $column = 'rate';
                //     $direction = '';
                //     break;
            case "3":
                $column = 'price';
                $direction = 'DESC';
                break;
            case "4":
                $column = 'price';
                $direction = 'ASC';
                break;
            case "5":
                $column = 'view';
                $direction = 'DESC';
                break;
            case "6":
                $column = 'sold_number';
                $direction = 'DESC';
                break;
            default:
                $column = 'created_at';
                $direction = 'ASC';
        }


        if ($request->search) {
            $products = Product::where('name', 'LIKE', "%" . $request->search . "%")->orderBy($column, $direction)->get();
        }else{
            $products = Product::orderBy($column, $direction)->get();
        }

        return view('customer.market.product.products', compact('products'));
    }
}
