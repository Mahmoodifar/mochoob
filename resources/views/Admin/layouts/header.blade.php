<header class="header-main">
    <section class="sidebar-header bg-gray">
        <section class="d-flex justify-content-between flex-md-row-reverse px-2">
            <span id="sidebar-toggle-show" class="d-inline d-md-none pointer"><i
                    class="fas fa-toggle-off pointer"></i></span>
            <span id="sidebar-toggle-hide" class="d-none d-md-inline pointer"><i
                    class="fas fa-toggle-on pointer"></i></span>
            <span><img class="logo" src="{{ asset('admin-assets/images/logo.png') }}" alt="logo"></span>
            <span class="d-md-none" id="body-menu"><i class="fas fa-ellipsis-h pointer"></i></span>
        </section>
    </section>
    <!--sideHeader -->
    <section class="body-header" id="body-header">
        <section class="d-flex justify-content-between">
            <section>
                <span class="mr-5">
                    <span id="search-area" class="search-area d-none">
                        <i id="search-area-hide" class="fas fa-times pointer"></i>
                        <input id="search-input" type="text" class="search-input">
                        <i class="fas fa-search pointer"></i>
                    </span>
                    <i id="search-toggle" class="fas fa-search p-1 pointer d-none d-md-inline"></i>
                </span>
                <span id="full-screen" class="pointer p1 d-none d-md-inline mr-5">
                    <i id="screen-compress" class="fas fa-compress d-none"></i>
                    <i id="screen-expand" class="fas fa-expand "></i>
                </span>
            </section>
            <section>
                <span class="ml-2 ml-md-4 position-relative ">
                    <span id="header-notification-toggle" class="pointer">
                        <i class="far fa-bell"></i>@if ($notifications->count() != 0)
                        <sup class="badge badge-danger">{{ $notifications->count() }}</sup>
                    @endif
                    </span>


                    <section id="header-notification" class="header-notification">
                        <section class="d-flex justify-content-between">
                            <span class="px-2">
                                نوتیفیکیشن ها
                            </span>
                            <span class="px-2">
                                <span class="badge badge-danger">جدید</span>
                            </span>
                        </section>
                        <ul class="list-group rounded px-0">

                            @foreach ($notifications as $notification)
                                <li class="list-group-item list-group-item-action">
                                    <section class="media">
                                        <img class="notification-img"
                                            src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="avatar">
                                        <section class="media-body pr-1">

                                            <p class="notification-text">{{$notification['data']['message']}}</p>
                                            <p class="notification-time">{{jalaliDate($notification->created_at,'%A, %d %B %y ساعت :  H:i:s')}}</p>
                                        </section>
                                    </section>
                                </li>
                            @endforeach
                        </ul>
                    </section>

                </span>

                <span class="ml-2 ml-md-4 position-relative">
                    <span id="header-comment-toggle" class="pointer">
                        <i class="far fa-comment-alt"></i>
                        @if ($unseenComments->count() != 0)
                            <sup class="badge badge-danger">{{ $unseenComments->count() }}</sup>
                        @endif
                    </span>

                    <section id="header-comment" class="header-comment">
                        <section class="border-bottom px-4">
                            <input type="text" class="form-control form-control-sm my-4" placeholder="جستجو... ">
                        </section>

                        <section class="header-comment-wrapper">
                            <ul class="rounded list-group px-0">
                                @foreach ($unseenComments as $unseenComment)
                                    @php
                                        if ($unseenComment->commentable_type == 'App\Models\Market\Product') {
                                            $route = 'admin.market.comment.show';
                                        } else {
                                            $route = 'admin.content.comment.show';
                                        }

                                    @endphp
                                    <a href="{{ route($route, $unseenComment->id) }}">
                                        <li class="list-group-item list-groupt-item-action">
                                            <section class="media">
                                                <img src="{{ asset($unseenComment->user->profile_photo_path) }}"
                                                    alt="avatar" class="notification-img">
                                                <section class="media-body pr-1">
                                                    <section class="d-flex justify-content-between">
                                                        <p class="comment-user">{{ $unseenComment->user->full_name }}
                                                        </p>
                                                        <span>{{ Str::Limit($unseenComment->body, 8) }}<i
                                                                class="fas fa-circle text-success comment-user-status"></i></span>
                                                    </section>
                                                </section>
                                            </section>
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </section>
                    </section>
                </span>

                <span class="ml-3 ml-md-5 position-relative">
                    <span id="header-profile-toggle" class="pointer">
                        <img src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="avatar" class="header-avatar">
                        <span class="header-userName">کامران محمدی</span>
                        <i class="fas fa-angle-down"></i>
                    </span>
                    <section id="header-profile" class="header-profile rounded">
                        <section class="list-group rounded">
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-cog"></i>تنظیمات
                            </a>
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-user"></i>کاربر
                            </a>
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="far fa-envelope"></i>پیام ها
                            </a>
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-lock"></i>قفل صفحه
                            </a>
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-sign-out-alt"></i>خروج
                            </a>
                        </section>
                    </section>
                </span>
            </section>
        </section>
    </section>
</header>
