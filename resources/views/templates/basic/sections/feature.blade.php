@php
    $featureContent = getContent('feature.content', true);
    $featureElement = getContent('feature.element', orderById: true);
@endphp
<section class="benifit py-120">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-xl-5 col-xxl-4">
                <div class="benifit-thumb">
                    <img src="{{ getImage('assets/images/frontend/feature/' . @$featureContent->data_values->image, '610x605') }}" alt="@lang('image')" />
                </div>
            </div>
            <div class="col-md-6 col-xl-7 col-xxl-8">
                <div class="section-heading style-left">
                    <p class="section-heading__name">{{ __(@$featureContent->data_values->heading) }}</p>
                    <h3 class="section-heading__title">{{ __(@$featureContent->data_values->subheading) }}</h3>
                </div>
                <div class="benifit-wrapper">
                    <div class="row g-3 g-md-4">
                        @foreach (@$featureElement as $feature)
                            <div class="col-6 col-md-12 col-xl-6">
                                <div class="benifit-card">
                                    <div class="benifit-card__icon">
                                        @php
                                            echo @$feature->data_values->icon;
                                        @endphp
                                    </div>
                                    <div class="benifit-card__content">
                                        <h6 class="benifit-card__title">{{ __(@$feature->data_values->title) }}</h6>
                                        <p class="benifit-card__desc">{{ __(@$feature->data_values->description) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="benifit-shape">
            <img src="{{ getImage('assets/images/frontend/feature/' . @$featureContent->data_values->background_image, '995x545') }}" alt="@lang('image')" />
        </div>
    </div>
</section>
