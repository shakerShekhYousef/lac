<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/logo.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                           placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#lang" data-toggle="collapse" role="button"
                       aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fa fa-language" style="color: #5a5e62;"></i>
                        <span class="nav-link-text" style="color: #5a5e62;">@lang('menus.backend.access.lang')</span>
                    </a>
                    <div class="collapse" id="lang">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('lang','ar') }}">
                                    (ar)العربية
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('lang','en') }}">
                                    English(en)
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> @lang('menus.backend.sidebar.dashboard')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button"
                       aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fa fa-user" style="color: #f4645f;"></i>
                        <span class="nav-link-text"
                              style="color: #f4645f;">@lang('menus.backend.access.users.main')</span>
                    </a>
                    <div class="collapse" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    @lang('menus.backend.access.users.profile')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    @lang('menus.backend.access.users.management')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('roles.index') }}">
                                    @lang('menus.backend.access.roles.main')
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if(auth()->user()->role_id===1)
                    <li class="nav-item">
                        <a class="nav-link" href="#userRequests" data-toggle="collapse" role="button"
                           aria-expanded="true" aria-controls="navbar-examples">
                            <i class="fa fa-mail-bulk" style="color: #25254d"></i>
                            <span class="nav-link-text" style="color: #25254d">
                            @if($edit_count >0 | $password_count >0 | $group_count>0 | $total>0)
                                    <label class="badge badge-danger">
                                        @lang('menus.backend.access.requests.main')
                                    </label>
                                    <label class="badge badge-danger">
                                        {!! $total !!}
                                    </label>
                                @else
                                    <label>@lang('menus.backend.access.requests.main')</label>
                                @endif
                            </span>
                        </a>
                        <div class="collapse" id="userRequests">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('userUpdateRequests') }}">
                                        @lang('menus.backend.access.requests.update')
                                        <label class="badge badge-danger">
                                            {!! $edit_count !!}
                                        </label>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('userPasswordRequests') }}">
                                        @lang('menus.backend.access.requests.password')
                                        <label class="badge badge-danger">
                                            {!! $password_count !!}
                                        </label>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('indexUserGroupRequests') }}">
                                        @lang('menus.backend.access.requests.groups')
                                        <label class="badge badge-danger">
                                            {!! $group_count !!}
                                        </label>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="#news" data-toggle="collapse" role="button" aria-expanded="true"
                       aria-controls="navbar-examples">
                        <i class="fa fa-pen" style="color: green;"></i>
                        <span class="nav-link-text" style="color: green;">@lang('menus.backend.last-news.main')</span>
                    </a>
                    <div class="collapse" id="news">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('lastNews.index')}}">
                                    @lang('menus.backend.last-news.all')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('lastNews.create')}}">
                                    @lang('menus.backend.last-news.create')
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sections" data-toggle="collapse" role="button" aria-expanded="true"
                       aria-controls="navbar-examples">
                        <i class="fa fa-square" style="color: #00ccff;"></i>
                        <span class="nav-link-text" style="color: #00ccff;">@lang('menus.backend.sections.main')</span>
                    </a>
                    <div class="collapse" id="sections">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('section.index')}}">
                                    @lang('menus.backend.sections.all')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('section.create')}}">
                                    @lang('menus.backend.sections.create')
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#HRD" data-toggle="collapse" role="button" aria-expanded="true"
                       aria-controls="navbar-examples">
                        <i class="fa fa-square" style="color: #8c0615;"></i>
                        <span class="nav-link-text" style="color: #8c0615">@lang('menus.backend.hrd.main')</span>
                    </a>
                    <div class="collapse" id="HRD">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('hrd.index')}}">
                                    @lang('menus.backend.hrd.all')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('hrd.create')}}">
                                    @lang('menus.backend.hrd.create')
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#requests" data-toggle="collapse" role="button" aria-expanded="true"
                       aria-controls="navbar-examples">
                        <i class="fa fa-envelope" style="color: #0c1628"></i>
                        @if($student_requests >0 || $admin_requests > 0)
                            <span class="badge badge-danger">@lang('menus.backend.student-requests.main')
                        </span>
                            <label class="badge badge-danger">
                                @if($student_requests >0 && auth()->user()->role_id==1)
                                    {!! $student_requests !!}
                                @elseif($admin_requests > 0)
                                    {!! $admin_requests !!}
                                @endif
                            </label>
                        @else
                            <span class="nav-link-text"
                                  style="color: #0c1628">@lang('menus.backend.student-requests.main')
                        </span>
                        @endif
                    </a>
                    <div class="collapse" id="requests">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('procedureType.index')}}">
                                    @lang('menus.backend.student-requests.types')
                                </a>
                            </li>
                            @if(auth()->user()->role_id===1)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('studentRequest.index')}}">
                                        @lang('menus.backend.student-requests.all')
                                        <br>
                                        <label class="badge badge-danger">
                                            {!! $student_requests !!}
                                        </label>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    @if($admin_requests == 0)
                                        <a class="nav-link" href="{{route('request.admin')}}">
                                            @lang('menus.backend.student-requests.all')
                                        </a>
                                    @else
                                        <a class="nav-link" href="{{route('request.admin')}}">
                                            <span>@lang('menus.backend.student-requests.all')</span>
                                            <label class="badge badge-danger">
                                                {!! $admin_requests !!}
                                            </label>
                                        </a>
                                    @endif

                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Chat" data-toggle="collapse" role="button" aria-expanded="true"
                       aria-controls="navbar-examples">
                        <i class="fa fa-square" style="color: #00ccff;"></i>
                        <span class="nav-link-text" style="color: #00ccff;">@lang('menus.backend.chat.main')</span>
                    </a>
                    <div class="collapse" id="Chat">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('Chat.index')}}">
                                    @lang('menus.backend.chat.all')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/messages">
                                    @lang('menus.backend.chat.messages')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('Chat.create')}}">
                                    @lang('menus.backend.chat.room')
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about.edit',1) }}">
                        <i class="fa fa-address-book text-cyan"></i> @lang('menus.backend.about.main')
                    </a>
                </li>
                @if(auth()->user()->role_id===1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chatRequests.index') }}">
                            <i class="fa fa-mail-bulk"
                               style="color: #9d03ad"></i>
                            @lang('menus.backend.access.chatRequests.main')
                            @if($chatRequestsCount > 0)
                                <label class="badge badge-danger">
                                    {{$chatRequestsCount}}
                                </label>
                            @endif
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('questions.index') }}">
                        <i class="fa fa-question" style="color: chartreuse"></i>@lang('menus.backend.faq.main')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reports') }}">
                        <i class="fa fa-file-archive" style="color: chartreuse"></i>@lang('labels.backend.access.activates.main')
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
