@extends('Admin.layouts.master')

@section('head-tag')
    <title>ویرایش عکس کالا</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.product.index') }}">
                    کالا ها</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش عکس کالا</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>عکس کالا ها</h5>
                </section>
                <section class=" border-bottom pb-2 align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.market.gallery.index', $product->id) }}" class="btn btn-info btn-sm"> بازگشت
                    </a>
                </section>

                <section>
                    <form
                        action="{{ route('admin.market.gallery.update', ['product' => $product->id, 'gallery' => $gallery->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <section class="row d-flex justify-content-between">

                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="image">تصویر</label>
                                    <input type="file" name="image" class="form-control form-control-sm">
                                </div>
                                @error('image')
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
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        CKEDITOR.replace('introduction');
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

    <script>
        $(document).ready(function() {
            var tags_input = $('#tags');
            var select_tags = $('#select_tags');
            var default_tags = tags_input.val();
            var default_data = null;

            if (tags_input.val() !== null && tags_input.val().length > 0) {

                default_data = default_tags.split(',');

            }
            select_tags.select2({
                placeholder: 'لطفا تگ های خود را وارد کنید',
                tags: true,
                data: default_data
            });

            select_tags.children('option').attr('selected', true).trigger('change');

            $('#form').submit(function(event) {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource)
                }
            })
        });
    </script>

    <script>
        $(function() {
            $('#btn-copy').on('click', function() {
                var ele = $(this).parent().prev().clone(true);

                $(this).before(ele);
            })
        })
    </script>
@endsection
