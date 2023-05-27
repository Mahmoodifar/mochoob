@extends('Admin.layouts.master')

@section('head-tag')
    <title> ویرایش روش ارسال جدید</title>
@endsection



@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.delivery.index') }}"> روش های ارسال </a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش روش ارسال</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5> ویرایش روش ارسال</h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.market.delivery.index') }}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>

                <section>
                    <form action="{{ route('admin.market.delivery.update',$delivery->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <section class="row d-flex justify-content-between">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="">نام روش ارسال</label>
                                    <input type="text" name="name" value="{{ old('name', $delivery->name) }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('name')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="">هزینه ارسال</label>
                                    <input type="text" name="amount" value="{{ old('amount', $delivery->amount) }}"
                                        class="form-control form-control-sm">
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
                                    <label for="">زمان ارسال</label>
                                    <input type="text" name="delivery_time"
                                        value="{{ old('delivery_time', $delivery->delivery_time) }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('delivery_time')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="">واحد زمان ارسال</label>
                                    <input type="text" name="delivery_time_unit"
                                        value="{{ old('delivery_time_unit', $delivery->delivery_time_unit) }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('delivery_time_unit')
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
                                        <option value="0" @if (old('status', $delivery->status) == 0) selected @endif>غیرفعال
                                        </option>
                                        <option value="1" @if (old('status', $delivery->status) == 1) selected @endif>فعال
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
