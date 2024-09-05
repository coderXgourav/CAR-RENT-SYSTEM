@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-table">
        <div class="custom--card card">
            <div class="card-body">
                <div class="text-end mb-3">
                    <form action="" class="filter-search-form">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control form--control" value="{{ request()->search }}" placeholder="@lang('Search by rent no...')">
                            <button class="input-group-text bg--base text-white border-0" type="submit"><i class="las la-search"></i></button>
                        </div>
                    </form>
                </div>
                <table class="table table--responsive--xl">
                    <thead>
                        <tr>
                            <th>@lang('Rent No')</th>
                            <th>@lang('Brand')</th>
                            <th>@lang('Pick Up | Zone')</th>
                            <th>@lang('Price')</th>
                            <th>@lang('Expired At')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rentals as $rental)
                            <tr>
                                <td>{{ __(@$rental->rent_no) }}</td>
                                <td>{{ @$rental->vehicle->brand->name }}</td>
                                <td>{{ @$rental->pickupPoint->name }} <br> {{ @$rental->pickupZone->name }}</td>
                                <td>{{ showAmount(@$rental->price) }} {{ __($general->cur_text) }}</td>
                                <td>{{ @$rental->end_date }}</td>
                                <td>
                                    @php
                                        echo @$rental->statusBadge;
                                    @endphp
                                </td>
                                <td>
                                    <div class="button--group">
                                        <a href="{{ route('user.rented.detail', $rental->id) }}" class="btn btn--base btn--sm"><i class="las la-lg la-desktop"></i> @lang('Detail')</a>
                                        @if ($rental->status == Status::RENT_COMPLETED)
                                            @if ($rental->review)
                                                <button type="button" class="btn btn--warning btn--sm disabled"><i class="lar la-lg la-star"></i> @lang('Reviewed')</button>
                                            @else
                                                <a href="{{ route('user.review.form', $rental->id) }}" class="btn btn--warning btn--sm"><i class="lar la-lg la-star"></i> @lang('Review')</a>
                                            @endif
                                        @endif
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
                {{ paginateLinks($rentals) }}
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
