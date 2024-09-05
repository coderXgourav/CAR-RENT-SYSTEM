@extends($activeTemplate . 'layouts.master')



@section('content')
    @php
        $vehicleContent = getContent('vehicle_store.content', true);
        $kycContent = getContent('kyc.content', true);
    @endphp

    @if ($user->store == Status::STORE_INITIATE || $user->store == Status::STORE_REJECTED)
        <div class="alert alert-danger mb-4" role="alert">
            <h6 class="mb-2 text--danger">@lang('Vehicle Store Required')</h6>
            <p class="mb-0 text-dark">{{ __(@$vehicleContent->data_values->store_required_content) }}<a class="text--danger ms-1" href="{{ route('user.vehicle.store') }}">@lang('Click Here to Verify')</a></p>
        </div>
    @elseif($user->store == Status::STORE_PENDING)
        <div class="alert alert-warning mb-4" role="alert">
            <h6 class="mb-2 text--warning">@lang('Vehicle Store Pending')</h6>
            <p class="mb-0 text-dark">{{ __(@$vehicleContent->data_values->store_pending_content) }}<a class="text--warning ms-1" href="{{ route('user.vehicle.store.data') }}">@lang('See Vehicle Store Data')</a></p>
        </div>
    @endif

    @if ($user->kv == Status::KYC_UNVERIFIED)
        <div class="alert alert-danger mb-4" role="alert">
            <h6 class="mb-2 text--danger">@lang('KYC Verification required')</h6>
            <p class="mb-0 text-dark">{{ __(@$kycContent->data_values->kyc_required) }} <a class="text--danger ms-1" href="{{ route('user.kyc.form') }}">@lang('Click Here to Verify')</a></p>
        </div>
    @elseif($user->kv == Status::KYC_PENDING)
        <div class="alert alert-warning mb-4" role="alert">
            <h6 class="mb-2 text--warning">@lang('KYC Verification pending')</h6>
            <p class="mb-0 text-dark">{{ __(@$kycContent->data_values->kyc_pending) }} <a class="text--warning ms-1" href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a></p>
        </div>
    @endif

    @if ($user->store == Status::STORE_APPROVED)
        <div class="card custom--card">
            <div class="card-header">
                <h6 class="mb-0">@lang('Vehicle Availability')</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('vehicles') }}" method="GET">
                    <div class="d-flex flex-wrap gap-4">
                        <div class="flex-grow-1">
                            <label class="form--label">@lang('Pick Up')</label>
                            <select class="form--control" name="pick_up_zone_id" required>
                                <option value="">@lang('Select One')</option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->id }}">{{ __($zone->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-grow-1">
                            <label class="form--label">@lang('Date')</label>
                            <input name="date" id="date" data-range="true" data-multiple-dates-separator=" - "
                                   type="text" data-language="en" class="datepicker-here form--control"
                                   data-position="bottom right" placeholder="@lang('Start Date - End Date')" required autocomplete="off" />
                        </div>
                        <div class="flex-grow-1">
                            <label class="form--label">@lang('Drop off')</label>
                            <select class="form--control select2-basic" name="drop_off_zone_id" required>
                                <option value="">@lang('Select One')</option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->id }}">{{ __($zone->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-grow-1 align-self-end">
                            <button class="btn btn--gradient filter-btn" type="submit">@lang('Filter')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="mt-4">
        <div class="row g-3 g-md-4 justify-content-center">
            <div class="col-md-6 col-sm-6 col-xsm-6">
                <div class="dashboard-widget">
                    <div class="dashboard-widget__shape">
                        <img src="{{ getImage($activeTemplateTrue . 'images/thumbs/shape.png') }}"
                             alt="@lang('image')" />
                    </div>
                    <div class="dashboard-widget__icon">
                        <i class="fas fa-taxi"></i>
                    </div>
                    <div class="dashboard-widget__content">
                        <h4 class="dashboard-widget__number">{{ $widget['total_vehicle'] }}</h4>
                        <span class="dashboard-widget__text">@lang('Total Vehicles')</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xsm-6">
                <div class="dashboard-widget">
                    <div class="dashboard-widget__shape">
                        <img src="{{ getImage($activeTemplateTrue . 'images/thumbs/shape.png') }}"
                             alt="@lang('image')" />
                    </div>
                    <div class="dashboard-widget__icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h4 class="dashboard-widget__number">{{ $general->cur_sym }}{{ showAmount($user->balance) }}</h4>
                    <span class="dashboard-widget__text">@lang('Total Balance')</span>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xsm-6">
                <div class="dashboard-widget">
                    <div class="dashboard-widget__shape">
                        <img src="{{ getImage($activeTemplateTrue . 'images/thumbs/shape.png') }}"
                             alt="@lang('image')" />
                    </div>
                    <div class="dashboard-widget__icon">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <h4 class="dashboard-widget__number">{{ $general->cur_sym }}{{ showAmount($widget['total_income']) }}
                    </h4>
                    <span class="dashboard-widget__text">@lang('Total Income')</span>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xsm-6">
                <div class="dashboard-widget">
                    <div class="dashboard-widget__shape">
                        <img src="{{ getImage($activeTemplateTrue . 'images/thumbs/shape.png') }}"
                             alt="@lang('image')" />
                    </div>
                    <div class="dashboard-widget__icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h4 class="dashboard-widget__number">
                        {{ $general->cur_sym }}{{ showAmount($widget['total_withdrawan']) }}</h4>
                    <span class="dashboard-widget__text">@lang('Total Withdrawan')</span>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-table mt-4">
        <div class="custom--card card">
            <div class="card-header">
                <h6 class="mb-0">@lang('Latest Rental Status')</h6>
            </div>
            <div class="card-body">
                <table class="table table--responsive--xl">
                    <thead>
                        <tr>
                            <th>@lang('Brand')</th>
                            <th>@lang('Rent NO.')</th>
                            <th>@lang('Rented By')</th>
                            <th>@lang('Price')</th>
                            <th>@lang('Expired At')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rentals as $rental)
                            <tr>
                                <td>{{ __(@$rental->vehicle->brand->name) }}</td>
                                <td>{{ @$rental->rent_no }}</td>
                                <td>{{ @$rental->user->username }}</td>
                                <td>{{ showAmount(@$rental->price) }} {{ __($general->cur_text) }}</td>
                                <td>{{ @$rental->end_date }}</td>
                                <td>
                                    @php
                                        echo @$rental->statusBadge;
                                    @endphp
                                </td>
                                <td>
                                    <div class="button--group">
                                        <a href="{{ route('user.rental.detail', $rental->id) }}" class="btn btn--base btn--sm"><i class="las la-lg la-desktop"></i>
                                            @lang('Detail')
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
        #date {
            border: 1px solid hsl(var(--base-two)/0.1) !important;
        }

        #date:focus {
            border: 1px solid hsl(var(--base)) !important;
        }


        .select2-container .select2-selection--single,
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 47px !important;
        }

        .select2-container--default .select2-selection--single,
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid hsl(var(--base-two) / 0.1);
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 47px !important;
        }

        input.select2-search__field {
            outline: none;
        }

        .select2-search--dropdown .select2-search__field {
            padding: 8px 4px;
        }

        span#select2-brand_id-15-container {
            outline: none;
        }

        .select2 .selection {
            width: 100%;
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
