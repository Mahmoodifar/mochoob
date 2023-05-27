@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>تیکت های من</title>

@section('content')
    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">

                @include('customer.layouts.partials.profile-sidebar')

                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>تاریخچه تیکت</span>
                                </h2>
                                <section class="content-header-link m-2">
                                    <a href="{{ route('customer.profile.my-ticket.create') }}" class="btn btn-success text-white p-1">ایجاد تیکت جدید</a>
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->



                        <section class="order-wrapper">

                            <section class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">عنوان تیکت</th>
                                            <th class="text-center">متن تیکت</th>
                                            <th class="text-center"> دسته تیکت</th>
                                            <th class="text-center">الویت تیکت</th>
                                            <th class="text-center">ارجاع شده از</th>
                                            <th class="text-center">وضعیت تیکت</th>
                                            <th class="max-whidth-8-rem text-center"><i class="fa fa-cogs"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tickets as $ticket)
                                            <tr>
                                                <th class="text-center">{{ $loop->iteration }}</th>
                                                <td class="text-center">{{ $ticket->subject }}</td>
                                                <td class="text-center">
                                                    {{ $ticket->description ? Str::limit($ticket->description, 20 ) : '' }}
                                                </td>
                                                <td class="text-center">{{ $ticket->category->name }}</td>
                                                <td class="text-center">{{ $ticket->priority->name }}</td>
                                                <td class="text-center">{{ $ticket->admin ? $ticket->admin->user->fullName : 'نامشخص' }}</td>
                                                <td class="text-center">{{ $ticket->status == 0 ? 'باز' : 'بسته' }}</td>

                                                <td class="width-16-rem text-center">
                                                    <a href="{{ route('customer.profile.my-ticket.show', $ticket->id) }}"
                                                        class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                    @if ($ticket->status == 0)
                                                        <a href="{{ route('admin.ticket.change', $ticket->id) }}"
                                                            class="btn btn-warning btn-sm "><i class="fa fa-times"></i>

                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </section>

                        </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection
