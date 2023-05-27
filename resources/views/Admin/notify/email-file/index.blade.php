@extends('Admin.layouts.master')

@section('head-tag')
    <title>فایل های اطلاعیه ایمیلی</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.notify.email.index') }}"> اطلاعیه ایمیلی</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> فایل های اطلاعیه ایمیلی</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5> فایل های اطلاعیه ایمیلی</h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.notify.email-file.create', $email->id) }}" class="btn btn-info btn-sm">ایجاد
                        فایل اطلاعیه ایمیلی</a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">عنوان فایل</th>
                                <th class="text-center">سایز فایل</th>
                                <th class="text-center">نوع فایل</th>
                                <th class="text-center">وضعیت</th>
                                <th class="text-center">مسیر ذخیره سازی</th>
                                <th class="max-whidth-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($email->files as $key => $file)
                                <tr>
                                    <th>{{ $key + 1 }}</th>
                                    <td class="text-center">{{ $email->subject }} </td>
                                    <td class="text-center">{{ $file->file_size }}</td>
                                    <td class="text-center">{{ $file->file_type }}</td>
                                    <td class="text-center">
                                        <label>
                                            <input id="{{ $file->id }}" onchange="changeStatus('{{ $file->id }}')"
                                                data-url="{{ route('admin.notify.email-file.status', $file->id) }}"
                                                type="checkbox" @if ($file->status == 1) checked @endif>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        {{ $file->path == 0 ? 'Public' : 'Storage' }}
                                    </td>
                                    <td class="width-18-rem text-left">
                                        <a href="{{ route('admin.notify.email-file.edit', $file->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                        <form action="{{ route('admin.notify.email-file.destroy', $file->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <button class="btn btn-danger btn-sm delete" type="submit"><i
                                                    class="fa fa-trash-alt"></i> حذف</button>
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
                                                    successToast(' ایمیل با موفقیت فعال شد');
                                                }
                                                else
                                                {
                                                    element.prop('checked',false);
                                                    successToast(' ایمیل با موفقیت غیر فعال شد');
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
