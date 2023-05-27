@extends('Admin.layouts.master')

@section('head-tag')
    <title>ایجاد نقش جدید</title>
@endsection



@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.user.role.index') }}"> نقش ها</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد نقش جدید</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>ایجاد نقش جدید</h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>

                <section>
                    <form action="{{ route('admin.user.role.store') }}" method="POST">
                        @csrf

                        <section class="row d-flex justify-content-between">

                            <section class="col-12 col-md-5">
                                <div class="form-group ">
                                    <label for="">عنوان نقش</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control
                                        form-control-sm">
                                </div>
                                @error('name')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-5">
                                <div class="form-group ">
                                    <label for="">توضیح نقش</label>
                                    <input type="text" name="description" value="{{ old('description') }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('description')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-2 ">
                                <button class="btn btn-primary btn-sm mt-md-4">ثبت</button>
                            </section>
                        </section>
                        <section class="col-12">
                            <section class="row border-top mt-3 py-3">
                                @foreach ($permissions as $key => $permission)

                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->id }}" checked>
                                            <label class="form-check-label mr-3 mt-1"
                                                for="{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                        <div class="mt-2">
                                            @error('permissions.' . $key)
                                            <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </section>
                                @endforeach
                            </section>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>
@endsection
