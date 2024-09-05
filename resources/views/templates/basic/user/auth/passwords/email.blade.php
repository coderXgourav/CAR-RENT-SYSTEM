@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="pt-60 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7 col-xl-5">
                    <div class="card custom--card">
                        <div class="card-body">
                            <div class="mb-4">
                                <p>@lang('To recover your account please provide your email or username to find your account.')</p>
                            </div>
                            <form method="POST" action="{{ route('user.password.email') }}" class="verify-gcaptcha">
                                @csrf
                                <div class="form-group">
                                    <label class="form--label">@lang('Email or Username')</label>
                                    <input type="text" class="form--control" name="value" value="{{ old('value') }}" required autofocus="off">
                                </div>

                                <x-captcha />

                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        (function($) {
            "use strict";
            $('[name=captcha]').removeClass('form-control').siblings('label').removeClass('form-label').addClass('form--label');
        })(jQuery)
    </script>
@endpush
