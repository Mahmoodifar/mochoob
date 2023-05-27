@extends('Admin.layouts.master')

@section('head-tag')
    <title>نقش ها</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">نقش ها</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>نقش ها</h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.user.role.create') }}" class="btn btn-info btn-sm">ایجاد نقش جدید</a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <td>نقش ها</td>
                                <td>توضیحات نقش ها</td>
                                <td>سطح دسترسی</td>
                                <th class="max-whidth-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td>
                                        @if (empty(
                                            $role->permissions()->get()->toArray()
                                        ))
                                            <span class="text-danger">در حال حاضر هیچ سطح دسترسی برای این نقش تعریف
                                                نشده</span>
                                        @else
                                            @foreach ($role->permissions as $permission)
                                                {{ $permission->name }}
                                                <br>
                                            @endforeach
                                        @endif

                                    </td>
                                    <td class="width-22-rem text-left align-middle">
                                        <a href="{{ route('admin.user.role.permission-form', $role->id) }}"
                                            class="btn btn-success btn-sm"><i class="fa fa-user-graduate"></i>
                                            دسترسی
                                            ها</a>
                                        <a href="{{ route('admin.user.role.edit', $role->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                                            ویرایش</a>
                                        <form action="{{ route('admin.user.role.destroy', $role->id) }}" method="POST"
                                            class="d-inline">
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
