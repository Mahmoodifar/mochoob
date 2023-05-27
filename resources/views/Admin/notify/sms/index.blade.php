@extends('Admin.layouts.master')

@section('head-tag')
    <title>اطلاعیه پیامکی</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> اطلاعیه پیامکی</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>اطلاعیه پیامکی</h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.notify.sms.create') }}" class="btn btn-info btn-sm">ایجاد اطلاعیه پیامکی</a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">عنوان پیام</th>
                                <th class="text-center">متن پیام</th>
                                <th class="text-center">تاریخ ارسال</th>
                                <th class="text-center">وضعیت</th>
                                <th class="max-whidth-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SMS as $key => $single_sms)
                                <tr>
                                    <th>{{ $key + 1 }}</th>
                                    <td class="text-center">{{ $single_sms->title }}</td>
                                    <td class="text-center">{{ $single_sms->body }}</td>
                                    <td class="text-center">{{ jalaliDate($single_sms->published_at,'%A, %d %B %y ساعت :  H:i:s') }}</td>
                                    <td class="text-center">
                                        <label>
                                            <input id="{{ $single_sms->id }}" onchange="changeStatus('{{ $single_sms->id }}')"
                                                data-url="{{ route('admin.notify.sms.status', $single_sms->id) }}"
                                                type="checkbox" @if ($single_sms->status == 1) checked @endif>
                                        </label>
                                    </td>
                                    <td class="width-16-rem text-left">
                                        <a href="{{ route('admin.notify.sms.edit', $single_sms->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                        <form action="{{ route('admin.notify.sms.destroy', $single_sms->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        {{method_field('delete')}}
                                        <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i>
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
                                        successToast(' پیامک با موفقیت فعال شد');
                                    }
                                    else
                                    {
                                        element.prop('checked',false);
                                        successToast(' پیامک با موفقیت غیر فعال شد');
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
