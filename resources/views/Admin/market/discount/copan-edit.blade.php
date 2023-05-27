@extends('Admin.layouts.master')

@section('head-tag')
    <title>ویرایش کوپن تخفیف</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection



@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.discount.copan') }}"> کوپن تخفیف</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کوپن تخفیف</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5> ویرایش کوپن تخفیف</h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.market.discount.copan') }}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.copanUpdate',$copan->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <section class="row d-flex justify-content-between">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="code">کد کوپن </label>
                                    <input type="text" value="{{old('code',$copan->code)}}" name="code" id="code"
                                        class="form-control form-control-sm">
                                </div>
                                @error('code')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="type">نوع تخفیف</label>
                                    <select name="type" id="type" class="form-control form-control-sm">
                                        <option value="0" @if (old('type',$copan->type) == 0) selected @endif>عمومی</option>
                                        <option value="1" @if (old('type',$copan->type) == 1) selected @endif>خصوصی</option>
                                    </select>
                                </div>
                                @error('type')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="users">نام کاربر</label>
                                    <select name="user_id" id="users" class="form-control form-control-sm"  {{$copan->type == 0 ? 'disabled' : ''}} >
                                        <option >کاربر را انتخاب کنید</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                @if (old('user_id',$copan->user_id) == $user->id) selected @endif>{{ $user->fullName}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_id')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="amount_type">نوع کوپن</label>
                                    <select name="amount_type" id="amount_type" class="form-control form-control-sm">
                                        <option value="0" @if (old('amount_type',$copan->amount_type) == 0) selected @endif>درصدی</option>
                                        <option value="1" @if (old('amount_type',$copan->amount_type) == 1) selected @endif>نقدی</option>
                                    </select>
                                </div>
                                @error('amount_type')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="amount">میزان تخفیف</label>
                                    <input type="text" name="amount" value="{{old('amount',$copan->amount)}}" class="form-control form-control-sm">
                                </div>
                                @error('amount')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="discount_ceiling">حداکثر تخفیف</label>
                                    <input type="text" name="discount_ceiling" value="{{old('discount_ceiling',$copan->discount_ceiling)}}" class="form-control form-control-sm">
                                </div>
                                @error('discount_ceiling')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2 my-2">
                                <div class="form-group ">
                                    <label for="start_date">تاریخ شروع</label>
                                    <input type="text" id="start_date" name="start_date"
                                        class="form-control form-control-sm  d-none">
                                    <input type="text" id="start_date_view" class="form-control form-control-sm">
                                </div>
                                @error('start_date')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2 my-2">
                                <div class="form-group">
                                    <label for="end_date">تاریخ پایان</label>
                                    <input type="text" id="end_date" name="end_date"
                                        class="form-control form-control-sm d-none">
                                    <input type="text" id="end_date_view" class="form-control form-control-sm">
                                </div>
                                @error('end_date')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="0" @if (old('status',$copan->status) == 0) selected @endif>غیرفعال
                                        </option>
                                        <option value="1" @if (old('status',$copan->status) == 1) selected @endif>فعال
                                        </option>
                                    </select>
                                </div>
                                @error('status')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>

                        </section>
                    </form>
                </section>


            </section>
        </section>
    </section>
@endsection
@section('script')
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#start_date',
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            });

            $('#end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#end_date',
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            });
        });
    </script>

    <script>
        $('#type').change(function(){

            if($('#type').find(':selected').val()=='1')
            {
                $('#users').removeAttr('disabled');
            }else{
                $('#users').attr('disabled','disabled');
            }

        })
    </script>
@endsection


