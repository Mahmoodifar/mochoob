<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Models\Address;
use App\Models\Province;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Models\Market\CartItem;
use App\Models\Market\Delivery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Customer\SalesProcess\StoreAddressRequest;
use App\Http\Requests\Customer\SalesProcess\UpdateAddressRequest;
use App\Http\Requests\Customer\SalesProcess\ChooseAddressAndDeliveryRequest;
use App\Models\Market\CommonDiscount;

class AddressController extends Controller
{
    public function addressAndDelivery()
    {

        //check prifile
        $user =  Auth::user();
        $provinces = Province::all();
        $cartItems = CartItem::where('user_id', $user->id)->get();
        $deliveryMethods = Delivery::where('status', 1)->get();


        if (empty($user->mobile) || empty($user->first_name) || empty($user->last_name) || empty($user->email) || empty($user->national_code)) {
            return redirect()->route('customer.sales-process.profile-completion');
        }

        if (empty(CartItem::where('user_id', $user->id)->count())) {
            return redirect()->route('customer.sales-process.cart');
        }
        return view('customer.sales-process.address-and-delivery', compact('cartItems', 'provinces', 'deliveryMethods'));
    }

    public function getCities(Province $province)
    {
        $cities = $province->cities;
        if ($cities != null) {
            return response()->json(['status' => true, 'cities' => $cities]);
        } else {
            return response()->json(['status' => false, 'cities' => null]);
        }
    }

    public function addAddress(StoreAddressRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = auth()->user()->id;
        $inputs['postal_code'] = convertArabicToEnglish($request->postal_code);
        $inputs['postal_code'] = convertPersianToEnglish($inputs['postal_code']);
        $inputs['no'] = convertArabicToEnglish($request->no);
        $inputs['no'] = convertPersianToEnglish($inputs['no']);
        $inputs['unit'] = convertArabicToEnglish($request->unit);
        $inputs['unit'] = convertPersianToEnglish($inputs['unit']);
        $address = Address::create($inputs);

        return redirect()->back();
    }

    public function updateAddress(Address $address, UpdateAddressRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = auth()->user()->id;
        $inputs['postal_code'] = convertArabicToEnglish($request->postal_code);
        $inputs['postal_code'] = convertPersianToEnglish($inputs['postal_code']);
        $inputs['no'] = convertArabicToEnglish($request->no);
        $inputs['no'] = convertPersianToEnglish($inputs['no']);
        $inputs['unit'] = convertArabicToEnglish($request->unit);
        $inputs['unit'] = convertPersianToEnglish($inputs['unit']);

        $address = $address->update($inputs);
        return redirect()->back();
    }

    public function chooseAddressAndDelivery(ChooseAddressAndDeliveryRequest $request)
    {
        $user = auth()->user();
        $inputs = $request->all();
        $cartItems = CartItem::where('user_id', $user->id)->get();

        //calc price
        $totalProductPrice = 0;
        $totalDiscount = 0;
        $totalFinalPrice = 0;
        $totalFinalDiscountPriceWithNumber = 0;

        foreach ($cartItems as $cartItem) {
            $totalProductPrice += $cartItem->cartItemProductPrice();
            $totalDiscount += $cartItem->cartItemProductDiscount();
            $totalFinalPrice += $cartItem->cartItemFinalPrice();
            $totalFinalDiscountPriceWithNumber += $cartItem->cartItemFinalDiscount();
        }

        //common discount
        $commonDiscount = CommonDiscount::where([['status', 1], ['end_date', '>', now()], ['start_date', '<', now()]])->first();
        if ($commonDiscount)
        {

            $inputs['common_discount_id'] =  $commonDiscount->id;

            $commonPercentageDiscountAmount = $totalFinalPrice * ($commonDiscount->percentage / 100);

            //max offer
            if ($commonPercentageDiscountAmount > $commonDiscount->discount_ceiling) {

                $commonPercentageDiscountAmount = $commonDiscount->discount_ceiling;
            }
            //minimala order
            if ($commonDiscount != null and $totalFinalPrice >= $commonDiscount->minimal_order_amount) {

                $finalPrice = $totalFinalPrice - $commonPercentageDiscountAmount;
            } else {

                $finalPrice = $totalFinalPrice;
            }
        } else {
            $commonPercentageDiscountAmount = null;
            $finalPrice = $totalFinalPrice;
        }

        $inputs['user_id'] = $user->id;
        $inputs['order_final_amount'] =  $finalPrice;
        $inputs['order_discount_amount'] =  $totalFinalDiscountPriceWithNumber;
        $inputs['order-common_discount_amount'] =  $commonPercentageDiscountAmount;
        $inputs['order_total_products_discount_amount'] =  $inputs['order_discount_amount'] + $inputs['order-common_discount_amount'];


        $order = Order::updateOrCreate(
            ['user_id' => $user->id, 'order_status' => 0],
            $inputs
        );
        return redirect()->route('customer.sales-process.payment');
    }
}
