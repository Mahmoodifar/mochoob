@extends('Admin.layouts.master')

@section('head-tag')
    <title>نظرات</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرات </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>نظرات</h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد نظر جدید </a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نظر</th>
                                <th>پاسخ به</th>
                                <th>کد کاربر</th>
                                <th>نویسنده نظر</th>
                                <th>کد پست</th>
                                <th>پست</th>
                                <th>وضعیت تایید</th>
                                <th>وضعیت</th>
                                <th class="max-whidth-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($comments as $key => $comment)
                                <tr>
                                    <th>{{ $key + 1 }}</th>
                                    <th>{{ Str::limit($comment->body, 10) }}</th>
                                    <th>
                                        <a href="{{ route('admin.market.comment.show', $comment->id) }}">
                                            {{ $comment->parent_id ? Str::limit($comment->parent->body, 10) : '' }}
                                        </a>
                                    </th>
                                    <td>{{ $comment->author_id }}</td>
                                    <td>{{ $comment->user->fullName }}</td>
                                    <td>{{ $comment->commentable->id }}</td>
                                    <td>{{ $comment->commentable->name }}</td>
                                    <td>{{ $comment->approved == 1 ? 'تایید شده' : 'تایید نشده' }}</td>
                                    <td>
                                        <label>
                                            <input id="{{ $comment->id }}" onchange="changeStatus('{{ $comment->id }}')"
                                                data-url="{{ route('admin.market.comment.status', $comment->id) }}"
                                                type="checkbox" @if ($comment->status == 1) checked @endif>
                                        </label>
                                    </td>
                                    <td class="width-16-rem text-left">
                                        <a href="{{ route('admin.market.comment.show', $comment->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-eye"></i> نمایش</a>

                                        @if ($comment->approved == 0)
                                            <a href="{{ route('admin.market.comment.approved', $comment->id) }}"
                                                class="btn btn-success btn-sm" type="submit"
                                                onclick="approved($comment->id)"><i class="fa fa-check "></i> تایید</a>
                                        @else
                                            <a href="{{ route('admin.market.comment.approved', $comment->id) }}"
                                                class="btn btn-warning btn-sm text-white" type="submit"
                                                onclick="approved($comment->id)"><i class="fa fa-clock"></i> عدم تایید</a>
                                        @endif
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

{{-- scrips --}}
{{-- ----------------------- --}}
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
                                                successToast(' پست با موفقیت فعال شد');
                                            }
                                            else
                                            {
                                                element.prop('checked',false);
                                                successToast(' پست با موفقیت غیر فعال شد');
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


    <script type="text/javaScript">
        function approved(id)
                        {
                            var element = $("#" + id + '-approved');
                            var url = element.attr('data-url')
                            var elementValue = !element.prop('checked');

                            $.ajax({
                                url : url,
                                type: "GET",
                                success: function(response)
                                {
                                    if (response.approved)
                                    {
                                        if(response.checked)
                                        {
                                            element.prop('checked',true);
                                            successToast(' درج نظر با موفقیت فعال شد');
                                        }
                                        else
                                        {
                                            element.prop('checked',false);
                                            successToast(' درج نظر با موفقیت غیر فعال شد');
                                        }
                                    }
                                    else
                                        {
                                        element.prop('checked',elementValue);
                                        errorToast('هنگام ویرایش پست مشکلی پیش آمده است');
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
@endsection
