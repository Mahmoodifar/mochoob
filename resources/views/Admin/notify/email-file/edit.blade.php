@extends('Admin.layouts.master')

@section('head-tag')
    <title>ویرایش فایل اطلاعیه ایمیلی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.notify.email.index') }}"> اطلاع رسانی ایمیلی</a>
            </li>
            <li class="breadcrumb-item font-size-12"><a
                    href="{{ route('admin.notify.email-file.index', $file->email->id) }}">فایل
                    اطلاعیه ایمیلی</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش فایل اطلاعیه ایمیلی</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>ویرایش فایل اطلاعیه ایمیلی</h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.notify.email-file.index', $file->email->id) }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>

                <section>
                    <form action="{{ route('admin.notify.email-file.update', $file->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <section class="col-12 my-2">
                            <div class="form-group">
                                <label for="file">فایل</label>
                                <input type="file" value="{{$file->file_path}}" name="file" class="form-control form-control-sm">
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
                            <div class="form-group">
                                <label for="path">محل ذخیره سازی</label>
                                <select name="path" id="path" class="form-control form-control-sm">
                                    <option value="0" @if (old('path',$file->path) == 0) selected @endif>Public
                                    </option>
                                    <option value="1" @if (old('path',$file->path) == 1) selected @endif>Storage
                                    </option>
                                </select>
                            </div>
                            @error('path')
                                <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>
                        <section class="col-12 my-2">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('status', $file->status) == 0) selected @endif>غیرفعال
                                    </option>
                                    <option value="1" @if (old('status', $file->status) == 1) selected @endif>فعال
                                    </option>
                                </select>
                            </div>
                            @error('status')
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
@section('script')
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
        CKEDITOR.replace('summary');
    </script>

    <script>
        $(document).ready(function() {
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at',
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            });
        });
    </script>
@endsection
