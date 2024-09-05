@php
    $chooseContent = getContent('why_choose_us.content', true);
    $chooseElement = getContent('why_choose_us.element', orderById: true);
@endphp
<section class="why-us py-120">
    <div class="container">
        <div class="row gy-4 align-items-center justify-content-between">
            <div class="col-lg-6">
                <div class="about-content">
                    <p class="about-content__subtitle">{{ __(@$chooseContent->data_values->heading) }}</p>
                    <h2 class="about-content__title">{{ __(@$chooseContent->data_values->subheading) }}</h2>
                    <p class="about-content__desc">{{ __(@$chooseContent->data_values->short_description) }}</p>
                    <div class="why-us-benifits">
                        <ul class="why-us-benifits__list">
                            @foreach ($chooseElement as $choose)
                                <li class="why-us-benifits__item">
                                    <span class="why-us-benifits__icon">@php echo @$choose->data_values->icon; @endphp</span>
                                    <span class="why-us-benifits__text">{{ __(@$choose->data_values->title) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <a href="{{ url(@$chooseContent->data_values->button_link) }}" class="btn btn--lg btn--gradient">
                        {{ __(@$chooseContent->data_values->button_name) }} <span class="icon"><i class="far fa-check-circle"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="why-us-thumb">
                    <img src="{{ getImage('assets/images/frontend/why_choose_us/' . @$chooseContent->data_values->image, '555x355') }}" alt="@lang('image')">
                </div>
            </div>
        </div>
    </div>
</section>
