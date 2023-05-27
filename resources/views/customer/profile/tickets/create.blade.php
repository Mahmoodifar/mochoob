@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>افزودن تیکت جدید</title>

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
                                    <span>افزودن تیکت</span>
                                </h2>
                                <section class="content-header-link m-2">
                                    <a href="{{ route('customer.profile.my-ticket') }}"
                                        class="btn btn-warning p-1">بازگشت</a>
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->



                        <section class="order-wrapper">
                            <section class="my-3">
                                <form action="{{ route('customer.profile.my-ticket.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <section class="row d-flex justify-content-between">
                                        <section class="col-4 my-2">
                                            <div class="form-group mb-3">
                                                <label for="subject" class="mb-1">عنوان تیکت</label>
                                                <input class="form-control form-control-sm" name='subject'
                                                    rows="4" value="{{ old('subject') }}" />
                                            </div>
                                            @error('subject')
                                                <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </section>
                                        <section class="col-4 my-2">
                                            <label for="category_id" class="form-label mb-1">دسته تیکت مورد نظر</label>
                                            <div class="form-group mb-3">
                                            <select name="category_id" class="form-select form-select-sm" id="category_id">
                                                <option value="">دسته تیکت را انتخاب کنید</option>
                                                @foreach ($ticketCategories as $ticketCategory)
                                                    <option value="{{ $ticketCategory->id }}">
                                                        {{ $ticketCategory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category_id')
                                        <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                        </section>
                                        <section class="col-4 my-2">
                                            <label for="priority_id" class="form-label mb-1">اولویت تیکت</label>
                                            <div class="form-group mb-3">
                                            <select name="priority_id" class="form-select form-select-sm" id="ticketPriority">
                                                <option value="">اولویت را مشخص کنید</option>
                                                @foreach ($ticketPriorities as $ticketPriority)
                                                    <option value="{{ $ticketPriority->id }}">

                                                        {{ $ticketPriority->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @error('priority_id')
                                        <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                        </section>
                                        <section class="col-12">
                                            <div class="form-group mb-2">
                                                <label for="description" class="my-3">متن تیکت</label>
                                                <textarea class="form-control form-control-sm" name='description' rows="4">{{ old('description') }}</textarea>
                                            </div>
                                            @error('description')
                                                <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </section>
                                        <section class="col-12 my-2">
                                            <div class="form-group mb-3">
                                                <label for="file" class="my-2">فایل</label>
                                                <input type="file" name="file" class="form-control form-control-sm">
                                            </div>
                                            @error('file')
                                                <span class="alert_required bg-danger rounded text-white p-1" role="alert">
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
                                </form>
                            </section>


                        </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection
