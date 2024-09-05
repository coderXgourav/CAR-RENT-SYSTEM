@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-table">
        <div class="custom--card card">
            <div class="card-body">
                <div class="row gy-4 mb-4 mb-lg-5 align-items-center">
                    <div class="col-md-6">
                        <div class="filter-btn-wrapper">
                            <a href="{{ route('user.vehicle.index') }}" class="btn btn--sm btn-outline--base @if (request()->routeIs('user.vehicle.index')) active @endif">@lang('All')</a>
                            <a href="{{ route('user.vehicle.pending') }}" class="btn btn--sm btn-outline--warning @if (request()->routeIs('user.vehicle.pending')) active @endif">@lang('Pending')</a>
                            <a href="{{ route('user.vehicle.approved') }}" class="btn btn--sm btn-outline--success @if (request()->routeIs('user.vehicle.approved')) active @endif">@lang('Approved')</a>
                            <a href="{{ route('user.vehicle.rejected') }}" class="btn btn--sm btn-outline--danger @if (request()->routeIs('user.vehicle.rejected')) active @endif">@lang('Rejected<')/a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="" class="filter-search-form">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control form--control" value="{{ request()->search }}" placeholder="@lang('Search here...')">
                                <button class="input-group-text bg--base text-white border-0" type="submit"><i class="las la-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table--responsive--xl">
                    <thead>
                        <tr>
                            <th>@lang('Vehicle Type')</th>
                            <th>@lang('Model')</th>
                            <th>@lang('Identification NO.')</th>
                            <th>@lang('Approval Status')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehicles as $vehicle)
                            <tr>
                                <td>{{ __(@$vehicle->vehicleType->name) }}</td>
                                <td>{{ __(@$vehicle->model) }}</td>
                                <td>{{ @$vehicle->identification_number }}</td>
                                <td>
                                    @php
                                        echo $vehicle->approvalStatusBadge;
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        echo $vehicle->statusBadge;
                                    @endphp
                                </td>
                                <td>
                                    <div class="button--group">
                                        <a href="{{ route('user.vehicle.add', $vehicle->id) }}" class="btn btn--base btn--sm"><i class="las la-lg la-pen"></i> @lang('Edit')</a>
                                        <a href="{{ route('user.vehicle.detail', $vehicle->id) }}" class="btn btn--info btn--sm"><i class="las la-lg la-desktop"></i> @lang('Detail')</a>
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
                {{ paginateLinks($vehicles) }}
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .form-control:focus {
            box-shadow: none;
        }
    </style>
@endpush
