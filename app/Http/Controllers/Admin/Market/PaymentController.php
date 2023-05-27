<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {

        $payments = Payment::orderBy('created_at', 'desc')->simplePaginate(15);

        return view('Admin.market.payment.index', compact('payments'));
    }
    public function online()
    {
        $payments = Payment::where('paymentable_type', 'App\Models\Market\OnlinePayment')->get();
        return view('Admin.market.payment.index', compact('payments'));
    }
    public function offline()
    {
        $payments = Payment::where('paymentable_type', 'App\Models\Market\OfflinePayment')->get();
        return view('Admin.market.payment.index', compact('payments'));
    }
    public function cash()
    {
        $payments = Payment::where('paymentable_type', 'App\Models\Market\CashPayment')->get();
        return view('Admin.market.payment.index', compact('payments'));
    }
    public function confirm(Payment $payment)
    {
        $payment->status = 1;
        $payment->save();
        return redirect()->back()->with('swal-success', 'تغییرات شما با موفقیت انجام شد');
    }

    public function canceled(Payment $payment)
    {
        $payment->status = 2;
        $payment->save();
        return redirect()->back()->with('swal-success', 'تغییرات شما با موفقیت انجام شد');
    }

    public function returned(Payment $payment)
    {
        $payment->status = 3;
        $payment->save();
        return redirect()->back()->with('swal-success', 'تغییرات شما با موفقیت انجام شد');
    }

    public function show(Payment $payment)
    {
        return view('Admin.market.payment.show', compact('payment'));

    }
}
