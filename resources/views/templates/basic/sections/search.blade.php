@php
    $vehicleTypes = App\Models\vehicleType::active()->get(['id', 'name']);
    $zones = App\Models\Zone::active()->get();
@endphp
<div class="search-form">
    <div class="container">
        <form action="{{ route('vehicles') }}" method="GET">
            <div class="search-form__wrapper">
                <div class="search-form-item">
                    <label class="form--label">@lang('Select Vehicle')</label>
                    <select class="form--control  select2-basic" name="vehicle_type_id">
                        <option value="">@lang('Select One')</option>
                        @foreach ($vehicleTypes as $vehicleType)
                            <option value="{{ $vehicleType->id }}">{{ __($vehicleType->name) }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="search-form-item">
                    <label class="form--label">@lang('Pick Up')</label>
                    <select class="form--control  select2-basic" name="pick_up_zone_id" required>
                        <option value="">@lang('Select One')</option>
                        @foreach ($zones as $zone)
                            <option value="{{ $zone->id }}">{{ __($zone->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="search-form-item">
                    <label class="form--label">@lang('Date')</label>
                    <input name="date" id="date" data-range="true" data-multiple-dates-separator=" - " type="text" data-language="en" class="datepicker-here form--control" data-position="bottom right" placeholder="@lang('Start Date - End Date')" required autocomplete="off" />
                </div>
                <div class="search-form-item">
                    <label class="form--label">@lang('Drop off')</label>
                    <select class="form--control select2-basic" name="drop_off_zone_id" required>
                        <option value="">@lang('Select One')</option>
                        @foreach ($zones as $zone)
                            <option value="{{ $zone->id }}">{{ __($zone->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="search-form__button">
                    <button class="btn btn--gradient"><span class="me-2"><i class="fas fa-search"></i></span> @lang('Search')</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/datepicker.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/datepicker.en.js') }}"></script>
@endpush

@push('style')
    <style>
        #date {
            border: 1px solid hsl(var(--base-two)/0.1) !important;
        }

        #date:focus {
            border: 1px solid hsl(var(--base)) !important;
        }
    </style>
@endpush


@push('script')
    <script>
        (function($) {
            "use strict";
            $(".select2-basic").select2({
                width: "100%",
            });

            $('.datepicker-here').datepicker({
                changeYear: true,
                changeMonth: true,
                minDate: new Date(),
            });
        })(jQuery)
    </script>
@endpush
