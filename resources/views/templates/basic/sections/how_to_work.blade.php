@php
    $howWorkContent = getContent('how_to_work.content', true);
    $howWorkElement = getContent('how_to_work.element', null, 4, true);
@endphp
<section class="work-step py-120">
    <div class="container">
        <div class="section-heading">
            <p class="section-heading__name">{{ __(@$howWorkContent->data_values->heading) }}</p>
            <h3 class="section-heading__title">{{ __(@$howWorkContent->data_values->subheading) }}</h3>
        </div>

        <div class="work-step-wrapper">
            @foreach (@$howWorkElement as $howWork)
                <div class="work-step-card">
                    <p class="work-step-card__top">
                        <span class="icon">
                            @php
                                echo @$howWork->data_values->icon;
                            @endphp
                        </span>
                        <span class="count">{{ $loop->iteration }}</span>
                    </p>
                    <h5 class="work-step-card__title">{{ __(@$howWork->data_values->title) }}</h5>
                    <p class="work-step-card__desc">{{ __(@$howWork->data_values->short_description) }}</p>
                </div>
                @if (!$loop->last)
                    <div class="work-step-shape">
                        <img src="{{ getImage($activeTemplateTrue . 'images/thumbs/step-arrow.png') }}" alt="@lang('image')" />
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
