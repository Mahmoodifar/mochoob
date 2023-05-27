@extends('customer.layouts.master-simple')
@section('head-tag')
    <style>
        #resend-otp {
            font-size: 1rem;
        }
    </style>
@endsection
@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
        <form action="{{ route('auth.customer.login-confirm-form', $token) }}" method="post">
            @csrf
            <section class="login-wrapper mb-5">
                <section class="login-logo">
                    <img src="{{ asset('customer-assets/images/logo/4.png') }}" alt="">
                </section>
                <section class="login-title my-2">
                    <a href="{{ route('auth.customer.login-register-form') }}" class="href">
                        <i class="fa fa-arrow-left"></i></a>
                </section>
                <section class="login-title">
                    لطفا کد تایید را وارد کنید
                </section>
                <section class="login-info">
                    @if ($otp->type == 0)
                        کد تایید به شماره موبایل {{ $otp->login_id }} ارسال گردید
                    @else
                        کد تایید به ایمیل {{ $otp->login_id }} ارسال گردید
                    @endif

                </section>
                <section class="login-input-text">
                    <input type="text" name="otp" value="{{ old('otp') }}">
                </section>
                @error('otp')
                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                        <strong>
                            {{ $message }}
                        </strong>
                    </span>
                @enderror
                <section class="login-btn d-grid g-2"><button class="btn btn-danger mt-2">تایید</button></section>
                <section id="resend-otp" class="d-none">
                    <a href="{{ route('auth.customer.login-resend-otp', $token) }}"
                        class="text-decoration-none text-primary">دریافت مجدد کد تایید</a>
                </section>
                <section id="timer"></section>
            </section>

    </section>
    </form>

    </section>
@endsection
@section('script')
    @php
        $timer = ((new \Carbon\Carbon($otp->created_at))->addMinutes(5)->timestamp - \Carbon\Carbon::now()->timestamp) * 1000;
    @endphp

    <script>
        var countDownDate = new Date().getTime() + {{ $timer }};
        var timer = $('#timer');
        var resendOtp = $('#resend-otp');

        var x = setInterval(function() {

            var now = new Date().getTime();

            var distance = countDownDate - now;

            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (minutes == 0) {
                timer.html('ارسال مجدد کد تایید تا ' + seconds + 'ثانیه دیگر')
            } else {
                timer.html('ارسال مجدد کد تایید تا ' + minutes + 'دقیقه و ' + seconds + 'ثانیه دیگر');
            }
            if (distance < 0) {
                clearInterval(x);
                timer.addClass('d-none');
                resendOtp.removeClass('d-none');
            }

        }, 1000)
    </script>
@endsection
