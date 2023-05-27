@extends('Admin.layouts.master')

@section('head-tag')
    <title>ویرایش ویژگی فرم کالا</title>
@endsection



@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.value.index',$categoryAttribute->id) }}"> فرم کالا</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش ویژگی فرم کالا</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5> ویرایش ویژگی فرم کالا</h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.market.value.index',$categoryAttribute->id) }}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>

                <section>
                    <form action="{{ route('admin.market.value.update',['categoryAttribute' => $categoryAttribute->id, 'value' => $value->id]) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <section class="row d-flex justify-content-between">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="product_id">انتخاب محصول </label>
                                    <select name="product_id" id="product_id" class="form-control form-control-sm">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach ($categoryAttribute->category->products as $product)
                                            <option value="{{ $product->id }}"
                                                @if (old('product_id',$value->product_id) == $product->id) selected @endif>{{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('product_id')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="value">مقدار</label>
                                    <input type="text" id="value" name="value" class="form-control form-control-sm"
                                        value="{{ old('value',json_decode($value->value)->value) }}">
                                </div>
                                @error('value')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="price_increase">قیمت ویژگی کالا</label>
                                    <input type="text" name="price_increase" id="price_increase" value="{{ old('price_increase',json_decode($value->value)->price_increase) }}"
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

                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="type">نوع</label>
                                    <select name="type" id="type" class="form-control form-control-sm">
                                        <option value="0" @if (old('type',$value->type) == 0) selected @endif>ساده
                                        </option>
                                        <option value="1" @if (old('type',$value->type) == 1) selected @endif>انتخابی
                                        </option>
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
