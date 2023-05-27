@extends('Admin.layouts.master')

@section('head-tag')
    <title> نقش کاربر</title>
@endsection



@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.user.admin-user.index') }}"> کاربر ادمین</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> سطح دسترسی کاربر</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>نفش کاربر</h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>

                <section>
                    <form action="{{ route('admin.user.admin-user.permissions.store', $admin) }}" method="POST">
                        @csrf

                        <section class="row d-flex justify-content-between">

                            <section class="col-12 col-md-6">
                                <div class="form-group ">
                                    <label for="select_permissions">نام</label>
                                    <select multiple name="permissions[]" class="form-control form-control-sm" id="select_permissions">
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}"
                                                @foreach ($admin->permissions as $user_permission)
                                                    @if ($user_permission->id === $permission->id)
                                                        selected
                                                        @endif @endforeach>
                                                {{ $permission->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('name')
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
@section('script')
    <script>
        var select_permissions = $('#select_permissions');
        select_permissions.select2({
            placeholder: 'لطفا سطج دسترسی را وارد کنید',
            multiple: true,
            tag: true,
        })
    </script>
@endsection
