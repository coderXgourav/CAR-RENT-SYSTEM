@php
    $ctaContact = getContent('cta_contact.content', true);
    $ctaElement = getContent('cta_contact.element', orderById: true);
@endphp

<section class="cta-contact py-120">
    <div class="container">
        <div class="row gy-4 align-items-center justify-content-center">
            <div class="col-lg-6">
                <div class="cta-contact-info-left">
                    <h2 class="cta-contact__title">{{ __(@$ctaContact->data_values->heading) }}</h2>
                    <p class="cta-contact-info__subtitle">
                        {{ __(@$ctaContact->data_values->subheading) }}
                    </p>
                    <ul class="cta-contact-info__list">
                        @foreach (@$ctaElement as $cta)
                            <li><i class="las la-check-square"></i> {{ __(@$cta->data_values->title) }}</li>
                        @endforeach
                    </ul>
                    <div class="cta-contact-info__btn">
                        <a class="btn btn--black" href="{{ url(@$ctaContact->data_values->contact_button_link) }}">
                            {{ __(@$ctaContact->data_values->contact_button) }} <span><i class="las la-chevron-circle-right"></i></span>
                        </a>
                    </div>

                </div>
            </div>

            <div class="col-lg-6">
                <div class="cta-contact-thumb">
                    <img src="{{ getImage('assets/images/frontend/cta_contact/' . @$ctaContact->data_values->image, '640x380') }}" alt="image">
                </div>
            </div>
        </div>
    </div>
</section>
