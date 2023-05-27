@extends('Admin.layouts.master')

@section('head-tag')
    <title>ویرایش موجودی انبار</title>
@endsection



@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.store.index') }}"> انبار</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش موجودی انبار</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5> ویرایش موجودی انبار</h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.market.store.index') }}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>

                <section>
                    <form action="{{ route('admin.market.store.update',$product->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <section class="row d-flex justify-content-between">


                            <section class="col-12">
                                <div class="form-group">
                                    <label for="sold_number">تعداد فروخته شده</label>
                                    <input type="text" id="sold_number" name="sold_number" class="form-control form-control-sm"
                                        value="{{ old('sold_number',$product->sold_number) }}">
                                </div>
                                @error('sold_number')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="frozen_number">تعداد رزرو شده</label>
                                    <input type="text" id="sold_number" name="frozen_number" class="form-control form-control-sm"
                                        value="{{ old('frozen_number',$product->frozen_number) }}">
                                </div>
                                @error('frozen_number')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="marketable_number">تعداد قابل فروش</label>
                                    <input type="text" id="marketable_number" name="marketable_number" class="form-control form-control-sm"
                                        value="{{ old('marketable_number',$product->marketable_number) }}">
                                </div>
                                @error('marketable_number')
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
