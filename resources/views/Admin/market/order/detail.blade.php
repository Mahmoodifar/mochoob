@extends('Admin.layouts.master')

@section('head-tag')
    <title>جزئیات سفارشات</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">جزئیات سفارشات</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>جزئیات</h5>
                    <a href="" class="btn btn-dark btn-sm text-white my-3" id="print">
                        <i class="fa fa-print"></i>
                        خروجی
                    </a>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover" id="printable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام محصول</td>
                                <th>درصد فروش فوق العاده</td>
                                <th>مبلغ فروش فوق العاده</td>
                                <th>تعداد</td>
                                <th>جمع قیمت محصول</td>
                                <th>مبلغ نهایی</td>
                                <th>رنگ</td>
                                <th>گارانتی</td>
                                <th>ویژگی</td>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $item->singleProduct->name ?? '-' }}</td>
                                    <td>{{ $item->amazingSale->percentage ?? '-' }}</td>
                                    <td>{{ $item->amazing_sale_discount_amount ?? '-' }} تومان</td>
                                    <td>{{ $item->number ?? '-' }}</td>
                                    <td>{{ $item->final_product_price ?? '-' }} تومان</td>
                                    <td>{{ $item->final_total_price ?? '-' }} تومان</td>
                                    <td>{{ $item->color->color_name ?? '-' }}</td>
                                    <td>{{ $item->guarantee->name ?? '-' }}</td>
                                    <td>

                                        @forelse ($item->orderItemAttributes as $attribute)
                                            {{$attribute->categoryAttribute->name ?? '-' }}
                                            :
                                            {{ json_decode($attribute->categoryAttributeValue->value)->value }}
                                        @empty
                                            -
                                        @endforelse
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
    <script>
        var printBtn = document.getElementById('print');
        printBtn.addEventListener('click', function() {
            printContent('printable');
        })


        function printContent(el) {

            var restorePage = $('body').html();
            var printContent = $('#' + el).clone();
            $('body').empty().html(printContent);
            window.print();
            $('body').html(restorePage);
        }
    </script>
@endsection
