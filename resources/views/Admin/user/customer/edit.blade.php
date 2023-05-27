@extends('Admin.layouts.master')

@section('head-tag')
    <title>ویرایش کاربر مشتری</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.user.customer.index') }}"> کاربر مشتری</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کاربر مشتری</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>ویرایش کاربر مشتری</h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.user.customer.index') }}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>

                <section>
                    <form action="{{ route('admin.user.customer.update', $customer->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <section class="row d-flex justify-content-between">

                            <section class="col-12 col-md-6">
                                <div class="form-group ">
                                    <label for="">نام</label>
                                    <input type="text" name="first_name"
                                        value="{{ old('first_name', $customer->first_name) }}"
                                        class="form-control form-control-sm">
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
                                    <input type="text" name="last_name"
                                        value="{{ old('last_name', $customer->last_name) }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('last_name')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12  my-2">
                                <div class="form-group">
                                    <label for="profile_photo_path">تصویر</label>
                                    <input type="file" id="profile_photo_path" name="profile_photo_path"
                                        class="form-control form-control-sm">
                                    @if (!empty($customer->profile_photo_path))
                                        <img src="{{ asset($customer->profile_photo_path) }}" alt="" width="100"
                                            height="100" class="mt-3">
                                    @else
                                        تصویر وجود ندارد
                                    @endif



                                </div>
                                @error('profile_photo_path')
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
