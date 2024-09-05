@extends($activeTemplate . 'layouts.app')
@section('app')
    @php
        $loginContent = getContent('login.content', true);
    @endphp
    <section class="account">
        <div class="account-inner">
            <div class="account-thumb">
                <img src="{{ getImage('assets/images/frontend/login/' . @$loginContent->data_values->image, '740x600') }}" alt="@lang('image')">
            </div>
            <div class="account-tab">
                <a class="account-logo m-0" href="{{ route('home') }}"><img src="{{ siteLogo() }}" alt="@lang('image')" /></a>
                <div class="account-tab__inner">
                    <ul class="nav custom--tab">
                        <li class="tab__bar"></li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" type="button">@lang('Login')</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="{{ route('user.register') }}">@lang('Register')</a>
                        </li>
                    </ul>
                    <div class="account-form">
                        <div class="account-form__content mb-4">
                            <h2 class="account-form__title">{{ __(@$loginContent->data_values->heading) }}</h2>
                            <p class="account-form__desc fs-18">{{ __(@$loginContent->data_values->subheading) }}</p>
                        </div>
                        <form method="POST" action="{{ route('user.login') }}" class="verify-gcaptcha">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="form--label">@lang('Username or Email')</label>
                                <input type="text" id="email" name="username" value="{{ old('username') }}" class="form--control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form--label">@lang('Password')</label>
                                <input id="password" type="password" class="form--control" name="password" required>
                            </div>

                            <x-captcha />

                            <div class="form-group d-flex justify-content-between align-items-center flex-wrap">
                                <div>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">@lang('Remember Me')</label>
                                </div>
                                <a class="text--base" href="{{ route('user.password.request') }}"> @lang('Forgot your password?')</a>
                            </div>

                            <button type="submit" id="recaptcha" class="btn btn--gradient w-100">@lang('Submit')</button>
                        </form>
                        @include($activeTemplate . 'partials.social_login')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        (function($) {
            "use strict";
            $('[name=captcha]').removeClass('form-control').siblings('label').removeClass('form-label').addClass('form--label');
        })(jQuery)
    </script>
@endpush
