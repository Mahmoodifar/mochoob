@extends('Admin.layouts.master')

@section('head-tag')
    <title>ایجاد کاربر ادمین</title>
@endsection



@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.user.admin-user.index') }}"> کاربر ادمین</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کاربر ادمین</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>ایجاد کاربر ادمین</h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>

                <section>
                    <form action="{{ route('admin.user.admin-user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <section class="row d-flex justify-content-between">

                            <section class="col-12 col-md-6">
                                <div class="form-group ">
                                    <label for="">نام</label>
                                    <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control form-control-sm">
                                </div>
                                @error('first_name')
                                <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group ">
                                    <label for="">نام خانوادگی</label>
                                    <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control form-control-sm">
                                </div>
                                @error('last_name')
                                <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group ">
                                    <label for="">ایمیل</label>
                                    <input type="text" name="email" value="{{old('email')}}" class="form-control form-control-sm">
                                </div>
                                @error('email')
                                <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group ">
                                    <label for="">شماره موبایل</label>
                                    <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control form-control-sm">
                                </div>
                                @error('mobile')
                                <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group ">
                                    <label for="">کلمه عبور</label>
                                    <input type="password" name="password" value="{{old('password')}}" class="form-control form-control-sm">
                                </div>
                                @error('password')
                                <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group ">
                                    <label for="">تکرار کلمه عبور</label>
                                            <input type="password" name="password_confirmation" value="{{old('password_confrimation ')}}" class="form-control form-control-sm">
                                </div>
                                @error('password_confrimation')
                                <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="profile_photo_path">تصویر</label>
                                    <input type="file" id="profile_photo_path" name="profile_photo_path" class="form-control form-control-sm">
                                </div>
                                @error('profile_photo_path')
                                <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="activition">وضعیت فعالسازی</label>
                                    <select name="activation" id="activation" class="form-control form-control-sm">
                                        <option value="0" @if (old('activation') == 0) selected @endif>غیرفعال
                                        </option>
                                        <option value="1" @if (old('activation') == 1) selected @endif>فعال
                                        </option>
                                    </select>
                                </div>
                                @error('activation')
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
