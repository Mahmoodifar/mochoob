@extends('Admin.layouts.master')

@section('head-tag')
    <title>
        نمایش پرداخت </title>
@endsection



@section('content')
 {{-- this part for redirctBack --}}
    @php
        if ($payment->type == 0) {
            $route = 'online';
            $roteTitle = 'انلاین';
        } elseif ($payment->type == 1) {
            $route = 'offline';
            $roteTitle = 'افلاین';
        } else {
            $route = 'cash';
            $roteTitle = 'درمحل';
        }

    @endphp
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.payment.index') }}"> بخش پرداخت</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.payment.' . $route) }}"> پرداخت {{$roteTitle}}</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش پرداخت </li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5> نمایش پرداخت </h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.market.payment.' . $route) }}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>
                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                        <strong>{{ $payment->user->fullName }} - {{ $payment->user->id }}</strong>
                    </section>
                    <section class="card-body ">
                        <h5 class="card-title"> مبلغ : {{ $payment->paymentable->amount }}</h5>
                        <p class="card-text">نوع پرداخت :

                            @if ($payment->type == 0)
                                انلاین
                            @elseif ($payment->type == 1)
                                افلاین
                            @else
                                در محل
                            @endif
                        </p>
                        <p class="card-text">بانک : {{ $payment->gateway ?? '-' }}</p>
                        <p class="card-text">شماره پرداخت : {{ $payment->paymentable->transaction_id ?? '-' }}</p>
                        <p class="card-text">تاریخ پرداخت : {{ jalaliDate($payment->paymentable->pay_date,'%A, %d %B %y ساعت :  H:i:s') ?? '-' }}</p>
                        <p class="card-text">دریافت کننده : {{ $payment->paymentable->cash_receiver ?? '-' }}</p>
                    </section>
                </section>
            </section>
        </section>
    </section>
@endsection

@section('script')
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
    </script>
@endsection
