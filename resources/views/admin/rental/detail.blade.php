@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-3">
        <div class="col-xxl-4 col-xl-5 col-lg-12">
            <div class="card user-card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h6>{{ __(@$rental->user->fullname) }} @lang('requested for rental') </h6>
                        <a href="{{ route('admin.users.detail', $rental->user_id) }}" class="btn btn-outline--primary btn-sm"><i class="las la-user"></i>@lang('User Profile')</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user__profile">
                        <div class="user__profile-thumb">
                            <img src="{{ getImage(getFilePath('userProfile') . '/' . @$rental->user->image, getFileSize('userProfile'), true) }}" alt="@lang('image')">
                        </div>
                        <div class="user__profile-info">
                            <h4>{{ $rental->user->fullname }}</h4>
                            <p>@lang('Store') : {{ __(@$rental->user->store_data->name ?? '***') }}</p>
                            <p>@lang('Location') : {{ __(@$rental->user->location->name ?? '***') }}</p>
                        </div>
                    </div>
                    <div class="user__more-information">
                        <ul>
                            <li>
                                <span>@lang('Mobile Number')</span>
                                <span>{{ @$rental->user->mobile }}</span>
                            </li>
                            <li>
                                <span>@lang('Email')</span>
                                <span>{{ @$rental->user->email }}</span>
                            </li>
                            <li>
                                <span>@lang('Joined')</span>
                                <span>{{ showDateTime(@$rental->user->created_at) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card user-card mt-4 b-radius--10 overflow-hidden box--shadow1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h6>@lang('Vehicle Owner')</h6>
                        <a href="{{ route('admin.users.detail', $rental->vehicleOwner->id) }}" class="btn btn-outline--primary btn-sm"><i class="las la-user"></i>@lang('Owner Profile')</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user__profile">
                        <div class="user__profile-thumb">
                            <img src="{{ getImage(getFilePath('userProfile') . '/' . @$rental->vehicleOwner->image, getFileSize('userProfile'), true) }}" alt="@lang('image')">
                        </div>
                        <div class="user__profile-info">
                            <h4>{{ @$rental->vehicleOwner->fullname }}</h4>
                            <p>@lang('Store') : {{ __(@$rental->vehicleOwner->store_data->name ?? '***') }}</p>
                            <p>@lang('Location') : {{ __(@$rental->vehicleOwner->location->name ?? '***') }}</p>
                        </div>
                    </div>
                    <div class="user__more-information">
                        <ul>
                            <li>
                                <span>@lang('Mobile Number')</span>
                                <span>{{ @$rental->vehicleOwner->mobile }}</span>
                            </li>
                            <li>
                                <span>@lang('Email')</span>
                                <span>{{ @$rental->vehicleOwner->email }}</span>
                            </li>
                            <li>
                                <span>@lang('Joined')</span>
                                <span>{{ showDateTime(@$rental->vehicleOwner->created_at) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-8 col-xl-7 col-lg-12">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <div class="product-info">
                        <div class="row gy-4 align-items-center">
                            <div class="col-md-6">
                                <div class="product-info-top">
                                    <div class="product-info-brand-title">{{ __(ucfirst(@$rental->vehicle->name)) }}</div>
                                    <p class="product-info-brand-model">{{ __(@$rental->vehicle->model) }}</p>
                                </div>

                                <div class="product-info-thumb">
                                    <img src="{{ getImage(getFilePath('vehicle') . '/thumb_' . @$rental->vehicle->image, getFileSize('vehicle')) }}" alt="@lang('image')">
                                </div>
                                <div class="product-info-bottom">
                                    <strong>@lang('Rental Price')</strong>
                                    <h6 class="product-info-bottom-price">{{ showAmount(@$rental->price) }} {{ __($general->cur_text) }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="product-info-card-wrapper">
                                    <div class="product-info-card">
                                        <div class="product-info-card-icon">
                                            <i class="fas fa-gavel"></i>
                                        </div>
                                        <div class="product-info-card-text">{{ getAmount(@$rental->vehicle->cc) }} @lang('CC')</div>
                                    </div>
                                    <div class="product-info-card">
                                        <div class="product-info-card-icon">
                                            <i class="fas fa-level-up-alt"></i>
                                        </div>
                                        <div class="product-info-card-text">{{ getAmount(@$rental->vehicle->bhp) }} @lang('BHP')</div>
                                    </div>
                                    <div class="product-info-card">
                                        <div class="product-info-card-icon">
                                            <i class="fas fa-tint"></i>
                                        </div>
                                        <div class="product-info-card-text">{{ getAmount(@$rental->vehicle->speed) }} @lang('Speed')</div>
                                    </div>
                                    <div class="product-info-card">
                                        <div class="product-info-card-icon">
                                            <i class="fas fa-gas-pump"></i>
                                        </div>
                                        <div class="product-info-card-text">{{ getAmount(@$rental->vehicle->cylinder) }} @lang('Cylinder')</div>
                                    </div>
                                    <div class="product-info-card style-two">
                                        <div class="product-info-card-icon">
                                            <i class="fas fa-car-side"></i>
                                        </div>
                                        <div class="product-info-card-text"> <strong>@lang('Total Run') : </strong> <span>{{ getAmount(@$rental->vehicle->total_run) }} @lang('km')</span> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card b-radius--10 overflow-hidden box--shadow1 mt-4">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('More Information')</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Pick Up Zone')
                            <span class="fw-bold">{{ __(@$rental->pickupZone->name) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Pick Up Location')
                            <span class="fw-bold">{{ __(@$rental->pickupPoint->name) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Drop Off Zone')
                            <span class="fw-bold">{{ __(@$rental->dropZone->name) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Drop Off Location')
                            <span class="fw-bold">{{ __(@$rental->dropPoint->name) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Drop Store')
                            <a class="fw-bold" href="{{ route('admin.users.detail', $rental->dropPoint->user_id) }}">{{ __(@$rental->dropPoint->user->store_data->name) }}</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('Start Date')
                            <span class="fw-bold">{{ @$rental->start_date }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            @lang('End Date')
                            <span class="fw-bold">{{ @$rental->end_date }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.vehicle.index') }}" />
@endpush


@push('style')
    <style>
        .user-card .card-body {
            padding: 30px 25px;
        }

        .user__profile {
            display: flex;
            margin-bottom: 30px;
            border-bottom: 1px solid #dddddd94;
            padding-bottom: 30px;
        }

        .user__profile-thumb {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 1px solid #dddddd94;
        }

        .user__profile-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .user__profile-info {
            width: calc(100% - 90px);
            padding-left: 30px;
        }

        .user__profile-info h4 {
            font-weight: 500;
            margin-bottom: 10px;
        }

        .user__profile-info p {
            margin-bottom: 5px;
        }

        .user__more-information ul li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .user__more-information ul li:last-child {
            margin-bottom: 0px;
        }

        .user__more-information ul li span:first-child {
            color: #34495e;

        }

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
    </style>
@endpush
