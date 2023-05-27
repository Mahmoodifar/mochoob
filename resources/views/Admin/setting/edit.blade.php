@extends('Admin.layouts.master')

@section('head-tag')
    <title>ویرایش تنظیمات سایت</title>
@endsection



@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش تنظیمات</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.setting.index') }}"> دسته بندی </a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش تنظیمات سایت</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5> ویرایش تنظیمات سایت</h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.content.category.index') }}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>

                <section>
                    <form action="{{ route('admin.setting.update', $setting->id) }}" method="POST"
                        enctype="multipart/form-data" id="form">
                        @csrf
                        {{ method_field('put') }}
                        <section class="row d-flex justify-content-between">
                            <section class="col-12 my-2">
                                <div class="form-group ">
                                    <label for="title">عنوان سایت</label>
                                    <input type="text" value="{{ old('title', $setting->title) }}" name="title"
                                        id="title" class="form-control form-control-sm">
                                </div>
                                @error('title')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 my-2">
                                <div class="form-group ">
                                    <label for="description">توضیحات سایت</label>
                                    <textarea name="description" id="description" rows="1" class="form-control form-control-sm">{{ old('description', $setting->description) }}</textarea>
                                </div>
                                @error('description')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 my-2">
                                <div class="form-group ">
                                    <label for="keywords">کلمات کلیدی سایت</label>
                                    <input type="text" value="{{ old('keywords', $setting->keywords) }}" name="keywords"
                                        id="title" class="form-control form-control-sm">
                                </div>
                                @error('keywords')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="icon">ایکون</label>
                                    <input type="file" id="icon" name="icon"
                                        class="form-control form-control-sm">
                                </div>
                                @error('icon')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="logo">لوگو</label>
                                    <input type="file" id="logo" name="logo"
                                        class="form-control form-control-sm">
                                </div>
                                @error('logo')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 my-3">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>


            </section>
        </section>
    </section>
@endsection
