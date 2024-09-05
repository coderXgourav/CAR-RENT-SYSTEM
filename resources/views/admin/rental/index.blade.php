@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('User')</th>
                                    <th>@lang('Rent No')</th>
                                    <th>@lang('Pick Up | Drop Zone')</th>
                                    <th>@lang('Price')</th>
                                    @if (request()->routeIs('admin.rental.index'))
                                        <th>@lang('Status')</th>
                                    @endif
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rentals as $rental)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ __(@$rental->user->fullname) }}</span>
                                            <br>
                                            <span class="small">
                                                <a href="{{ route('admin.users.detail', $rental->user_id) }}"><span>@</span>{{ @$rental->user->username }}</a>
                                            </span>
                                        </td>

                                        <td>{{ $rental->rent_no }}</td>
                                        <td>{{ __(@$rental->pickupZone->name) }} <br>{{ __(@$rental->dropZone->name) }}</td>
                                        <td>{{ showAmount($rental->price) }} {{ __($general->cur_text) }}</td>
                                        @if (request()->routeIs('admin.rental.index'))
                                            <td>
                                                @php
                                                    echo $rental->statusBadge;
                                                @endphp
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{ route('admin.rental.detail', $rental->id) }}" class="btn btn-sm btn-outline--primary">
                                                <i class="las la-desktop"></i> @lang('Details')
                                            </a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($rentals->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($rentals) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Search by Rent No" />
@endpush

@push('style')
    <style>
        .badge--info {
            border-radius: 999px;
            padding: 2px 15px;
            position: relative;
            border-radius: 999px;
            -webkit-border-radius: 999px;
            -moz-border-radius: 999px;
            -ms-border-radius: 999px;
            -o-border-radius: 999px;
        }

        .badge--info {
            background-color: rgb(30, 159, 242, 0.1);
            border: 1px solid #1e9ff2;
            color: #1e9ff2;
        }
    </style>
@endpush
