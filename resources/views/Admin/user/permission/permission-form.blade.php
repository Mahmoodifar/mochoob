@extends('Admin.layouts.master')

@section('head-tag')
    <title>ویرایش سطوح دسترسی</title>
@endsection



@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.user.role.index') }}"> نقش ها</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش سطوح دسترسی</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>ویرایش سطوح دسترسی</h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>

                <section>
                    <form action="{{ route('admin.user.role.permission-update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <section class="row d-flex justify-content-between">

                            <section class="col-12 col-md-6">
                                <div class="form-group ">
                                    <label for="">عنوان نقش</label>

                                    <section>{{ $role->name }}</section>
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group ">
                                    <label for="">توضیح نقش</label>
                                    <section>{{ $role->description }}</section>
                                </div>
                            </section>

                        </section>
                        <section class="col-12">
                            <section class="row border-top mt-3 py-3">

                                @php
                                    $rolePermissioms = $role->permissions->pluck('id')->toArray();
                                @endphp

                                @foreach ($permissions as $key => $permission)
                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="permissions[]"
                                                value="{{ $permission->id }}" id="{{ $permission->id }}"
                                                @if (in_array($permission->id, $rolePermissioms)) checked @endif>
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
                        <section class="col-12 ">
                            <button class="btn btn-primary btn-sm mt-md-4">ثبت</button>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>
@endsection
