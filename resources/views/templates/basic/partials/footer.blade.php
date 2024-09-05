@php
    $socialLinks = getContent('social_icon.element', orderById: true);
    $footerContent = getContent('footer.content', true);
    $policyPages = getContent('policy_pages.element', orderById: true);
    $contactContent = getContent('contact_us.content', true);
@endphp
<footer class="footer-area">
    <div class="footer-wrapper bg-img py-120" data-background-image="{{ getImage('assets/images/frontend/footer/' . @$footerContent->data_values->image, '1905x535') }}">
        <div class="container">
            <div class="row justify-content-between gy-5">
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <div class="footer-item__logo">
                            <a href="{{ route('home') }}"><img src="{{ siteLogo('white') }}" alt="@lang('image')" /></a>
                        </div>
                        <p class="footer-item__desc">{{ __(@$footerContent->data_values->description) }}</p>
                        <ul class="footer-contact-menu">
                            <li class="footer-contact-menu__item">
                                <div class="footer-contact-menu__item-icon">
                                    <i class="icon-Vector-4"></i>
                                </div>
                                <div class="footer-contact-menu__item-content">
                                    <a href="tel:{{ @$contactContent->data_values->contact_number }}">{{ @$contactContent->data_values->contact_number }}</a>
                                </div>
                            </li>
                            <li class="footer-contact-menu__item">
                                <div class="footer-contact-menu__item-icon">
                                    <i class="icon-Vector-3"></i>
                                </div>
                                <div class="footer-contact-menu__item-content">
                                    <a href="mailto:{{ @$contactContent->data_values->contact_email }}">{{ @$contactContent->data_values->contact_email }}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-xsm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Quick Links')</h5>
                        <ul class="footer-menu">
                            @foreach (@$policyPages as $policy)
                                <li class="footer-menu__item">
                                    <a href="{{ route('policy.pages', [slug(@$policy->data_values->title), @$policy->id]) }}" class="footer-menu__link">{{ __(@$policy->data_values->title) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-xsm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Vehicles')</h5>
                        <ul class="footer-menu">
                            @foreach (@$vehicleTypes->take(4) as $vehicleType)
                                <li class="footer-menu__item">
                                    <a href="{{ route('vehicles', $vehicleType->slug) }}" class="footer-menu__link">{{ __($vehicleType->name) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <div class="footer-item-social">
                            <p class="footer-item-social__title">@lang('Contact With Us')</p>
                            <ul class="social-list mt-0">
                                @foreach (@$socialLinks as $socialLink)
                                    <li class="social-list__item">
                                        <a href="{{ @$socialLink->data_values->url }}" class="social-list__link flex-center" target="_blank">
                                            @php
                                                echo @$socialLink->data_values->social_icon;
                                            @endphp
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="footer-newsletter">
                        <h5 class="footer-newsletter__title">{{ __(@$footerContent->data_values->subscribe_title) }}</h5>
                        <p class="footer-newsletter__desc">{{ __(@$footerContent->data_values->subscribe_subtitle) }}</p>
                    </div>
                    <form class="footer-newsletter-form">
                        <input type="email" name="email" class="form--control" placeholder="@lang('Email Address')" autocomplete="off" />
                        <button type="button" class="btn btn--gradient subscribeBtn">@lang('Subscribe')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-footer py-3">
        <div class="container">
            <div class="row gy-3">
                <div class="col-md-12 text-center">
                    <div class="bottom-footer-text text-white">
                        @lang('Copyright') &copy; @php echo date('Y') @endphp @lang('All rights reserved.')
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@push('script')
    <script>
        (function($) {
            "use strict";
            $('.subscribeBtn').on('click', function(e) {
                e.preventDefault()
                var email = $('[name=email]').val();
                if (!email) {
                    return;
                }
                $.ajax({
                    url: "{{ route('subscribe') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        email: email
                    },
                    success: function(response) {
                        if (response.success) {
                            $('[name=email]').val('')
                            notify('success', response.success);
                        } else {
                            notify('error', response.error);
                        }
                    }
                });
            });
        })(jQuery)
    </script>
@endpush
