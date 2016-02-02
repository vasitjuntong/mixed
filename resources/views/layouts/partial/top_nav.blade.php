<div id="top-nav" class="fixed skin-6 hidden-print">
    <a href="#" class="brand">
        <span>Mixed</span>
        <span class="text-toggle"> System</span>
    </a><!-- /brand -->
    <button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <button type="button" class="navbar-toggle pull-left hide-menu" id="menuToggle">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <ul class="nav-notification clearfix">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-lg"></i>
                @if($notifies->count() > 0)
                    <span class="notification-label bounceIn">{{ $notifies->count() }}</span>
                @endif
            </a>
            @if($notifies->count() > 0)
                <ul class="dropdown-menu notification dropdown-3">
                    @foreach($notifies as $notify)
                        <li>
                            <a id="notify_id_{{ $notify->id }}"
                               data-notify-id="{{ $notify->id }}"
                               class="clearfix"
                               href="{{ $notify->link }}">
                                <div class="detail">
                                    <p class="no-margin">
                                    <span class="notification-icon bg-warning">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                        {{ $notify->title }}
                                    </p>
                                    <small class="text-muted">{{ $notify->created_at->diffForHumans() }}</small>
                                </div>
                            </a>
                        </li>
                    @endforeach
                    {{--<li><a href="#">View all notifications</a></li>--}}
                </ul>
            @endif
        </li>
        <li class="profile dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <strong>
                    @if(Auth::check())
                        {{ Auth::user()->name }}
                    @endif
                </strong>
                <span><i class="fa fa-chevron-down"></i></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="clearfix" href="#">
                        <img src="/img/user.jpg" alt="User Avatar">
                        <div class="detail">
                            <strong>
                                @if(Auth::check())
                                    {{ Auth::user()->name }}
                                @endif
                            </strong>
                            <p class="grey">
                                @if(Auth::check())
                                    {{ Auth::user()->email }}
                                @endif
                            </p>
                        </div>
                    </a>
                </li>
                <li><a tabindex="-1" href="profile.html" class="main-link"><i class="fa fa-edit fa-lg"></i> Edit profile</a>
                </li>

                {{-- <li><a tabindex="-1" href="#" class="theme-setting"><i class="fa fa-cog fa-lg"></i> Setting</a></li> --}}
                <li class="divider"></li>
                <li>
                    <a tabindex="-1" class="main-link logoutConfirm_open" href="#logoutConfirm">
                        <i class="fa fa-lock fa-lg"></i> Log out
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div><!-- /top-nav-->