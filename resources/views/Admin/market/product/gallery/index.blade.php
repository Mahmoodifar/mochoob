@extends('Admin.layouts.master')

@section('head-tag')
    <title>گالری</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.product.index') }}"> بخش محصول</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> گالری</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>گالری</h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="{{ route('admin.market.gallery.create', $product->id) }}" class="btn btn-info btn-sm ">ایجاد عکس
                        جدید</a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">نام محصول</td>
                                <th class="text-center">تصویر محصول</td>
                                <th class="max-whidth-8-rem text-left pl-5"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->images as $gallery)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</th>
                                    <td class="text-center">{{ $product->name }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset($gallery->image['indexArray'][$gallery->image['currentImage']]) }}"
                                            alt="" class="max-height-2rem">
                                    </td>
                                    <td class="whidth-8-rem text-left">
                                        <a href="{{ route('admin.market.gallery.edit',['product' => $product->id, 'gallery' => $gallery->id]) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                                            ویرایش</a>
                                        <form
                                            action="{{ route('admin.market.gallery.destroy', ['product' => $product->id, 'gallery' => $gallery->id]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <button class="btn btn-danger btn-sm delete" type="submit"><i
                                                    class="fa fa-trash-alt"></i>
                                                حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
@section('script')
    @include('Admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
