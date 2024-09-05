@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-table">
        <div class="custom--card card">
            <div class="card-body">
                <div class="row gy-4 mb-none-30 justify-content-center flex-lg-row-reverse">
                    <div class="col-lg-12 col-xl-6">
                        <div class="product-info">
                            <div class="row gy-4 align-items-center">
                                <div class="col-md-6">
                                    <div class="product-info-top">
                                        <div class="product-info-brand-title">{{ __(ucfirst(@$rent->vehicle->name)) }}</div>
                                        <p class="product-info-brand-model">{{ __(@$rent->vehicle->model) }}</p>
                                    </div>
                                    <div class="product-info-thumb">
                                        <img src="{{ getImage(getFilePath('vehicle') . '/thumb_' . @$rent->vehicle->image, getFileSize('vehicle')) }}" alt="@lang('image')">
                                    </div>
                                    <div class="product-info-bottom">
                                        <p class="product-info-bottom-title">@lang('Rental Price')</p>
                                        <h6 class="product-info-bottom-price">
                                            {{ showAmount($rent->price) }} <small class="currrency">{{ __($general->cur_text) }}</small>
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-info-card-wrapper">
                                        <div class="product-info-card">
                                            <div class="product-info-card-icon">
                                                <i class="fas fa-gavel"></i>
                                            </div>
                                            <div class="product-info-card-text">{{ getAmount($rent->vehicle->cc) }} @lang('CC')</div>
                                        </div>
                                        <div class="product-info-card">
                                            <div class="product-info-card-icon">
                                                <i class="fas fa-level-up-alt"></i>
                                            </div>
                                            <div class="product-info-card-text">{{ getAmount($rent->vehicle->bhp) }} @lang('BHP')</div>
                                        </div>
                                        <div class="product-info-card">
                                            <div class="product-info-card-icon">
                                                <i class="fas fa-tint"></i>
                                            </div>
                                            <div class="product-info-card-text">{{ getAmount($rent->vehicle->speed) }} @lang('Speed')</div>
                                        </div>
                                        <div class="product-info-card">
                                            <div class="product-info-card-icon">
                                                <i class="fas fa-gas-pump"></i>
                                            </div>
                                            <div class="product-info-card-text">{{ getAmount($rent->vehicle->cylinder) }} @lang('Cylinder')</div>
                                        </div>
                                        <div class="product-info-card style-two">
                                            <div class="product-info-card-icon">
                                                <i class="fas fa-car-side"></i>
                                            </div>
                                            <div class="product-info-card-text"> <strong>@lang('Total Run') : </strong> <span>{{ getAmount($rent->vehicle->total_run) }} @lang('km')</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Vehicle Owner')
                                <span class="fw-bold">{{ __(@$rent->vehicle->user->fullname) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Email')
                                <span class="fw-bold">{{ @$rent->vehicle->user->email }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Mobile')
                                <span class="fw-bold">{{ @$rent->vehicle->user->mobile }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Pick Up Zone')
                                <span class="fw-bold">{{ __(@$rent->pickupZone->name) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Pick Up Location')
                                <span class="fw-bold">{{ __(@$rent->pickupPoint->name) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Pick Up Store')
                                <span class="fw-bold">{{ __(@$rent->vehicle->user->store_data->name) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Drop Off Zone')
                                <span class="fw-bold">{{ __(@$rent->dropZone->name) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Drop Off Location')
                                <span class="fw-bold">{{ __(@$rent->dropPoint->name) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Drop Off Store')
                                <span class="fw-bold">{{ __(@$rent->dropPoint->user->store_data->name) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Start Date')
                                <span class="fw-bold">{{ @$rent->start_date }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('End Date')
                                <span class="fw-bold">{{ @$rent->end_date }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Total')
                                <span class="fw-bold">{{ Carbon\Carbon::parse($rent->start_date)->diffInDays($rent->end_date) + 1 }} @lang('Days')</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-confirmation-modal closeBtn="btn btn--danger btn--sm" submitBtn="btn btn--base btn--sm" />
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
            font-weight: 300;
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
            font-weight: 300;
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

        .form-control:focus {
            box-shadow: none;
        }
    </style>
@endpush
