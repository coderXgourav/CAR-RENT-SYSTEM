@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="product-details pt-120 pb-60">
        <div class="container">
            <div class="row g-4 g-md-5">
                <div class="col-lg-7">
                    <div class="product-slider">
                        <div class="slick-item">
                            <img class="fit-image" src="{{ getImage(getFilePath('vehicle') . '/' . $vehicle->image, getFileSize('vehicle')) }}" alt="">
                        </div>
                        @foreach (@$vehicle->images ?? [] as $vehicleImage)
                            <div class="slick-item">
                                <img class="fit-image" src="{{ getImage(getFilePath('vehicle') . '/' . $vehicleImage, getFileSize('vehicle')) }}" alt="@lang('image')">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="details-info-item">
                                <span class="details-info-item__title">@lang('Brand')</span>
                                <div class="details-info-item__content">
                                    <p class="details-info-item__icon">
                                        <i class="icon-Group-31">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </p>
                                    <span class="details-info-item__desc">{{ __(@$vehicle->brand->name) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="details-info-item">
                                <span class="details-info-item__title">@lang('Model Year')</span>
                                <div class="details-info-item__content">
                                    <p class="details-info-item__icon">
                                        <i class="icon-Group-60"></i>
                                    </p>
                                    <span class="details-info-item__desc">{{ $vehicle->year }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="details-info-item">
                                <span class="details-info-item__title">@lang('CC (Cubic Centimeters)')</span>
                                <div class="details-info-item__content">
                                    <p class="details-info-item__icon">
                                        <i class="icon-fi_10156100"></i>
                                    </p>
                                    <span class="details-info-item__desc">{{ getAmount($vehicle->cc) }} @lang('CC')</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="details-info-item">
                                <span class="details-info-item__title">@lang('Seater')</span>
                                <div class="details-info-item__content">
                                    <p class="details-info-item__icon">
                                        <i class="icon-Vector-5"></i>
                                    </p>
                                    <span class="details-info-item__desc">{{ $vehicle->seat }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="details-info-item">
                                <span class="details-info-item__title">@lang('Total Run')</span>
                                <div class="details-info-item__content">
                                    <p class="details-info-item__icon">
                                        <i class="icon-svgexport-6"><span class="path1"></span><span
                                                  class="path2"></span><span class="path3"></span><span
                                                  class="path4"></span><span class="path5"></span><span
                                                  class="path6"></span><span class="path7"></span><span
                                                  class="path8"></span><span class="path9"></span><span
                                                  class="path10"></span><span class="path11"></span>
                                        </i>
                                    </p>
                                    <span class="details-info-item__desc">{{ getAmount($vehicle->total_run) }} @lang('KM')</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="details-info-item">
                                <span class="details-info-item__title">@lang('Fuel Type')</span>
                                <div class="details-info-item__content">
                                    <p class="details-info-item__icon">
                                        <i class="icon-Group-62"><span class="path1"></span><span
                                                  class="path2"></span><span class="path3"></span><span
                                                  class="path4"></span><span class="path5"></span></i>
                                    </p>
                                    <span class="details-info-item__desc">{{ __(@$vehicle->fuel_type) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="details-info">
                                <div class="details-info__left">
                                    <span class="icon">
                                        <i class="icon-fi_1437"></i>
                                    </span>
                                    <div class="text">@lang('Rental Price')</div>
                                </div>
                                <div class="details-info__right">
                                    <div class="details-info-content">
                                        <div class="details-info-content__top">
                                            <span class="text">@lang('PRICE FOR A')</span>
                                            <span class="time">@lang('1 Day')</span>
                                        </div>
                                        <h5 class="details-info-content__price">{{ showAmount($vehicle->price) }} {{ __($general->cur_txet) }}/ @lang('Day')</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            @auth

                                @if (@$vehicle->user_id != auth()->id())
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#rentReserveModal" class="btn btn--gradient btn--lg w-100 ">@lang('Reserve Now')</button>
                                @endif
                            @else
                                <button type="button" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn--gradient btn--lg w-100 ">@lang('Login Now')</button>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="details-tab pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <ul class="nav custom--tab">
                        <li class="tab__bar"></li>
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#rental" type="button">@lang('Rental Details')</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#description" type="button">@lang('Description')</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews" type="button">@lang('Reviews')</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="rental" tabindex="0">
                            <div class="tab-rental-desc">
                                <div class="how-rental__wrapper">
                                    <div class="row g-3 g-xl-5">
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">@lang('Brand ')</p>
                                                <p class="how-rental-item__desc">{{ __(ucfirst(@$vehicle->brand->name)) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">@lang('Type ')</p>
                                                <p class="how-rental-item__desc">{{ __(@$vehicle->vehicleType->name) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">@lang('Class ')</p>
                                                <p class="how-rental-item__desc">{{ __(@$vehicle->vehicleClass->name ?? 'N/A') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">@lang('Pick-up Point & Zone')</p>
                                                <p class="how-rental-item__desc">{{ __(@$vehicle->user->location->name) }} <br> {{ __(@$vehicle->user->zone->name) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">@lang('Drop Point')</p>
                                                <p class="how-rental-item__desc">{{ implode(',', @$vehicle->locationName) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">@lang('Color')</p>
                                                <p class="how-rental-item__desc">{{ __(@$vehicle->color) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">@lang('Mileage')</p>
                                                <p class="how-rental-item__desc">{{ __(@$vehicle->mileage) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">@lang('Model Year')</p>
                                                <p class="how-rental-item__desc">{{ __(@$vehicle->year) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">@lang('Identification Number')</p>
                                                <p class="how-rental-item__desc">{{ @$vehicle->identification_number }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">@lang('Transmission Type')</p>
                                                <p class="how-rental-item__desc">{{ __(@$vehicle->transmission_type) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">@lang('Condition')</p>
                                                <p class="how-rental-item__desc">{{ __(ucfirst($vehicle->vehicle_condition)) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="description" tabindex="0">
                            <div class="tab-rental-desc">
                                <div class="how-rental__wrapper">
                                    @if (@$vehicle->description)
                                        <p>
                                            @php
                                                echo @$vehicle->description;
                                            @endphp
                                        </p>
                                    @else
                                        <p>@lang('No Description Yet!')</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="reviews" tabindex="0">
                            <div class="review-wrapper">
                                @if (!blank(@$vehicle->reviewData))
                                    @foreach ($vehicle->reviewData as $review)
                                        <div class="review-item">
                                            <ul class="rating-list">
                                                @php
                                                    echo showRatings($review->star);
                                                @endphp
                                            </ul>
                                            <q class="review-item__desc">{{ @$review->review }}</q>

                                            <div class="review-item-auth">
                                                <div class="review-item-auth__thumb">
                                                    <img src="{{ getImage(getFilePath('userProfile') . '/' . @$review->user->image, getFileSize('userProfile'), true) }}" alt="avater">
                                                </div>
                                                <div class="review-item-auth__info">
                                                    <p class="review-item-auth__name">{{ __(@$review->user->fullname) }}</p>
                                                    <p class="review-item-auth__designation">{{ @$review->user->username }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="review-item">
                                        <ul class="rating-list">
                                            <li>@lang('No Review Yet!')</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal custom--modal fade" id="rentReserveModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <h5>{{ __(@$vehicle->brand->name) }}</h5>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h6>{{ __(@$vehicle->name) }} - {{ $vehicle->model }}</h6>
                            <h6>@lang('Total') : <span class="total-price">{{ getAmount($vehicle->price) }}</span> {{ __($general->cur_text) }}</h6>
                        </div>
                    </div>

                    <form action="{{ route('user.rental.vehicle', $vehicle->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form--label">@lang('Pick Up')</label>
                            <select class="form--control" name="pick_up_location_id" required>
                                <option value="{{ @$vehicle->user->location_id }}">{{ __($vehicle->user->location->name) }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form--label">@lang('Date')</label>
                            <input name="date" id="date" data-range="true" data-multiple-dates-separator=" - " type="text" data-language="en" class="datepicker-here form--control" data-position="bottom right" placeholder="@lang('Start Date - End Date')" required autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label class="form--label">@lang('Drop off')</label>
                            <select class="form--control" name="drop_off_zone_id" required>
                                <option value="">@lang('Select One')</option>
                                @foreach (@$zones ?? [] as $zone)
                                    <option value="{{ $zone->id }}" data-locations="{{ $zone->locations }}">{{ __($zone->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form--label">@lang('Store Location')</label>
                            <select class="form--control select2-basic" name="drop_off_location_id" required></select>
                        </div>
                        <div class="from-group">
                            <label class="form--label">@lang('Note')</label>
                            <textarea name="note" class="form--control" rows="2">{{ old('note') }}</textarea>
                        </div>
                        @auth
                            <button class="btn btn--lg btn--gradient w-100 mt-3" type="submit">@lang('Confirm Reservation')</button>
                        @else
                            <button class="btn btn--lg btn--gradient w-100 mt-3" type="button">@lang('Login Now')</button>
                        @endauth
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal custom--modal fade" id="loginModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>@lang('Login to Your Account')</h5>
                    <form action="{{ route('user.login') }}" method="POST" class="verify-gcaptcha">
                        @csrf
                        <input type="hidden" name="redirect_url" value="{{ route('vehicle.detail', $vehicle->id) }}">
                        <div class="form-group">
                            <label for="email" class="form--label">@lang('Username or Email')</label>
                            <input type="text" id="email" name="username" value="{{ old('username') }}" class="form--control" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form--label">@lang('Password')</label>
                            <div class="position-relative">
                                <input id="password" type="password" class="form--control" name="password" required>
                                <span class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#password"></span>
                            </div>
                        </div>
                        <x-captcha />
                        <div class="form-group">
                            <button type="submit" id="recaptcha" class="btn btn--gradient w-100">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/datepicker.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/datepicker.en.js') }}"></script>
@endpush

@push('style')
    <style>
        .datepickers-container {
            z-index: 99999 !important;
        }
    </style>
@endpush


@push('script')
    <script>
        (function($) {
            "use strict";
            $(".select2-basic").select2({
                width: "100%",
                dropdownParent: $('#rentReserveModal')
            });

            $('[name=drop_off_zone_id]').on('change', function(e) {
                let locations = $(this).find('option:selected').data('locations');
                let locationHtml = '<option value="">@lang('Select One')</option>';
                $.each(locations, function(index, location) {
                    locationHtml += `<option value="${location.id}">${location.name}</option>`
                });
                $('[name=drop_off_location_id]').html(locationHtml);
            });


            let rentPrice = Number("{{ getAmount($vehicle->price) }}");
            $('.datepicker-here').datepicker({
                changeYear: true,
                changeMonth: true,
                minDate: new Date(),
                onSelect: function(formattedDate, date, inst) {
                    var dates = formattedDate.split(' - ');
                    if (dates.length === 2) {
                        var startDate = new Date(dates[0]);
                        var endDate = new Date(dates[1]);
                        var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
                        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;
                        var totalPrice = rentPrice * diffDays;
                    } else {
                        var totalPrice = rentPrice * 1;
                    }
                    $('.total-price').text(totalPrice)
                }
            });
        })(jQuery)
    </script>
@endpush
