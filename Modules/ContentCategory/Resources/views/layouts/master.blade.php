<!DOCTYPE html>
<html lang="en">

<head>
    @include('Admin.layouts.head-tag')
    @yield('head-tag')
</head>


<body dir="rtl">

    @include('Admin.layouts.header')

    <section class="body-container">
        @include('Admin.layouts.sidebar')

        <section id="main-body" class="main-body">
            @yield('content')
        </section>
    </section>

    @include('admin.layouts.scripts')
    @yield('script')

    <section class="toast-wrapper flex-row-reverse">
        @include('Admin.alerts.toast.error')
        @include('Admin.alerts.toast.success')
    </section>

    @include('Admin.alerts.sweetalert.error')
    @include('Admin.alerts.sweetalert.success')
</body>


</html>
