@extends('Admin.layouts.master')

@section('head-tag')
    <title>برند</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> برند ها </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>برند ها </h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.market.brand.create') }}" class="btn btn-info btn-sm">ایجاد برند </a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام برند</th>
                                <th>نام لاتین برند</th>
                                <th>لوگو</th>
                                <th>اسلاگ</th>
                                <th>تگ ها</th>
                                <th>وضعیت</th>
                                <th class="max-whidth-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $brand->persian_name }}</td>
                                    <td>{{ $brand->original_name }}</td>
                                    <td>
                                        @if (empty($brand->logo))
                                           لوگو وجود ندارد
                                        @else
                                            <img src="{{ asset($brand->logo['indexArray'][$brand->logo['currentImage']]) }}"
                                                alt="" class="max-height-4rem">
                                        @endif
                                    </td>
                                    <td>{{ $brand->slug }}</td>
                                    <td>{{ $brand->tags }}</td>
                                    <td>
                                        <label>
                                            <input id="{{ $brand->id }}" onchange="changeStatus('{{ $brand->id }}')"
                                                data-url="{{ route('admin.market.brand.status', $brand->id) }}"
                                                type="checkbox" @if ($brand->status == 1) checked @endif>
                                        </label>
                                    </td>

                                    <td class="width-16-rem text-left">
                                        <a href="{{ route('admin.market.brand.edit',$brand->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                                            ویرایش</a>
                                        <form action="{{ route('admin.market.brand.destroy', $brand->id) }}" method="POST"
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
                                        successToast(' منو شما با موفقیت فعال شد');
                                    }
                                    else
                                    {
                                         element.prop('checked',false);
                                         successToast('منو شما با موفقیت غیر فعال شد');
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

                    function showInMenu(id)
                    {
                        var element = $("#" + id + '-show_in_menu');
                        var url = element.attr('data-url')
                        var elementValue = !element.prop('checked');

                        $.ajax({
                            url : url,
                            type: "GET",
                            success: function(response)
                                                    {
                                if (response.show_in_menu)
                                {
                                    if(response.checked)
                                    {
                                        element.prop('checked',true);
                                        successToast(' منو شما با موفقیت فعال شد');
                                    }
                                    else
                                    {
                                         element.prop('checked',false);
                                         successToast('منو شما با موفقیت غیر فعال شد');
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
