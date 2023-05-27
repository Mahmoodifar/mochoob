@extends('Admin.layouts.master')

@section('head-tag')
    <title>ویژگی های فرم کالا</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.property.index', $categoryAttribute->id) }}"> فرم کالا</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویژگی های فرم کالا</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>ویژگی های فرم کالا</h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.market.value.create', $categoryAttribute->id) }}"
                        class="btn btn-info btn-sm">ایجاد ویژگی جدید فرم کالا</a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">نام فرم</th>
                                <th class="text-center">نام محصول</th>
                                <th class="text-center">دسته والد</th>
                                <th class="text-center">واحد اندازه گیری</th>
                                <th class="text-center">مقدار</th>
                                <th class="text-center">مبلغ اضافه شده برای ویژگی</th>
                                <th class="text-center">نوع</th>
                                <th class="max-whidth-16-rem text-left pl-5"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoryAttribute->values as $value)
                                <tr>
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <th class="text-center">{{ $categoryAttribute->name }}</th>
                                    <td class="text-center">{{ $value->product->name }}</td>
                                    <td class="text-center">{{ $categoryAttribute->category->name }}</td>
                                    <th class="text-center">{{ $categoryAttribute->unit }}</th>
                                    <td class="text-center">{{ json_decode($value->value)->value }}</td>
                                    <td class="text-center">{{ json_decode($value->value)->price_increase }}</td>
                                    <td class="text-center">{{ $value->type == 0 ? 'ساده' : 'انتخابی' }}</td>
                                    <td class="width-22-rem text-left">
                                        <a href="{{ route('admin.market.value.edit', ['categoryAttribute' => $categoryAttribute->id, 'value' => $value->id]) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                            ویرایش</a>
                                        <form
                                            action="{{ route('admin.market.value.destroy', ['categoryAttribute' => $categoryAttribute->id, 'value' => $value->id]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <button class="btn btn-danger btn-sm delete" type="submit"><i
                                                    class="fa fa-trash-alt"></i>
                                                حذف</button>
                                        </form>
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
@section('script')
    @include('Admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
