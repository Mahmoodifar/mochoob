<!doctype html>
<html lang="fa" dir="rtl">

<head>
    @include('customer.layouts.head-tag')
    @yield('head-tag')
</head>

<body>


    <!-- start header -->
    @include('customer.layouts.header')
    <!-- end header -->

<section class="container-xxl body-container">
    @yield('customer.layouts.sidebar')
</section>

@include('Admin.alerts.alert-section.success')
    <!-- start main one col -->
    <main id="main-body-one-col" class="main-body">
        @yield('content')
    </main>
    <!-- end main one col -->



    <!-- start body -->
    <section class="container-xxl body-container">
        <aside id="sidebar" class="sidebar">

        </aside>
        <main id="main-body" class="main-body">

        </main>
    </section>
    <!-- end body -->




    <!-- start footer -->
    @include('customer.layouts.footer')
    <!-- end footer -->
    @include('customer.layouts.scripts')
    @yield('script')
</body>

</html>
