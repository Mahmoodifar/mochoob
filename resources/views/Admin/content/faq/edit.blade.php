@extends('Admin.layouts.master')

@section('head-tag')
    <title>ویرایش پرسش</title>
@endsection



@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.brand.index') }}"> پرسش</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش پرسش</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>ویرایش پرسش</h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.content.faq.index') }}" class="btn btn-info btn-sm">بازگشت </a>
                </section>

                <section>
                    <form action="{{ route('admin.content.faq.update',$faq->id) }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        {{method_field('PUT')}}
                        <section class="row d-flex justify-content-between">

                            <section class="col-12">
                                <div class="form-group ">
                                    <label for="question">پرسش</label>
                                    <input type="text" id="question" name="question" value="{{old('question',$faq->question)}}" class="form-control form-control-sm">
                                </div>
                                @error('question')
                                <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                            @enderror
                            </section>

                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="0" @if (old('status',$faq->status)== 0)  selected @endif>غیرفعال</option>
                                        <option value="1" @if (old('status',$faq->status) ==1)  selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('status')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{$message}}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="tags">تگ ها</label>
                                    <input type="hidden" id="tags" name="tags"
                                        class="form-control form-control-sm" value="{{old('tags',$faq->tags)}}">
                                        <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                        </select>
                                </div>
                                @error('tags')
                                    <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                        <strong>
                                            {{$message}}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12">
                                <div class="form-group ">
                                    <label for="answer">پاسخ</label>
                                    <textarea name="answer" id="answer" rows="6" class="form-control form-control-sm">{{old('answer',$faq->answer)}}</textarea>
                                </div>
                                @error('answer')
                                <span class="alert_required bg-danger rounded text-white p-1" role="alert">
                                    <strong>
                                        {{$message}}
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
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('answer');
    </script>

<script>

    $(document).ready(function() {
        var tags_input = $('#tags');
        var select_tags = $('#select_tags');
        var default_tags = tags_input.val();
        var default_data = null;

        if(tags_input.val() !== null && tags_input.val().length > 0 ) {

            default_data = default_tags.split(',');

        }
        select_tags.select2({
            placeholder : 'لطفا تگ های خود را وارد کنید',
            tags : true,
            data : default_data
        });

        select_tags.children('option').attr('selected',true).trigger('change');

        $('#form').submit(function(event){
            if(select_tags.val() !== null && select_tags.val().length > 0 ) {
                var selectedSource = select_tags.val().join(',');
                tags_input.val(selectedSource)
            }
        })
    });
</script>
@endsection
