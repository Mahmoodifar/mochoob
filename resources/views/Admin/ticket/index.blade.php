@extends('Admin.layouts.master')

@section('head-tag')
    <title>تیکت</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> تیکت </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container ">
                <section class="main-body-container-header">
                    <h5>تیکت</h5>
                </section>
                <section class=" border-bottom pb-2 d-flex justify-content-between align-aitems-center mt-4 mb-3 ">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد تیکت جدید </a>

                    <div class="max-whidth-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو...">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">نویسنده تیکت</th>
                                <th class="text-center">عنوان تیکت</th>
                                <th class="text-center">متن تیکت</th>
                                <th class="text-center"> دسته تیکت</th>
                                <th class="text-center">الویت تیکت</th>
                                <th class="text-center">ارجاع شده از</th>
                                <th class="text-center"> تیکت مرجع</th>
                                <th class="max-whidth-8-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td class="text-center">{{ $ticket->user->full_name }}</td>
                                    <td class="text-center">{{ $ticket->subject }}</td>
                                    <td class="text-center">
                                        {{ $ticket->description ? Str::limit($ticket->description, 10) : '' }}</td>
                                    <td class="text-center">{{ $ticket->category->name }}</td>
                                    <td class="text-center">{{ $ticket->priority->name }}</td>
                                    <td class="text-center">{{ $ticket->admin->user->fullName }}</td>
                                    <td class="text-center">{{ $ticket->parent->subject ?? '-' }}</td>

                                    <td class="width-16-rem text-left">
                                        <a href="{{ route('admin.ticket.show', $ticket->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-eye"></i> مشاهده</a>
                                        <a href="{{ route('admin.ticket.change', $ticket->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fa fa-check"></i>
                                            {{ $ticket->status == 1 ? 'بستن' : 'باز شود' }}
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
