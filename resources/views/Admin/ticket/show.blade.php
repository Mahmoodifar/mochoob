@extends('Admin.layouts.master')

@section('head-tag')
    <title> نمایش تیکت ها </title>
@endsection



@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش تیکت</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.ticket.new-tickets') }}"> تیکت های جدید </a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش تیکت ها </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>نمایش تیکت  </h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.ticket.new-tickets') }}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>
                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-pink">
                         {{$ticket->user->fullName}} - {{$ticket->id}}
                    </section>
                    <section class="card-body ">
                        <h5 class="card-title">{{$ticket->subject}}</h5>
                        <p class="card-text">{{$ticket->description}}</p>
                    </section>
                </section>
                <section class="border my-3">
                    @foreach ($ticket->children as $child)
                        <section class="card m-4">
                            <section class="card-header bg-light d-flex justify-content-between">
                                <div>{{ $child->user->fullName }} - پاسخ دهنده : {{$child->admin->user->fullName}}</div>
                                <small>{{ jalaliDate($child->created_at, '%A, %d %B %y ساعت :  H:i:s') }}</small>
                            </section>
                            <section class="card-body ">
                                <h5 class="card-title">
                                </h5>
                                <p class="card-text">{{ $child->description }}</p>
                            </section>
                        </section>
                    @endforeach
                </section>
                <section>
                    <form action="{{ route('admin.ticket.answer',$ticket->id) }}" method="GET" enctype="multipart/form-data">
                        @csrf

                        <section class="row d-flex justify-content-between">
                            <section class="col-12">
                                <div class="form-group ">
                                    <label for="body">پاسخ تیکت </label>
                                   <textarea class="form-control form-control-sm" name='body' rows="4">{{old('body')}}</textarea>
                                </div>
                                @error('body')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>

                        </section>
                    </form>
                </section>


            </section>
        </section>
    </section>
@endsection
