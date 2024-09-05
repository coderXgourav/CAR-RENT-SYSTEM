@php
    $bannerContent = getContent('banner.content', true);
    $bannerElement = getContent('banner.element', orderById: true);
@endphp
<section class="banner-section py-120">
    <div class="container">
        <div class="banner-section__shape">
            <img src="{{ getImage('assets/images/frontend/banner/' . @$bannerContent->data_values->background_image, '1010x715') }}" alt="@lang('image')" />
        </div>
        <div class="row align-items-center flex-lg-row-reverse gy-4 gy-sm-5">
            <div class="col-xl-7 col-lg-6">
                <div class="banner-slider">
                    @foreach (@$bannerElement as $banner)
                        <div class="slick-item">
                            <img src="{{ getImage('assets/images/frontend/banner/' . @$banner->data_values->slider_image, '670x395') }}" alt="@lang('image')" />
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-5 col-lg-6">
                <div class="banner-content">
                    <h4 class="banner-content__heading">{{ __(@$bannerContent->data_values->heading) }}</h4>
                    <h1 class="banner-content__title highlight" data-length="4">{{ __(@$bannerContent->data_values->subheading) }}</h1>
                    <p class="banner-content__desc">{{ __(@$bannerContent->data_values->short_description) }}</p>
                    <div class="banner-content__button">
                        <a href="{{ url(@$bannerContent->data_values->button_link) }}" class="btn btn--lg btn--gradient">{{ __(@$bannerContent->data_values->button_name) }}
                            <span class="icon"><i class="las la-chevron-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@push('script')
    <script>
        (function($) {
            "use strict";
            $(window).on('load', function(e) {
                let hightlightContent = $('.highlight');
                let content = hightlightContent.text();
                let splitContent = content.split(' ');
                let length = hightlightContent.data('length');
                let htmlContent = ``;
                for (let i = 0; i < splitContent.length; i++) {
                    if (i === (length - 1)) {
                        htmlContent += ' ' + `<span class="text--base px-1">${splitContent[i]}</span>`
                    } else {
                        htmlContent += ' ' + splitContent[i];
                    }
                }
                hightlightContent.html(htmlContent);
            });
        })(jQuery)
    </script>
@endpush
