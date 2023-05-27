@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>تیکت ها من</title>

@section('content')


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
                                <section class="d-flex justify-content-between">
                                    <section class="content-header-link m-2">
                                        <a href="{{ route('customer.profile.my-ticket.change', $ticket) }}"
                                            class="btn btn-danger text-white p-1">بستن تیکت</a>
                                    </section>
                                    <section class="content-header-link m-2 justify-content-end">
                                        <a href="{{ route('customer.profile.my-ticket') }}"
                                            class="btn btn-warning p-1">بازگشت</a>
                                    </section>
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->



                        <section class="order-wrapper">


                            <section class="card mb-3 my-3">
                                <section class="card-header bg-info">
                                    {{ $ticket->user->fullName }}
                                </section>
                                <section class="card-body ">
                                    <h5 class="card-title">{{ $ticket->subject }}</h5>
                                    <p class="card-text">{{ $ticket->description }}</p>
                                </section>
                                @if ($ticket->file()->count() > 0)
                                    <section class="card-footer">
                                        <a class="btn btn-success" href="{{ asset($ticket->file->file_path) }}"
                                            download>دانلود ضمیمه</a>
                                    </section>
                                @endif
                            </section>
                            <div class="border my-2">
                                @foreach ($ticket->children as $child)

                                <section class="card m-4">
                                    <section class="card-header bg-light d-flex justify-content-between">
                                        <div> {{ $child->user->first_name . ' ' . $child->user->last_name }} - پاسخ دهنده :
                                            {{ $child->admin ? $child->admin->user->first_name . ' ' .
                                            $child->admin->user->last_name : 'نامشخص' }}</div>
                                        <small>{{ jdate($child->created_at) }}</small>
                                    </section>
                                    <section class="card-body">
                                        <p class="card-text">
                                            {{ $child->description }}
                                        </p>
                                    </section>

                                </section>
                                @endforeach
                            </div>
                            <section class="my-3">
                                <form action="{{ route('customer.profile.my-ticket.answer', $ticket->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    @if ($ticket->status == 0)
                                        <section class="row d-flex justify-content-between">
                                            <section class="col-12">
                                                <div class="form-group ">
                                                    <label for="description" class="my-3">پاسخ تیکت </label>
                                                    <textarea class="form-control form-control-sm" name='description' rows="4">{{ old('description') }}</textarea>
                                                </div>
                                                @error('description')
                                                    <span class="alert_required bg-danger rounded text-white p-1"
                                                        role="alert">
                                                        <strong>
                                                            {{ $message }}
                                                        </strong>
                                                    </span>
                                                @enderror
                                            </section>
                                            <section class="col-12 my-2">
                                                <button class="btn btn-primary btn-sm">ثبت</button>
                                            </section>

                                        </section>
                                    @else
                                        <section class="bg-close-ticket p-3 rounded">
                                            این تیکت بسته شده
                                        </section>
                                    @endif
                                </form>
                            </section>


                        </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection
