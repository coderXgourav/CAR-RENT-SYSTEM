@php
    $partnerElement = getContent('partner.element', false, null, true);
@endphp
<div class="py-120 brand-section bg-white">
    <div class="container">
        <div class="brand-section__slider">
            <div class="brand-slider">
                @foreach ($partnerElement as $partner)
                    <div class="brand-slider-item">
                        <img src="{{ getImage('assets/images/frontend/partner/' . @$partner->data_values->image, '155x85') }}" alt="image" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
