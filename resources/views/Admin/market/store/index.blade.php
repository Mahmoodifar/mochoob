@extends('Admin.layouts.master')

@section('head-tag')
    <title>انبار</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> انبار</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>انبار</h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد انبار
                        جدید</a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <td>نام کالا</td>
                                <td class="text-center">تصویر کالا</td>
                                <td class="text-center">تعداد قابل فروش</td>
                                <td class="text-center">تعداد رزرو شده</td>
                                <td class="text-center">تعداد فروخته شده</td>
                                <th class="max-whidth-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td class="text-center">{{ $product->name }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset($product->image['indexArray'][$product->image['currentImage']]) }}"
                                            alt="" class="max-height-2rem">
                                    </td>
                                    <td class="text-center"> {{ $product->marketable_number }}</td>
                                    <td class="text-center"> {{ $product->frozen_number }}</td>
                                    <td class="text-center"> {{ $product->sold_number }}</td>

                                    <td class="whidth-8-rem text-left">
                                        <a href="{{ route('admin.market.store.add-to-store',$product->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> افزایش
                                            موجودی</a>
                                        <a href="{{ route('admin.market.store.edit',$product->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> اصلاح
                                            موجودی</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>





            </section>
        </section>
    </section>
@endsection
