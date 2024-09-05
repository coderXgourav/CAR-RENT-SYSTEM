@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="filter-search pt-120 mb-0">
        <div class="container">
            <div class="text-end">
                <button class="btn btn--gradient" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                        aria-controls="offcanvasExample">
                    <i class="las la-filter"></i> @lang('Filter')
                </button>
            </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
                 aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">@lang('Filter Vehicles')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form action="">
                        @if ($slug)
                            @if (@$vehicleType->manage_class)
                                <div class="form-group">
                                    <label class="form--label">@lang('Vehicle Class')</label>
                                    <select class="form--control" name="vehicle_class_id">
                                        <option value="">@lang('All')</option>
                                        @foreach ($vehicleClasses as $vehicleClass)
                                            <option value="{{ $vehicleClass->id }}" @selected($vehicleClass->id == request()->vehicle_class_id)>
                                                {{ __($vehicleClass->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="form--label">@lang('Brand')</label>
                                <select class="form--control" name="brand_id">
                                    <option value="">@lang('All')</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" @selected($brand->id == request()->brand_id)>
                                            {{ __($brand->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form--label">@lang('Transmission Type')</label>
                                <select class="form--control" name="transmission_type">
                                    <option value="">@lang('All')</option>
                                    <option value="automatic" @selected(request()->transmission_type == 'automatic')>@lang('Automatic')</option>
                                    <option value="manual" @selected(request()->transmission_type == 'manual')>@lang('Manual')</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form--label">@lang('Fuel Type')</label>
                                <select class="form--control" name="fuel_type">
                                    <option value="">@lang('All')</option>
                                    <option value="gasholine" @selected(request()->fuel_type == 'gasholine')>@lang('Gasholine')</option>
                                    <option value="diesel" @selected(request()->fuel_type == 'diesel')>@lang('Diesel')</option>
                                    <option value="electric" @selected(request()->fuel_type == 'electric')>@lang('Electric')</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form--label">@lang('Price')</label>
                                <select class="form--control" name="price">
                                    <option value="">@lang('All')</option>
                                    <option value="price_asc" @selected(request()->price == 'price_asc')>@lang('Low to High')</option>
                                    <option value="price_desc" @selected(request()->price == 'price_desc')>@lang('High to Low')</option>
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="form--label">@lang('Pick Up Location')</label>
                            <select class="form--control select2-basic" name="pick_up_zone_id">
                                <option value="">@lang('Select One')</option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->id }}" @selected($zone->id == request()->pick_up_zone_id)>
                                        {{ __($zone->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form--label">@lang('Date')</label>
                            <input name="date" id="date" data-range="true" data-multiple-dates-separator=" - "
                                   type="text" data-language="en" class="date-filter form--control" data-position="top left"
                                   placeholder="@lang('Start Date - End Date')" autocomplete="off" value="{{ request()->date }}" />
                        </div>

                        <div class="form-group">
                            <label class="form--label">@lang('Drop Off Location')</label>
                            <select class="form--control select2-basic" name="drop_off_zone_id">
                                <option value="">@lang('Select One')</option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->id }}" @selected($zone->id == request()->drop_off_zone_id)>
                                        {{ __($zone->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="product-section pt-60 pb-120">
        <div class="container">
            <div class="row g-3 g-md-4">
                @include($activeTemplate . 'partials.filtered_vehicle')
            </div>
        </div>
    </section>
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
        .form-control:focus {
            box-shadow: none;
        }

        .datepicker {
            z-index: 9999;
        }
    </style>
@endpush


@push('script')
    <script>
        (function($) {
            "use strict";
            $(".select2-basic").select2({
                width: "100%",
            })
            $('.date-filter').datepicker({
                changeYear: true,
                changeMonth: true,
                minDate: new Date()
            });
        })(jQuery)
    </script>
@endpush
