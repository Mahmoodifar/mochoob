@extends('Admin.layouts.master')

@section('head-tag')
    <title> نمایش نظرات </title>
@endsection



@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.content.comment.index') }}"> نظرات </a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش نظرات </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>نمایش نظرات </h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.content.comment.index') }}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>
                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                        <strong>{{ $comment->user->fullName }} - {{ $comment->user->id }}</strong>
                    </section>
                    <section class="card-body ">
                        <h5 class="card-title">مشخصات کالا : {{ $comment->commentable->title }} کد کالا :
                            {{ $comment->commentable->id }} </h5>
                        <p class="card-text">{{ $comment->body }}</p>
                    </section>
                </section>
                @if ($comment->parent_id == null)
                    <section>
                        <form action="{{ route('admin.content.comment.answer', $comment->id) }}" method="POST">
                            @csrf
                            <section class="row d-flex justify-content-between">
                                <section class="col-12">
                                    <div class="form-group ">
                                        <label for="body">پاسخ ادمین </label>
                                        <textarea id="body" name="body" class="form-control form-control-sm" rows="4"></textarea>
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
                @endif

            </section>
        </section>
    </section>
@endsection

@section('script')
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
    </script>
@endsection
