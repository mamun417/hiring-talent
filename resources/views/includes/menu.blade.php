<!-- Start => mobile view menu section -->
<nav class="social-menu">
    <a class="lgo" href="{{ route('home') }}">
        <img class="" width="40%" src="{{ @$globalSettingInfo->image->url }}">
    </a>
    <span class="share">
        @foreach(@$globalSocialInfo as $social)
            <a class="icn" target="_blank" href="{{ @$social->link }}"><i class="fa fa-{{ @$social->icon }}"></i></a>
        @endforeach
    </span>

    <input type="checkbox" id="box">
    <label for="box"><span><i class="fas fa-bars"></i></span></label>
    <ul class="mobile-menu">
        @php($active_class = getActiveClassByController('HomeController'))
        <li class="{{ getActiveClassByController('HomeController') }}">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li><a href="{{ route('home') }}#about">About</a></li>
        <li><a href="" data-toggle="modal" data-target="#contactModal">contact</a></li>
        @guest
            <li>
                <a href="" data-toggle="modal" data-target="#loginModal">LOGIN
                </a>
            </li>
        @endguest
        @auth
            @php($active_class = getActiveClassByController('UserProfileController') ||
            getActiveClassByController('UserTalentController'))
            <li class="{{ $active_class ? 'active' : '' }}">
                <a href="{{ route('user.profile') }}">Profile</a>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                    Logout</a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @endauth
    </ul>
</nav>
<!-- End => mobile view menu section -->

<!-- Start => top menu with social section and logo -->
<div class="container">
    <div class="main-area">
        <div class="header-area pt-2">
            <div class="logo-section floatleft">
                <a href="{{ route('home') }}">
                    <img width="40%" src="{{ @$globalSettingInfo->image->url }}">
                </a>
            </div>
            <div class="menu floatright">
                <nav class="icon-menu">
                    <ul class="my-2">
                        @foreach(@$globalSocialInfo as $social)
                            <li><a target="_blank" href="{{ @$social->link }}"><i
                                        class="fa fa-{{ @$social->icon }}"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
        <nav class="main-menu">
            <a href="#" class="bar"><i class="fa fa-bars"></i></a>
            <ul>
                <div class="stickyLogo">
                    <a href="{{ route('home') }}">
                        <img src="{{ @$globalSettingInfo->image->url }}">
                    </a>
                </div>
                <li class="{{ getActiveClassByController('HomeController') }}">
                    <a href="{{ route('home') }}">home</a>
                </li>
                <li><a href="{{ route('home') }}#about">about</a></li>
                {{--                <li><a href="#">BROWSE TALENTS </a></li>--}}
                {{--                <li><a href="{{ route('new-talent') }}">NEW TALENT SUBMISSION</a></li>--}}
                <li><a href="" data-toggle="modal" data-target="#contactModal">contact</a></li>
                @guest
                    <li>
                        <a href="" data-toggle="modal" data-target="#loginModal">LOGIN
                        </a>
                    </li>
                @endguest

                @auth
                    @php($active_class = getActiveClassByController('UserProfileController') ||
                    getActiveClassByController('UserTalentController'))
                    <li class="{{ $active_class ? 'active' : '' }}">
                        <a href="{{ route('user.profile') }}">Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                            Logout</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
            </ul>
            <div class="floatright">
                <nav class="icon-menu">
                    <ul>
                        @foreach(@$globalSocialInfo as $social)
                            <li><a target="_blank" href="{{ @$social->link }}"><i
                                        class="fa fa-{{ @$social->icon }}"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </nav>
    </div>

    @if (getCurrentRoute() == 'home')
        <div class="img-slider">
            @foreach( @$sliders as $key => $slider )
                <div class="slide {{ @$key === 0 ? 'active' : ''}}">
                    <img src="{{ @$slider->image->url }}" alt=""/>
                    <div class="info">
                        @if(@$slider->title)
                        <h2>{{ @$slider->title }}</h2>
                        @endif
                        @if(@$slider->text)
                        <p>{!! @$slider->text !!}</p>
                        @endif
                        {{--                    <button>find out more</button>--}}
                    </div>
                </div>
            @endforeach
            <div class="navigation">
                <ul>
                    @foreach( @$sliders as $k => $slider )
                        <li class="btn  ml-3 btn-slider {{ @$k === 0 ? 'active' : ''}}"></li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
<!-- Start => top menu with social section and logo -->
