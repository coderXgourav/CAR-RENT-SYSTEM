@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $contactContent = getContent('contact_us.content', true);
    @endphp

    <section class="contact-us-info py-120">
        <div class="container">
            <div class="contact-info-wrapper">
                <div class="row gy-4">
                    <div class="col-sm-6 col-lg-4">
                        <div class="contact-info-item">
                            <div class="contact-info-item__icon"><i class="icon-Vector-3"></i></div>
                            <h5 class="contact-info-item__title">@lang('Email')</h5>
                            <a href="mailto:{{ @$contactContent->data_values->contact_address }}" class="contact-info-item__text">{{ @$contactContent->data_values->contact_email }}</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="contact-info-item">
                            <div class="contact-info-item__icon"><i class="icon-Phone"></i></div>
                            <h5 class="contact-info-item__title">@lang('Phone')</h5>
                            <a href="tel:{{ @$contactContent->data_values->contact_number }}" class="contact-info-item__text">{{ @$contactContent->data_values->contact_number }}</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="contact-info-item">
                            <div class="contact-info-item__icon"><i class="icon-Pin"></i></div>
                            <h5 class="contact-info-item__title">@lang('Office')</h5>
                            <a href="javascript:void(0)" class="contact-info-item__text">{{ __(@$contactContent->data_values->contact_address) }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section pb-120">
        <div class="container">
            <div class="row g-4 g-md-5">
                <div class="col-lg-6">
                    <div class="contact-map">
                        <iframe src="{{ @$contactContent->data_values->map_embedded_link }}"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form">
                        <div class="contact-form-heading">
                            <h2 class="contact-form-heading__title">{{ __(@$contactContent->data_values->title) }}</h2>
                            <p class="contact-form-heading__desc">{{ __(@$contactContent->data_values->short_Details) }}</p>
                        </div>
                        <form method="post" action="" class="verify-gcaptcha">
                            @csrf
                            <div class="form-group">
                                <label class="form--label">@lang('Name')</label>
                                <input name="name" type="text" class="form--control" value="{{ old('name', @$user->fullname) }}" @if ($user && $user->profile_complete) readonly @endif required>
                            </div>
                            <div class="form-group">
                                <label class="form--label">@lang('Email')</label>
                                <input name="email" type="email" class="form--control" value="{{ old('email', @$user->email) }}" @if ($user) readonly @endif required>
                            </div>
                            <div class="form-group">
                                <label class="form--label">@lang('Subject')</label>
                                <input name="subject" type="text" class="form--control" value="{{ old('subject') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form--label">@lang('Message')</label>
                                <textarea name="message" wrap="off" class="form--control" required>{{ old('message') }}</textarea>
                            </div>

                            <x-captcha />

                            <button type="submit" class="btn btn--gradient w-100">@lang('Submit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($sections != null)
        @foreach (json_decode($sections) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('[name=captcha]').removeClass('form-control').siblings('label').removeClass('form-label').addClass('form--label');
        })(jQuery)
    </script>
@endpush
