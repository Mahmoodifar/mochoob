@extends('Admin.layouts.master')

@section('head-tag')
    <title>کاربران ادمین</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کاربران ادمین</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>کاربران ادمین</h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.user.admin-user.create') }}" class="btn btn-info btn-sm">ایجاد ادمین جدید</a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ایمیل</td>
                                <th>شماره موبایل</td>
                                <th>نام</td>
                                <th>نام خانوادگی</td>
                                <th>تصویر</td>
                                <th>وضعیت</td>
                                <th>فعالسازی</td>
                                <th>نقش</td>
                                <th>سطح دسترسی</td>
                                <th class="max-whidth-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $key => $admin)
                                <tr>
                                    <td>{{ $key + 1 }}</th>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->mobile }}</td>
                                    <td>{{ $admin->first_name }}</td>
                                    <td>{{ $admin->last_name }}</td>
                                    <td>
                                        @if (!empty($admin->profile_photo_path))
                                            <img src="{{ asset($admin->profile_photo_path) }}" alt=""
                                                class="max-height-2rem ">
                                        @else
                                            تصویر وجود ندارد
                                        @endif


                                    </td>
                                    <td>
                                        <label>
                                            <input id="{{ $admin->id }}" onchange="changeStatus('{{ $admin->id }}')"
                                                data-url="{{ route('admin.user.admin-user.status', $admin->id) }}"
                                                type="checkbox" @if ($admin->status == 1) checked @endif>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input id="{{ $admin->id }}-activation"
                                                onchange="activation('{{ $admin->id }}')"
                                                data-url="{{ route('admin.user.admin-user.activation', $admin->id) }}"
                                                type="checkbox" @if ($admin->activation == 1) checked @endif>
                                        </label>
                                    </td>
                                    <td>
                                        @forelse ($admin->roles as $role)
                                            <div> {{ $role->name }}</div>
                                        @empty
                                            <div class="text-danger">برای این کاربر نقشی وجود ندارد</div>
                                        @endforelse
                                    </td>
                                    <td>
                                        @forelse ($admin->permissions as $permission)
                                            <div> {{ $permission->name }}</div>
                                        @empty
                                            <div class="text-danger">برای این کاربر سطح دسترسی وجود ندارد</div>
                                        @endforelse
                                    </td>
                                    <td class="width-22-rem text-left">
                                        <a href="{{ route('admin.user.admin-user.roles', $admin->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i> نقش</a>
                                        <a href="{{ route('admin.user.admin-user.edit', $admin->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                        <form action="{{ route('admin.user.admin-user.destroy', $admin->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-danger btn-sm delete"><i
                                                    class="fa fa-trash-alt"></i> حذف</button>
                                            <a href="{{ route('admin.user.admin-user.permissions', $admin->id) }}"
                                                class="btn btn-primary btn-sm mt-1"><i class="fa fa-edit"></i> سطوح
                                                دسترسی</a>
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
    <script type="text/javaScript">
        function changeStatus(id)
                                    {
                                        var element = $("#" + id);
                                        var url = element.attr('data-url')
                                        var elementValue = !element.prop('checked');

                                        $.ajax({
                                            url : url,
                                            type: "GET",
                                            success: function(response)
                                            {
                                                if (response.status)
                                                {
                                                    if(response.checked)
                                                    {
                                                        element.prop('checked',true);
                                                        successToast(' کاربر با موفقیت فعال شد');
                                                    }
                                                    else
                                                    {
                                                        element.prop('checked',false);
                                                        successToast(' کاربر با موفقیت غیر فعال شد');
                                                    }
                                                }
                                                else
                                                    {
                                                    element.prop('checked',elementValue);
                                                    errorToast('هنگام ویرایش مشکلی پیش آمده است');
                                                    }
                                            },
                                            error: function()
                                            {
                                                element.prop('checked',elementValue);
                                                errorToast('ارتباط برقرار نشد');
                                            }
                                        })

                                        function successToast(message)
                                        {
                                            var successToastTag = '<section class="toast" data-delay="5000">\n' +
                                                '<section class="toast-body py-3 d-flex bg-success text-white ">\n'+
                                                '<strong class="ml-auto">' + message + '</strong>\n' +
                                                '<button type="button" class="mr-2 close" data-dismiss="toasaria-label="Close">\n' +
                                                '<span aria-hidden="true">&times;</span>\n' +
                                                '</button>\n' +
                                                '</section>\n' +
                                                '</section>';

                                            $('.toast-wrapper').append(successToastTag);
                                            $('.toast').toast('show').delay(5500).queue(function () {
                                            $(this).remove();
                                            })
                                        }

                                        function errorToast(message)
                                        {
                                            var errorToastTag = '<section class="toast" data-delay="5000">\n' +
                                                '<section class="toast-body py-3 d-flex bg-danger text-white ">\n'+
                                                '<strong class="ml-auto">' + message + '</strong>\n' +
                                                '<button type="button" class="mr-2 close" data-dismiss="toasaria-label="Close">\n' +
                                                '<span aria-hidden="true">&times;</span>\n' +
                                                '</button>\n' +
                                                '</section>\n' +
                                                '</section>';

                                            $('.toast-wrapper').append(errorToastTag);
                                            $('.toast').toast('show').delay(5500).queue(function ()
                                            {
                                                $(this).remove();
                                            })
                                        }
                                }

                            function activation(id)
                                    {
                                        var element = $("#" + id + '-activation');
                                        var url = element.attr('data-url')
                                        var elementValue = !element.prop('checked');

                                        $.ajax({
                                            url : url,
                                            type: "GET",
                                            success: function(response)
                                            {
                                                if (response.activation)
                                                {
                                                    if(response.checked)
                                                    {
                                                        element.prop('checked',true);
                                                        successToast(' کاربر با موفقیت فعال شد');
                                                    }
                                                    else
                                                    {
                                                        element.prop('checked',false);
                                                        successToast(' کاربر با موفقیت غیر فعال شد');
                                                    }
                                                }
                                                else
                                                    {
                                                    element.prop('checked',elementValue);
                                                    errorToast('هنگام ویرایش مشکلی پیش آمده است');
                                                    }
                                            },
                                            error: function()
                                            {
                                                element.prop('checked',elementValue);
                                                errorToast('ارتباط برقرار نشد');
                                            }
                                        })

                                        function successToast(message)
                                        {
                                            var successToastTag = '<section class="toast" data-delay="5000">\n' +
                                                '<section class="toast-body py-3 d-flex bg-success text-white ">\n'+
                                                '<strong class="ml-auto">' + message + '</strong>\n' +
                                                '<button type="button" class="mr-2 close" data-dismiss="toasaria-label="Close">\n' +
                                                '<span aria-hidden="true">&times;</span>\n' +
                                                '</button>\n' +
                                                '</section>\n' +
                                                '</section>';

                                            $('.toast-wrapper').append(successToastTag);
                                            $('.toast').toast('show').delay(5500).queue(function () {
                                            $(this).remove();
                                            })
                                        }

                                        function errorToast(message)
                                        {
                                            var errorToastTag = '<section class="toast" data-delay="5000">\n' +
                                                '<section class="toast-body py-3 d-flex bg-danger text-white ">\n'+
                                                '<strong class="ml-auto">' + message + '</strong>\n' +
                                                '<button type="button" class="mr-2 close" data-dismiss="toasaria-label="Close">\n' +
                                                '<span aria-hidden="true">&times;</span>\n' +
                                                '</button>\n' +
                                                '</section>\n' +
                                                '</section>';

                                            $('.toast-wrapper').append(errorToastTag);
                                            $('.toast').toast('show').delay(5500).queue(function ()
                                            {
                                                $(this).remove();
                                            })
                                        }
                            }
                        </script>
    @include('Admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
