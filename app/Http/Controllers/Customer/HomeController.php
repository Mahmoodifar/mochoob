<?php

namespace App\Http\Controllers\Customer;

use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Models\Content\Banner;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Models\Market\ProductCategory;
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

    public function products(Request $request, ProductCategory $category = null)
    {
        //select category
        if ($category) {
            $productModel = $category->products();
        } else {
            $productModel = new Product();
        }

        $request['max_price'] = convertPersianToEnglish($request->max_price);
        $request['min_price'] = convertPersianToEnglish($request->min_price);
        $request['max_price'] = convertArabicToEnglish($request->max_price);
        $request['min_price'] = convertArabicToEnglish($request->min_price);

        //brands

        $brands = Brand::all();
        $categories = ProductCategory::whereNull('parent_id')->get();
        //set sorting form fillter
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
            $query = $productModel->where('name', 'LIKE', "%" . $request->search . "%")->orderBy($column, $direction);
        } else {
            $query = $productModel->orderBy($column, $direction);
        }
        $products = $request->min_price && $request->max_price ? $query->whereBetween('price', [$request->min_price, $request->max_price]) :
            $query->when($request->min_price, function ($query) use ($request) {
                $query->where('price', '>=', $request->min_price)->get();
            })->when($request->max_price, function ($query) use ($request) {
                $query->where('price', '<=', $request->max_price)->get();
            })->when(!($request->min_price && $request->max_price), function ($query) {
                $query->get();
            });

        $products = $products->when($request->brands, function ($products) use ($request) {
            $products->whereIn('brand_id', $request->brands);
        });

        //TODO create options for number page in customer.products
        $products = $products->paginate(15);

        //forward queries in pages
        $products->appends($request->query());
        //select original name brands
        $selectedArrayBrands = [];
        if ($request->brands) {

            $selectedBrands = Brand::find($request->brands);

            foreach ($selectedBrands as $selectedBrand) {
                array_push($selectedArrayBrands, $selectedBrand->original_name);
            }
        }


        return view('customer.market.product.products', compact('products', 'brands', 'selectedArrayBrands', 'categories'));
    }
}
