<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\User;
use App\Models\Market\Copan;
use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\AmazingSale;
use App\Http\Controllers\Controller;
use App\Models\Market\CommonDiscount;
use App\Http\Requests\Admin\Market\CopanRequest;
use App\Http\Requests\Admin\Market\AmazingSaleRequest;
use App\Http\Requests\Admin\Market\CommonDiscountRequest;

class DiscountController extends Controller
{
    public function copan()
    {
        $copans = Copan::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('Admin.market.discount.copan', compact('copans'));
    }

    public function copanCreate()
    {
        $users = User::all();
        return view('Admin.market.discount.copan-create', compact('users'));
    }

    public function copanStore(CopanRequest $request)
    {
        $inputs = $request->all();

        //fixed time
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $realTimestampStart = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

        if ($inputs['type'] == 0) {
            $inputs['user_id'] = null;
        }
        $resutl = Copan::create($inputs);
        return redirect()->route('admin.market.discount.copan')->with('swal-success', 'کد تخفیف شما با موفقیت ثبت شد ');
    }

    public function copanEdit(Copan $copan)
    {
        $users = User::all();
        return view('Admin.market.discount.copan-edit', compact('copan','users'));
    }

    public function copanUpdate(CopanRequest $request, Copan $copan)
    {
        $inputs = $request->all();

        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $realTimestampStart = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        //TODO check this code for update copans user_id null for type public
        if ($inputs['type'] == 0) {
            $inputs['user_id'] = null;
        }
        $resutl = $copan->update($inputs);
        return redirect()->route('admin.market.discount.copan')->with('swal-success', 'کد تخفیف شما با موفقیت ویرایش شد');
    }

    public function copanDelete(Copan $copan)
    {
        $result = $copan->delete();
        return redirect()->route('admin.market.discount.copan')->with('swal-success', ' کد  تخفیف شما با موفقیت حذف شد');
    }

    public function copanStatus(Copan $copan)
    {
        $copan->status = $copan->status == 0 ? 1 : 0;
        $result = $copan->save();

        if ($result) {

            if ($copan->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
    //common discount

    public function commonDiscount()
    {
        $commonDiscounts = CommonDiscount::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('Admin.market.discount.common', compact('commonDiscounts'));
    }

    public function commonDiscountCreate()
    {
        return view('Admin.market.discount.common-create');
    }

    public function commonDiscountStore(CommonDiscountRequest $request)
    {
        $inputs = $request->all();

        //fixed time
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $realTimestampStart = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $resutl = CommonDiscount::create($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', ' تخفیف شما با موفقیت ثبت شد');
    }

    public function commonDiscountEdit(CommonDiscount $common)
    {
        return view('Admin.market.discount.common-edit', compact('common'));
    }

    public function commonDiscountUpdate(CommonDiscountRequest $request, CommonDiscount $common)
    {
        $inputs = $request->all();

        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $realTimestampStart = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $resutl = $common->update($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', ' تخفیف شما با موفقیت ویرایش شد');
    }

    public function commonDiscountDelete(CommonDiscount $common)
    {
        $result = $common->delete();
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', ' تخفیف شما با موفقیت حذف شد');
    }
    public function commonStatus(CommonDiscount $common)
    {
        $common->status = $common->status == 0 ? 1 : 0;
        $result = $common->save();

        if ($result) {

            if ($common->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }


    //amazing sale
    public function amazingSale()
    {
        $amazingSales = AmazingSale::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('Admin.market.discount.amazing', compact('amazingSales'));
    }

    public function amazingSaleCreate()
    {
        $products = Product::all();
        return view('Admin.market.discount.amazing-create', compact('products'));
    }

    public function amazingSaleStore(AmazingSaleRequest $request)
    {
        $inputs = $request->all();

        //fixed time
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $realTimestampStart = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $resutl = AmazingSale::create($inputs);
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', ' تخفیف شگفت انگیز شما با موفقیت ثبت شد');
    }

    public function amazingSaleEdit(AmazingSale $amazing)
    {
        $products = Product::all();
        return view('Admin.market.discount.amazing-edit', compact('amazing', 'products'));
    }

    public function amazingSaleUpdate(AmazingSaleRequest $request, AmazingSale $amazing)
    {
       $inputs = $request->all();

        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $realTimestampStart = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $resutl = $amazing->update($inputs);

        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', ' تخفیف شگفت انگیز شما با موفقیت ویرایش شد');
    }

    public function amazingSaleDelete(AmazingSale $amazing)
    {
        $result = $amazing->delete();
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', ' تخفیف شگفت انگیز شما با موفقیت حذف شد');
    }

    public function amazingStatus(AmazingSale $amazing)
    {
        $amazing->status = $amazing->status == 0 ? 1 : 0;
        $result = $amazing->save();

        if ($result) {

            if ($amazing->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
