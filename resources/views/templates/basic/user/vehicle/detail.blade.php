@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-4 justify-content-center flex-lg-row-reverse">
        <div class="col-xl-6">
            <div class="card custom--card">
                <div class="card-body">
                    <div class="product-info">
                        <div class="row gy-4 align-items-center">
                            <div class="col-md-6">
                                <div class="product-info-top">
                                    <div class="product-info-brand-title">{{ __(ucfirst(@$vehicle->name)) }}</div>
                                    <p class="product-info-brand-model">{{ __(@$vehicle->model) }}</p>
                                </div>
                                <div class="product-info-thumb">
                                    <img src="{{ getImage(getFilePath('vehicle') . '/thumb_' . $vehicle->image, getFileSize('vehicle')) }}" alt="@lang('image')">
                                </div>
                                <div class="product-info-bottom">
                                    <p class="product-info-bottom-title">@lang('Rental Price')</p>
                                    <h6 class="product-info-bottom-price">
                                        {{ showAmount($vehicle->price) }} <small class="currrency">{{ __($general->cur_text) }} / <sub class="fw-bold">@lang('DAY')</sub></small>
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-info-card-wrapper">
                                    <div class="product-info-card">
                                        <div class="product-info-card-icon">
                                            <i class="fas fa-gavel"></i>
                                        </div>
                                        <div class="product-info-card-text">{{ getAmount($vehicle->cc) }} @lang('CC')</div>
                                    </div>
                                    <div class="product-info-card">
                                        <div class="product-info-card-icon">
                                            <i class="fas fa-level-up-alt"></i>
                                        </div>
                                        <div class="product-info-card-text">{{ getAmount($vehicle->bhp) }} @lang('BHP')</div>
                                    </div>
                                    <div class="product-info-card">
                                        <div class="product-info-card-icon">
                                            <i class="fas fa-tint"></i>
                                        </div>
                                        <div class="product-info-card-text">{{ getAmount($vehicle->speed) }} @lang('Speed')</div>
                                    </div>
                                    <div class="product-info-card">
                                        <div class="product-info-card-icon">
                                            <i class="fas fa-gas-pump"></i>
                                        </div>
                                        <div class="product-info-card-text">{{ getAmount($vehicle->cylinder) }} @lang('Cylinder')</div>
                                    </div>
                                    <div class="product-info-card style-two">
                                        <div class="product-info-card-icon">
                                            <i class="fas fa-car-side"></i>
                                        </div>
                                        <div class="product-info-card-text"> <strong>@lang('Total Run') : </strong> <span>{{ getAmount($vehicle->total_run) }} @lang('km')</span> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card custom--card">
                <div class="card-body">
                    <h5>@lang('Vehicle Information')</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Brand ')
                            <span class="fw-bold">{{ __(ucfirst(@$vehicle->brand->name)) }} </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Type')
                            <span class="fw-bold">{{ __(@$vehicle->vehicleType->name) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Class')
                            <span class="fw-bold">{{ __(@$vehicle->vehicleClass->name) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Pick-up Point')
                            <span class="fw-bold">{{ __(@$vehicle->user->location->name) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Drop Point')
                            <span class="fw-bold">{{ implode(', ', @$vehicle->locationName) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Color')
                            <span class="fw-bold">{{ __(@$vehicle->color) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Mileage')
                            <span class="fw-bold">{{ @$vehicle->mileage }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Year')
                            <span class="fw-bold">{{ $vehicle->year }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Identification Number')
                            <span class="fw-bold">{{ $vehicle->identification_number }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Transmission Type')
                            <span class="fw-bold">{{ __(ucfirst($vehicle->transmission_type)) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Condition')
                            <span class="fw-bold">{{ __(ucfirst($vehicle->vehicle_condition)) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Fuel Type')
                            <span class="fw-bold">{{ __(ucfirst($vehicle->fuel_type)) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Seat')
                            <span class="fw-bold">{{ __($vehicle->seat) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .product-info-top {
            margin-bottom: 12px;
        }

        .product-info-brand-title {
            font-weight: 600;
            color: hsl(var(--black));
            line-height: 1;
        }

        .product-info-brand-model {
            font-size: 12px;
            font-weight: 700;
        }

        .product-info-thumb {
            width: 100%;
        }

        .product-info-thumb img {
            border-radius: 16px;
        }

        .product-info-bottom {
            margin-top: 12px;
        }

        .product-info-bottom-title {
            font-size: 12px;
            font-weight: 700;
        }

        .product-info-bottom-price {
            color: hsl(var(--black));
            font-weight: 600;
        }

        .product-info-bottom-price .currrency {
            font-size: 12px;
            font-weight: 400;
        }

        .product-info-card-wrapper {
            display: flex;
            justify-content: center;
            align-items: stretch;
            gap: 6px;
            flex-wrap: wrap;
        }

        .product-info-card {
            padding: 16px 12px;
            border-radius: 16px;
            width: calc(100% / 2 - 3px);
            background-color: rgb(247 246 249);
            text-align: center;
        }

        .product-info-card.style-two {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-info-card-icon {
            height: 36px;
            width: 36px;
            display: grid;
            place-content: center;
            margin: 0 auto 12px;
            background-color: #e5e3e7;
            border-radius: 50%;
            font-size: 14px;
        }

        .product-info-card.style-two .product-info-card-icon {
            margin: 0;
            margin-right: 12px;
        }

        .product-info-card-text {
            font-size: 13px;
            font-weight: 500;
            line-height: 1;
        }

        @media (max-width: 1299px) {
            .product-info-card.style-two .product-info-card-text {
                font-size: 12px;
            }
        }

        .product-action {}

        .product-action-title {
            text-align: right;
            margin-bottom: 12px;
        }

        .product-action-btn {
            display: flex;
            gap: 6px;
            align-items: center;
            justify-content: flex-end;
        }
    </style>
@endpush
