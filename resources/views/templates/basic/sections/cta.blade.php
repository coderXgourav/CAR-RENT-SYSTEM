@php
    $ctaContent = getContent('cta.content', true);
@endphp

<section class="clt-section">
    <div class="container">
        <div class="clt-section-wrapper">
            <div class="clt-section-wrapper-video">
                <video src="{{ @$ctaContent->data_values->video_link }}" autoplay="" loop="" muted="" type="video/mp4"></video>
            </div>
            <div class="clt-content">
                <h5 class="clt-content__subheading">{{ __(@$ctaContent->data_values->heading) }}</h5>
                <h2 class="clt-content__heading">{{ __(@$ctaContent->data_values->subheading) }}</h2>
                <p class="clt-content__desc">{{ __(@$ctaContent->data_values->short_description) }}</p>
                <div class="clt-content__button">
                    <a href="{{ url(@$ctaContent->data_values->button_link) }}" class="btn btn--lg btn--gradient">{{ __(@$ctaContent->data_values->button_name) }}
                        <span><i class="las la-chevron-circle-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
