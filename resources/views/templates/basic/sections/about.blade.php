@php
    $aboutContent = getContent('about.content', true);
    $aboutElement = getContent('about.element', orderById: true);
@endphp
<section class="about-section py-120">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-6">
                <div class="about-section__tumb">
                    <img class="fit-image" src="{{ getImage('assets/images/frontend/about/' . @$aboutContent->data_values->image, '635x530') }}" alt="@lang('image')">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <p class="about-content__subtitle">{{ __(@$aboutContent->data_values->heading) }}</p>
                    <h2 class="about-content__title">{{ __(@$aboutContent->data_values->subheading) }}</h2>
                    <p class="about-content__desc">{{ __(@$aboutContent->data_values->description) }}</p>
                    <div class="about-counter">
                        @foreach (@$aboutElement as $about)
                            <div class="about-counter-item">
                                <span class="about-counter-item__icon">
                                    @php
                                        echo @$about->data_values->icon;
                                    @endphp
                                </span>
                                <div class="about-counter-item__content">
                                    <h1 class="about-counter-item__count">{{ @$about->data_values->amount }}</h1>
                                    <span class="about-counter-item__title">@php echo __(implode('<br>', explode(' ', @$about->data_values->title))) @endphp</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
