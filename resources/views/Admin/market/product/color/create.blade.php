@extends('Admin.layouts.master')

@section('head-tag')
    <title>ایجاد رنگ کالا</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">

@endsection



@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.color.index',$product->id) }}"> رنگ کالا ها</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد رنگ کالا</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>رنگ کالا ها</h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.market.color.index',$product->id) }}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>

                <section>
                    <form action="{{ route('admin.market.color.store',$product->id) }}" method="POST">
                        @csrf

                        <section class="row d-flex justify-content-between">

                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="color_name">نام</label>
                                    <input type="text" name="color_name" id="color_name" value="{{ old('color_name',) }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('color_name')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="color">رنگ</label>
                                    <input type="color" name="color" id="color" value="{{ old('color',) }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('color')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="price_increase">قیمت رنگ کالا</label>
                                    <input type="text" name="price_increase" id="price_increase" value="{{ old('price_increase') }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('price_increase')
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
