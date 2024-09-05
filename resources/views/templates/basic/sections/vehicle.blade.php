@php
    $vehicleContent = getContent('vehicle.content', true);
@endphp
<section class="our-vehicle bg-img py-120" data-background-image="{{ getImage('assets/images/frontend/vehicle/' . @$vehicleContent->data_values->background_image, '1905x1130') }}">
    <div class="container">
        <div class="section-heading">
            <p class="section-heading__name name-base">{{ __(@$vehicleContent->data_values->heading) }}</p>
            <h3 class="section-heading__title text-white">{{ __(@$vehicleContent->data_values->subheading) }}</h3>
        </div>
        <div class="row g-3 g-md-4">
            @foreach ($vehicleTypes as $vehicleType)
                <div class="col-xsm-6 col-sm-6 col-lg-3">
                    <a href="{{ route('vehicles', $vehicleType->slug) }}" class="vehicle-card">
                        <div class="vehicle-card__thumb">
                            <img src="{{ getImage(getFilePath('vehicleType') . '/' . $vehicleType->image, getFileSize('vehicleType')) }}" alt="@lang('image')" />
                        </div>
                        <div class="vehicle-card__content">
                            <h5 class="vehicle-card__name">{{ __($vehicleType->name) }}</h5>
                            <p class="vehicle-card__desc">{{ __($vehicleType->description) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
