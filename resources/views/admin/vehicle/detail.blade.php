@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4 mb-none-30 justify-content-center flex-lg-row-reverse">
        <div class="col-lg-12 col-xl-6">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    @if ($vehicle->approval_status == Status::VEHICLE_PENDING)
                        <div class="product-action mb-4">
                            <h5 class="product-action-title">@lang('Take Action')</h5>
                            <div class="product-action-btn">
                                <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.vehicle.approve', $vehicle->id) }}" data-question="@lang('Are you sure to approve this vehicle?')" type="button"><i class="las la-check-circle"></i>@lang('Approve')</button>
                                <button class="btn btn-sm btn-outline--danger rejectBtn" type="button"><i class="las la-times-circle"></i>@lang('Reject')</button>
                            </div>
                        </div>
                    @endif
                    <div class="product-info">
                        <div class="row gy-4 align-items-center">
                            <div class="col-md-6">
                                <div class="product-info-top">
                                    <div class="product-info-brand-title">{{ __(ucfirst(@$vehicle->name)) }}</div>
                                    <p class="product-info-brand-model">{{ __(@$vehicle->model) }}</p>
                                </div>
                                <div class="product-info-thumb">
                                    <div class="product-slider">
                                        <div class="slick-item">
                                            <img class="fit-image" src="{{ getImage(getFilePath('vehicle') . '/' . @$vehicle->image, getFileSize('vehicle')) }}" alt="">
                                        </div>
                                        @foreach (@$vehicle->images ?? [] as $vehicleImage)
                                            <div class="slick-item">
                                                <img class="fit-image" src="{{ getImage(getFilePath('vehicle') . '/' . $vehicleImage, getFileSize('vehicle')) }}" alt="@lang('image')">
                                            </div>
                                        @endforeach
                                    </div>
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
                    @if (@$vehicle->description)
                        <div class="mt-5">
                            <h6>@lang('Description')</h6>
                            <p>
                                @php
                                    echo $vehicle->description;
                                @endphp
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-6">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('Vehicle Information')</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Brand ')
                            <span class="fw-bold">{{ __(ucfirst(@$vehicle->brand->name)) }} </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Type')
                            <span class="fw-bold">{{ __(@$vehicle->vehicleType->name) }}</span>
                        </li>
                        @if ($vehicle->vehicle_class_id)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Class')
                                <span class="fw-bold">{{ __(@$vehicle->vehicleClass->name ?? 'N/A') }}</span>
                            </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Pick-up Point')
                            <span class="fw-bold">{{ __(@$vehicle->user->zone->name) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Drop Point')
                            <span class="fw-bold">{{ implode(',', @$vehicle->locationName) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="fw-bold">
                                <a href="{{ route('admin.users.detail', $vehicle->user_id) }}">{{ @$vehicle->user->username }}</a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Color')
                            <span class="fw-bold">{{ __(@$vehicle->color) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Mileage')
                            <span class="fw-bold">{{ @$vehicle->mileage }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Year')
                            <span class="fw-bold">{{ $vehicle->year }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Identification Number')
                            <span class="fw-bold">{{ $vehicle->identification_number }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Transmission Type')
                            <span class="fw-bold">{{ __(ucfirst($vehicle->transmission_type)) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Condition')
                            <span class="fw-bold">{{ __(ucfirst($vehicle->vehicle_condition)) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Fuel Type')
                            <span class="fw-bold">{{ __(ucfirst($vehicle->fuel_type)) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Seat')
                            <span class="fw-bold">{{ $vehicle->seat }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Reject Vehicle Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.vehicle.reject', $vehicle->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>@lang('Are you sure to') <span class="fw-bold">@lang('reject')</span> <span class="fw-bold withdraw-amount text-success"></span> @lang('vehicle of') <span class="fw-bold withdraw-user"></span>?</p>

                        <div class="form-group">
                            <label class="mt-2">@lang('Reason for Rejection')</label>
                            <textarea name="admin_feedback" maxlength="255" class="form-control" rows="5" required>{{ old('admin_feedback') }}</textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.vehicle.index') }}" />
@endpush

@push('style-lib')
    <link href="{{ asset('assets/global/css/slick.css') }}" rel="stylesheet">
@endpush
@push('script-lib')
    <script src="{{ asset('assets/global/js/slick.min.js') }}"></script>
@endpush

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

        /* new */

        .product-slider {
            position: relative;
        }

        .product-slider .slick-initialized.slick-slider {
            margin: 0 0;
        }

        .product-slider .slick-item {
            height: 100%;
            width: 100%;
            display: -webkit-box !important;
            display: -ms-flexbox !important;
            display: flex !important;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            border-radius: 12px;
            overflow: hidden;
        }
    </style>
@endpush


@push('script')
    <script>
        (function($) {
            "use strict";

            $('.rejectBtn').on('click', function() {
                var modal = $('#rejectModal');
                modal.modal('show');
            });

            $(".product-slider").slick({
                dots: false,
                autoplay: true,
                focusOnSelect: true,
                infinite: true,
                arrows: false,
                speed: 300,
                slidesToShow: 1,
                slidesToScroll: 1,
                prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></i></button>',
                responsive: [{
                    breakpoint: 577,
                    settings: {
                        arrows: false,
                        dots: false,
                    },
                }, ],
            });
        })(jQuery);
    </script>
@endpush
