@extends('Admin.layouts.master')

@section('head-tag')
    <title>روش های ارسال</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">  روش های ارسال </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5> روش های ارسال </h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="{{route('admin.market.delivery.create')}}" class="btn btn-info btn-sm">ایجاد روش ارسال جدید</a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">نام روش ارسال</th>
                                <th class="text-center"> هزینه ارسال</th>
                                <th class="text-center"> زمان ارسال</th>
                                <th class="text-center">واحد زمان ارسال</th>
                                <th class="text-center">وضعیت</th>
                                <th class="max-whidth-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($delivery_methods as $delivery_method)
                            <tr>
                                <th class="text-center">{{$loop->iteration}}</th>
                                <td class="text-center">{{$delivery_method->name}}</td>
                                <td class="text-center">{{$delivery_method->amount}} تومان</td>
                                <td class="text-center">{{$delivery_method->delivery_time}}</td>
                                <td class="text-center">{{$delivery_method->delivery_time_unit}}</td>
                                <td class="text-center">
                                    <label>
                                        <input id="{{ $delivery_method->id }}" onchange="changeStatus('{{ $delivery_method->id }}')"
                                            data-url="{{ route('admin.market.delivery.status', $delivery_method->id) }}"
                                            type="checkbox" @if ($delivery_method->status == 1) checked @endif>
                                    </label>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.delivery.edit', $delivery_method->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form action="{{ route('admin.market.delivery.destroy', $delivery_method->id) }}" method="POST" class="d-inline">
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
