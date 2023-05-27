@extends('Admin.layouts.master')

@section('head-tag')
    <title>تنظیمات</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> بخش تنظیمات</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>بخش تنظیمات</h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد تنظیمات</a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان سایت</th>
                                <th>توضیحات سایت</th>
                                <th>کلمات کلیدی سایت</th>
                                <th>لوگو سایت</th>
                                <th>ایکون سایت</th>
                                <th class="max-whidth-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>{{$setting->title}}</td>
                                <td>{{$setting->description}}</td>
                                <td>{{$setting->keywords}}</td>
                                <td><img src="{{ asset($setting->logo) }}"alt="" class="max-height-4rem">
                            </td>
                            <td><img src="{{ asset($setting->icon) }}"alt="" class="max-height-4rem">
                                <td class="width-16-rem text-left">
                                    <a href="{{route('admin.setting.edit',$setting->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
