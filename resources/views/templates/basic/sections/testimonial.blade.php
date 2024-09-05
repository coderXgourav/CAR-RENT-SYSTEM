@php
    $testimonialContent = getContent('testimonial.content', true);
    $testimonialElement = getContent('testimonial.element', orderById: true);
@endphp

<section class="testimonials py-120">
    <div class="container">
        <div class="section-heading">
            <p class="section-heading__name">{{ __(@$testimonialContent->data_values->heading) }}</p>
            <h2 class="section-heading__title text-dark">{{ __(@$testimonialContent->data_values->subheading) }}</h2>
        </div>

        <div class="testimonial-slider">
            @foreach (@$testimonialElement as $testimonial)
                <div class="testimonial-item">
                    <q class="testimonial-item__desc">{{ __(@$testimonial->data_values->quotes) }}</q>
                    <div class="testimonial-item__info">
                        <div class="testimonial-item__thumb">
                            <img src="{{ getImage('assets/images/frontend/testimonial/' . @$testimonial->data_values->image, '60x60') }}" class="fit-image" alt="@lang('image')" />
                        </div>
                        <div class="testimonial-item__details">
                            <p class="testimonial-item__name">{{ __(@$testimonial->data_values->name) }}</p>
                            <span class="testimonial-item__designation">{{ __(@$testimonial->data_values->designation) }}, {{ __(@$testimonial->data_values->company_name) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
