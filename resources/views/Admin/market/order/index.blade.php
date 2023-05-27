@extends('Admin.layouts.master')

@section('head-tag')
    <title>سفارشات</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> سفارشات</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>سفارشات</h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد سفارش جدید</a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>کد سفارش</td>
                                <th>(بدون تخفیف)مجموع مبلغ سفارش</td>
                                <th>مجموع تمامی مبلغ تخفیفات</td>
                                <th>مبلغ تخفیف همه محصولات</td>
                                <th>مبلغ نهایی</td>
                                <th>وضعیت پرداخت</td>
                                <th>شیوه پرداخت</td>
                                <th>بانک</td>
                                <th>وضعیت ارسال</td>
                                <th>شیوه ارسال</td>
                                <th>وضعیت سفارش</td>
                                <th class="max-whidth-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->order_final_amount }} تومان</td>
                                    <td>{{ $order->order_discount_amount }} تومان</td>
                                    <td>{{ $order->order_total_product_discount_amount }} تومان</td>
                                    <td>{{ $order->order_final_amount - $order->order_discount_amount }} تومان</td>
                                    <td>{{ $order->payment_status_value }}</td>
                                    <td> {{ $order->payment_type_value }}</td>
                                    <td>{{ $order->payment->paymentable->gateway ?? '-' }}</td>
                                    <td><i class="fa fa-clock"></i>{{ $order->delivery_status_value }}</td>
                                    <td>{{ $order->delivery->name }}</td>
                                    <td>{{ $order->order_status_value }}</td>
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
                                                    href="{{ route('admin.market.order.show', $order->id) }}"><i
                                                        class="fa fa-images"></i> مشاهده فاکتور</a>
                                                <a class="dropdown-item text-right" aria-labelledby="dropdownMenuLink"
                                                    href="{{ route('admin.market.order.changeSendStatus', $order->id) }}"><i
                                                        class="fa fa-list-ul"></i> تغییر وضعیت ارسال</a>
                                                <a class="dropdown-item text-right" aria-labelledby="dropdownMenuLink"
                                                    href="{{ route('admin.market.order.changeOrderStatus', $order->id) }}"><i
                                                        class="fa fa-edit"></i> تغییر وضعیت سفارش</a>
                                                <form action="{{ route('admin.market.order.deleteOrder', $order->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    {{ method_field('delete') }}
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
    @include('Admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
