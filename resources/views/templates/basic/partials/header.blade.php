<header class="header" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand logo m-0" href="{{ route('home') }}"><img src="{{ siteLogo() }}" alt="@lang('image')" /></a>
            <button class="navbar-toggler header-button" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                    aria-label="Toggle navigation">
                <span id="hiddenNav"><i class="las la-bars"></i></span>
            </button>
            <div class="offcanvas border-0 offcanvas-start" tabindex="-1" id="offcanvasDarkNavbar">
                <div class="offcanvas-header">
                    <a class="logo navbar-brand" href="{{ route('home') }}"><img src="{{ siteLogo() }}" alt="@lang('image')" /></a>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav w-100 justify-content-lg-center nav-menu align-items-lg-center">
                        <li class="navbar-nav__bar"></li>
                        <li class="language dropdown d-lg-none">
                            @include($activeTemplate . 'partials.language')
                        </li>
                        <li class="nav-item {{ menuActive('home') }}">
                            <a class="nav-link " aria-current="page" href="{{ route('home') }}">@lang('Home')</a>
                        </li>
                        @php
                            $pages = App\Models\Page::where('tempname', $activeTemplate)
                                ->where('is_default', Status::NO)
                                ->get();
                        @endphp
                        @foreach ($pages as $k => $data)
                            <li class="nav-item @if ($data->slug == Request::segment(1)) active @endif">
                                <a class="nav-link"
                                   href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a>
                            </li>
                        @endforeach
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                @lang('Vehicles')
                                <span class="nav-item__icon"><i class="las la-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu header-dropdown">
                                @foreach ($vehicleTypes as $vehicleType)
                                    <li class="dropdown-menu__list">
                                        <a class="dropdown-item dropdown-menu__link" href="{{ route('vehicles', $vehicleType->slug) }}">{{ __($vehicleType->name) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item {{ menuActive('blog') }}">
                            <a class="nav-link" href="{{ route('blog') }}">@lang('Blog')</a>
                        </li>
                        <li class="nav-item {{ menuActive('contact') }}">
                            <a class="nav-link" href="{{ route('contact') }}">@lang('Contact')</a>
                        </li>
                        <li class="nav-item mt-4 d-lg-none">
                            <div class="header-right d-lg-none">
                                <div class="header-button flex-align gap-3">
                                    @auth
                                        <a href="{{ route('user.home') }}" class="btn btn-outline--base-two">@lang('Dashboard')</a>
                                        <a href="{{ route('user.logout') }}" class="btn btn--gradient">@lang('Logout')</a>
                                    @else
                                        <a href="{{ route('user.login') }}" class="btn btn-outline--base-two">@lang('Login')</a>
                                        <a href="{{ route('user.register') }}" class="btn btn--gradient">@lang('Register')</a>
                                    @endauth
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="header-right d-none d-lg-block">
                <div class="header-button flex-align gap-3">
                    <div class="language dropdown d-none d-lg-flex">
                        @include($activeTemplate . 'partials.language')
                    </div>
                    @auth
                        <a href="{{ route('user.home') }}" class="btn btn-outline--base-two">@lang('Dashboard')</a>
                        <a href="{{ route('user.logout') }}" class="btn btn--gradient">@lang('Logout')</a>
                    @else
                        <a href="{{ route('user.login') }}" class="btn btn-outline--base-two">@lang('Login')</a>
                        <a href="{{ route('user.register') }}" class="btn btn--gradient">@lang('Register')</a>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</header>
