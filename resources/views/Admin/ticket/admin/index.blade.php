@extends('Admin.layouts.master')

@section('head-tag')
    <title> ادمین تیکت</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">  ادمین تیکت </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5> ادمین تیکت</h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="{{route('admin.ticket.create')}}" class="btn btn-info btn-sm disabled">ایجاد  ادمین جدید </a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">نام ادمین</th>
                                <th class="text-center">ایمیل ادمین</th>
                                <th class="max-whidth-8-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($admins as $key => $admin)

                            <tr>
                                <th>{{$key + 1}}</th>
                             <td class="text-center">{{$admin->fullName}}</td>
                                <td class="text-center">{{$admin->email}}</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{route('admin.ticket.admin.set',$admin->id)}}" class="btn btn-{{$admin->TicketAdmin == null ? 'success' : 'danger'}} btn-sm"><i class="fa fa-{{$admin->TicketAdmin == null ? 'check' : 'window-close'}}"></i>
                                    {{$admin->TicketAdmin == null ? 'اضافه' : 'حذف'}}

                                    </a>
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
