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
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($zones as $zone)
                                    <tr>
                                        <td>{{ $zones->firstItem() + $loop->index }}</td>
                                        <td>{{ __($zone->name) }}</td>
                                        <td>
                                            @php
                                                echo $zone->statusBadge;
                                            @endphp
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.zone.add', $zone->id) }}">
                                                    <i class="la la-pencil"></i> @lang('Edit')
                                                </a>

                                                @if ($zone->status == Status::ENABLE)
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.zone.status', $zone->id) }}" data-question="@lang('Are you sure to disable this zone?')">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.zone.status', $zone->id) }}" data-question="@lang('Are you sure to enable this zone?')">
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
                @if ($zones->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($zones) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
    <a class="btn btn--lg btn-outline--primary" href="{{ route('admin.zone.add') }}"><i class="las la-plus"></i>@lang('Add New')</a>
@endpush
