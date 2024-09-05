@forelse ($vehicles as $vehicle)
    <div class="col-lg-4 col-sm-6 col-xsm-6">
        <div class="product-card">
            <div class="product-card__thumb">
                <img class="fit-image" src="{{ getImage(getFilePath('vehicle') . '/thumb_' . @$vehicle->image, getFileSize('vehicle')) }}" alt="@lang('image')">
            </div>
            <div class="product-card__body">
                <h5 class="product-card__title">
                    <a href="{{ route('vehicle.detail', $vehicle->id) }}">{{ __($vehicle->name) }} - {{ __($vehicle->model) }} </a>
                </h5>
                <ul class="product-card-list">
                    <li class="product-card-list__item">
                        <span class="product-card-list__icon">
                            <i class="icon-Group-60"></i>
                        </span>
                        <span class="product-card-list__text">{{ $vehicle->year }}</span>
                    </li>
                    <li class="product-card-list__item">
                        <span class="product-card-list__icon">
                            <i class="icon-fi_10156100"></i>
                        </span>
                        <span class="product-card-list__text">{{ getAmount($vehicle->cc) }}</span>
                    </li>
                    <li class="product-card-list__item">
                        <span class="product-card-list__icon">
                            <i class="icon-Vector-5"></i>
                        </span>
                        <span class="product-card-list__text">{{ $vehicle->seat }}</span>
                    </li>
                    <li class="product-card-list__item">
                        <span class="product-card-list__icon">
                            <i class="icon-fi_483497"></i>
                        </span>
                        <span class="product-card-list__text">{{ __($vehicle->fuel_type) }}</span>
                    </li>
                    <li class="product-card-list__item">
                        <span class="product-card-list__icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <span class="product-card-list__text">{{ __($vehicle->user->zone->name) }}</span>
                    </li>
                </ul>
                <div class="product-info">
                    <div class="product-info__wrapper">
                        <div class="product-info__icon">
                            <span class="icon-fi_1437"></span>
                        </div>
                        <div class="product-info__content">
                            <span class="product-info__title">@lang('Rental Price')</span>
                            <p class="product-info__price"><span>{{ showAmount($vehicle->price) }}</span>  {{ __($general->cur_text) }}/ @lang('Day')</p>
                        </div>
                    </div>
                    <a href="{{ route('vehicle.detail', $vehicle->id) }}" class="btn btn--gradient product-info__btn">@lang('Rent Now')</a>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="text-center">
        <div class="emtpty-image">
            <img src="{{ getImage($activeTemplateTrue . 'images/empty.png') }}" alt="@lang('image')">
        </div>
    </div>
@endforelse
{{ paginateLinks($vehicles) }}
