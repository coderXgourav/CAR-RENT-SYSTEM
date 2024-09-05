@php
    $credentials = $general->socialite_credentials;
    $type = Request::is('user.registe') ? 'Register' : 'Login';
@endphp
@if (@$credentials->google->status == Status::ENABLE || @$credentials->facebook->status == Status::ENABLE || @$credentials->linkedin->status == Status::ENABLE)
    <div class="auth-devide">
        <span>OR</span>
    </div>
    <div class="auth--btn-wrapper">
        @if (@$credentials->google->status == Status::ENABLE)
            <div class="auth--btn-inner">
                <a class="btn auth--btn w-100" href="{{ route('user.social.login', 'google') }}">
                    <span class="icon">
                        <img src="{{ asset($activeTemplateTrue . 'images/google.svg') }}" alt="">
                    </span>
                    @lang('Google')
                </a>
            </div>
        @endif
        @if (@$credentials->facebook->status == Status::ENABLE)
            <div class="auth--btn-inner">
                <a class="btn auth--btn w-100" href="{{ route('user.social.login', 'facebook') }}">
                    <span class="icon">
                        <img src="{{ asset($activeTemplateTrue . 'images/facebook.svg') }}" alt="">
                    </span>
                    @lang('Facebook')
                </a>
            </div>
        @endif
        @if (@$credentials->linkedin->status == Status::ENABLE)
            <div class="auth--btn-inner">
                <a class="btn auth--btn w-100" href="{{ route('user.social.login', 'linkedin') }}">
                    <span class="icon">
                        <img src="{{ asset($activeTemplateTrue . 'images/linkdin.svg') }}" alt="">
                    </span>
                    @lang('Linkedin')
                </a>
            </div>
        @endif
    </div>
@endif
