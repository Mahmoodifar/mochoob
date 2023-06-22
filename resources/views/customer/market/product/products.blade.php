@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title></title>
@endsection

@section('content')
    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                @include('customer.layouts.partials.sidebar')
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                        <section class="filters mb-3">
                            @if (request()->search)
                                <span class="d-inline-block border p-1 rounded bg-light">نتیجه جستجو برای :
                                    <span class="badge bg-info text-dark">
                                        {{ request()->search }}
                                    </span>
                                </span>
                            @endif
                            @if (request()->brands)
                                <span class="d-inline-block border p-1 rounded bg-light">برند :
                                    <span class="badge bg-info text-dark">
                                        {{ implode(' , ', $selectedArrayBrands) }}
                                    </span>
                                </span>
                            @endif
                            @if (request()->category)
                                <span class="d-inline-block border p-1 rounded bg-light">دسته :
                                    <span class="badge bg-info text-dark">
                                        {{ request()->category->name }}
                                    </span>
                                </span>
                            @endif
                            @if (request()->min_price)
                                <span class="d-inline-block border p-1 rounded bg-light">قیمت از :
                                    <span class="badge bg-info text-dark">
                                        {{ request()->min_price }} تومان
                                    </span>
                                </span>
                            @endif
                            @if (request()->max_price)
                                <span class="d-inline-block border p-1 rounded bg-light">قیمت تا :
                                    <span class="badge bg-info text-dark">
                                        {{ request()->max_price }} تومان
                                    </span>
                                </span>
                            @endif
                        </section>
                        <section class="sort ">
                            <span>مرتب سازی بر اساس : </span>
                            <a class="btn {{ request()->sort == 1 ? 'btn-info' : 'btn-light' }} btn-sm px-1 py-0"
                                href="{{ route('customer.products', ['category' => request()->category ? request()->category->id : null, 'search' => request()->search, 'sort' => '1', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">جدیدترین</a>
                            <a class="btn {{ request()->sort == 2 ? 'btn-info' : 'btn-light' }} btn-sm px-1 py-0"
                                href="{{ route('customer.products', ['category' => request()->category ? request()->category->id : null, 'search' => request()->search, 'sort' => '2', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">محبوب
                                ترین</a>
                            <a class="btn {{ request()->sort == 3 ? 'btn-info' : 'btn-light' }} btn-sm px-1 py-0"
                                href="{{ route('customer.products', ['category' => request()->category ? request()->category->id : null, 'search' => request()->search, 'sort' => '3', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">گران
                                ترین</a>
                            <a class="btn {{ request()->sort == 4 ? 'btn-info' : 'btn-light' }} btn-sm px-1 py-0"
                                href="{{ route('customer.products', ['category' => request()->category ? request()->category->id : null, 'search' => request()->search, 'sort' => '4', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">ارزان
                                ترین</a>
                            <a class="btn {{ request()->sort == 5 ? 'btn-info' : 'btn-light' }} btn-sm px-1 py-0"
                                href="{{ route('customer.products', ['category' => request()->category ? request()->category->id : null, 'search' => request()->search, 'sort' => '5', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">پربازدیدترین</a>
                            <a class="btn {{ request()->sort == 6 ? 'btn-info' : 'btn-light' }} btn-sm px-1 py-0"
                                href="{{ route('customer.products', ['category' => request()->category ? request()->category->id : null, 'search' => request()->search, 'sort' => '6', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">پرفروش
                                ترین</a>
                        </section>


                        <section class="main-product-wrapper row my-4">

                            @forelse ($products as $product)
                                <section class="col-md-3 p-0">
                                    <section class="product">
                                        <section class="product-add-to-cart"><a href="#" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="افزودن به سبد خرید"><i
                                                    class="fa fa-cart-plus"></i></a></section>
                                        <section class="product-add-to-favorite"><a href="#" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="افزودن به علاقه مندی"><i
                                                    class="fa fa-heart"></i></a></section>
                                        <a class="product-link" href="#">
                                            <section class="product-image">
                                                <img class="" src="{{ $product->image['indexArray']['medium'] }}"
                                                    alt="">
                                            </section>
                                            <section class="product-colors"></section>
                                            <section class="product-name">
                                                <h3>{{ $product->name }}</h3>
                                            </section>
                                            <section class="product-price-wrapper">
                                                <section class="product-price">{{ priceFormat($product->price) }} تومان
                                                </section>
                                            </section>
                                        </a>
                                    </section>
                                </section>
                            @empty
                                <h4 class="text-danger">محصولی یافت نشد</h4>
                            @endforelse






                            <section class="my-4 d-flex justify-content-center border-0">
                                <nav>
                                    {{ $products->links('pagination::bootstrap-5') }}
                                </nav>
                            </section>


                        </section>


                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            bill();
            //input color
            $('input[name="color"]').change(function() {
                bill();
            })
            //guarantee
            $('select[name="guarantee"]').change(function() {
                bill();
            })
            //number
            $('.cart-number').click(function() {
                bill();
            })
        })

        function bill() {
            if ($('input[name="color"]:checked').length != 0) {
                var selected_color = $('input[name="color"]:checked');
                $("#selected_color_name").html(selected_color.attr('data-color-name'));
            }

            //price computing
            var selected_color_price = 0;
            var selected_guarantee_price = 0;
            var number = 1;
            var product_discount_price = 0;
            var product_original_price = parseFloat($('#product_price').attr('data-product-original-price'));

            if ($('input[name="color"]:checked').length != 0) {
                selected_color_price = parseFloat(selected_color.attr('data-color-price'));
            }

            if ($('#guarantee option:selected').length != 0) {
                selected_guarantee_price = parseFloat($('#guarantee option:selected').attr('data-guarantee-price'));
            }

            if ($('#number').val() > 0) {
                number = parseFloat($('#number').val());
            }

            if ($('#product-discount-price').length != 0) {
                product_discount_price = parseFloat($('#product-discount-price').attr('data-product-discount-price'));
            }

            //final price
            var product_price = product_original_price + selected_color_price + selected_guarantee_price;
            var final_price = number * (product_price - product_discount_price);
            $('#product-price').html(toFarsiNumber(product_price));
            $('#final-price').html(toFarsiNumber(final_price));
        }

        function toFarsiNumber(number) {
            const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            // add comma
            number = new Intl.NumberFormat().format(number);
            //convert to persian
            return number.toString().replace(/\d/g, x => farsiDigits[x]);
        }
    </script>


    <script>
        $('.product-add-to-favorite button').click(function() {
            var url = $(this).attr('data-url');
            var element = $(this);
            $.ajax({
                url: url,
                success: function(result) {
                    if (result.status == 1) {
                        $(element).children().first().addClass('text-danger');
                        $(element).attr('data-original-title', 'حذف از علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'حذف از علاقه مندی ها');
                    } else if (result.status == 2) {
                        $(element).children().first().removeClass('text-danger')
                        $(element).attr('data-original-title', 'افزودن از علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'افزودن از علاقه مندی ها');
                    } else if (result.status == 3) {
                        $('.toast').toast('show');
                    }
                }
            })
        })
    </script>

    <script>
        //start product introduction, features and comment
        $(document).ready(function() {
            var s = $("#introduction-features-comments");
            var pos = s.position();
            $(window).scroll(function() {
                var windowpos = $(window).scrollTop();

                if (windowpos >= pos.top) {
                    s.addClass("stick");
                } else {
                    s.removeClass("stick");
                }
            });
        });
        //end product introduction, features and comment
    </script>
@endsection
