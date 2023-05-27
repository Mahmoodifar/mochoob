@extends('Admin.layouts.master')

@section('head-tag')
    <title>کالا ها</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محصول</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کالا ها</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>کالا ها</h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.market.product.create') }}" class="btn btn-info btn-sm ">ایجاد کالا جدید</a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">نام کالا</td>
                                <th class="text-center">تصویر کالا</td>
                                <th class="text-center">دسته</td>
                                <th class="text-center">برند</td>
                                <th class="text-center">قیمت</td>
                                <th class="text-center">وزن</td>
                                <th class="text-center">اسلاگ</td>
                                <th class="text-center">تگ ها</td>
                                <th class="text-center">وضعیت</td>
                                <th class="text-center">قابل فروش</td>
                                <th class="max-whidth-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)


                            <tr>
                                <th class="text-center">{{$loop->iteration}}</th>
                                <td class="text-center">{{$product->name}}</td>
                                <td>
                                    <img src="{{ asset($product->image['indexArray'][$product->image['currentImage']]) }}"
                                        alt="" class="max-height-2rem">
                                </td>
                                <td class="text-center">{{$product->category->name}}</td>
                                <td class="text-center">{{$product->brand->persian_name}}</td>
                                <td class="text-center">{{$product->price}} تومان</td>
                                <td class="text-center">{{$product->weight}} </td>
                                <td class="text-center">{{$product->slug}}</td>
                                <td class="text-center">{{$product->tags}}</td>
                                <td class="text-center">
                                    <label>
                                        <input id="{{ $product->id }}" onchange="changeStatus('{{ $product->id }}')"
                                            data-url="{{ route('admin.market.product.status', $product->id) }}"
                                            type="checkbox" @if ($product->status == 1) checked @endif>
                                    </label>
                                </td>

                                <td class="text-center">
                                    <label>
                                        <input id="{{ $product->id }}-marketable"
                                            onchange="marketable('{{ $product->id }}')"
                                            data-url="{{ route('admin.market.product.marketable', $product->id) }}"
                                            type="checkbox" @if ($product->marketable == 1) checked @endif>
                                    </label>
                                </td>
                                <td class="whidth-8-rem text-left">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-success btn-sm btn-block dropdown-toggle"
                                            role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fa fa-tools"></i>
                                            عملیات
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item text-right" aria-labelledby="dropdownMenuLink"
                                                href="{{ route('admin.market.gallery.index', $product->id) }}"><i class="fa fa-images"></i> گالری</a>


                                            <a class="dropdown-item text-right" aria-labelledby="dropdownMenuLink"
                                                href="{{ route('admin.market.color.index', $product->id) }}"><i class="fa fa-list-ul"></i> مدیریت رنگ کالا</a>


                                                <a class="dropdown-item text-right" aria-labelledby="dropdownMenuLink"
                                                href="{{ route('admin.market.guarantee.index', $product->id) }}"><i class="fa fa-shield-alt"></i> مدیریت گارانتی ها</a>

                                            <a class="dropdown-item text-right" aria-labelledby="dropdownMenuLink"
                                                href="{{ route('admin.market.product.edit', $product->id) }}"><i class="fa fa-edit"></i> ویرایش</a>

                                                <form action="{{ route('admin.market.product.destroy', $product->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    {{method_field('delete')}}
                                                <button type="submit" class="dropdown-item text-right delete"><i
                                                        class="fa fa-trash-alt"></i> حذف</button>
                                            </form>
                                        </div>
                                    </div>

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
        function marketable(id)
            {
                var element = $("#" + id + '-marketable');
                var url = element.attr('data-url')
                var elementValue = !element.prop('checked');

                $.ajax({
                    url : url,
                    type: "GET",
                    success: function(response)
                    {
                        if (response.marketable)
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
    @include('Admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
