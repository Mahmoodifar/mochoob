@extends('Admin.layouts.master')

@section('head-tag')
    <title>کوپن تخفیف </title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کوپن تخفیف </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>کوپن تخفیف </h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.market.discount.create') }}" class="btn btn-info btn-sm">ایجاد کوپن تخفیف</a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">کد کوپن </th>
                                <th class="text-center">میزان تخفیف</th>
                                <th class="text-center">نوع تخفیف</th>
                                <th class="text-center">سقف تخفیف</th>
                                <th class="text-center">نوع کوپن</th>
                                <th class="text-center">تاریخ شروع</th>
                                <th class="text-center">تاریخ پایان</th>
                                <th class="text-center">وضعیت</th>

                                <th class="max-whidth-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($copans as $copan)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td class="text-center">{{ $copan->code }}</td>
                                    <td class="text-center">
                                        {{ $copan->amount_type == 0 ? $copan->amount . '%' : $copan->amount . ' هزار تومان ' }}
                                    </td>
                                    <td class="text-center">{{ $copan->amount_type == 0 ? 'درصدی' : 'نقدی' }}</td>
                                    <td class="text-center">
                                        {{ $copan->discount_ceiling == null ? '-' : $copan->discount_ceiling . ' ' }}</td>
                                    <td class="text-center">{{ $copan->type == 0 ? 'عمومی' : 'خوصوصی' }}</td>
                                    <td class="text-center">
                                        {{ jalaliDate($copan->start_date, '%A, %d %B %y ساعت :  H:i:s') }}</td>
                                    <td class="text-center">{{ jalaliDate($copan->end_date, '%A, %d %B %y ساعت :  H:i:s') }}
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input id="{{ $copan->id }}"
                                                onchange="changeStatusCopan('{{ $copan->id }}')"
                                                data-url="{{ route('admin.market.discount.copanStatus', $copan->id) }}"
                                                type="checkbox" @if ($copan->status == 1) checked @endif>
                                        </label>
                                    </td>
                                    <td class="width-16-rem text-left">
                                        <a href="{{ route('admin.market.discount.copanEdit', $copan->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                        <form action="{{ route('admin.market.discount.copanDelete', $copan->id) }}"
                                            method="POST" class="d-inline">
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
        function changeStatusCopan(id)
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
                                successToast(' تخفیف شما با موفقیت فعال شد');
                            }
                            else
                            {
                                 element.prop('checked',false);
                                 successToast('تخفیف شما با موفقیت غیر فعال شد');
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
