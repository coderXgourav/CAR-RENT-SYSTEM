@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('Store | Username')</th>
                                    <th>@lang('Identification NO.')</th>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Class')</th>
                                    @if (request()->routeIs('admin.vehicle.index'))
                                        <th>@lang('Approval Status')</th>
                                    @endif
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($vehicles as $vehicle)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ __(@$vehicle->user->store_data->name) }}</span>
                                            <br>
                                            <span class="small">
                                                <a href="{{ route('admin.users.detail', $vehicle->user_id) }}"><span>@</span>{{ @$vehicle->user->username }}</a>
                                            </span>
                                        </td>
                                        <td>{{ __(@$vehicle->identification_number) }}</td>
                                        <td>{{ __(@$vehicle->vehicleType->name) }}</td>
                                        <td>{{ __(@$vehicle->vehicleClass->name ?? 'N/A') }}</td>
                                        @if (request()->routeIs('admin.vehicle.index'))
                                            <td>
                                                @php
                                                    echo $vehicle->approvalStatusBadge;
                                                @endphp
                                            </td>
                                        @endif
                                        <td>
                                            @php
                                                echo $vehicle->statusBadge;
                                            @endphp
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.vehicle.detail', $vehicle->id) }}">
                                                    <i class="la la-desktop"></i> @lang('Detail')
                                                </a>
                                                @if ($vehicle->status == Status::ENABLE)
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.vehicle.status', $vehicle->id) }}" data-question="@lang('Are you sure to disable this vehicle?')">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.vehicle.status', $vehicle->id) }}" data-question="@lang('Are you sure to enable this vehicle?')">
                                                        <i class="la la-eye"></i> @lang('Enable')
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($vehicles->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($vehicles) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
@endpush
