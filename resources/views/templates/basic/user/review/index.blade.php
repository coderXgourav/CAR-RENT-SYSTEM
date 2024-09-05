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
                            <th>@lang('Rental Number')</th>
                            <th>@lang('Vehicle')</th>
                            <th>@lang('Rating')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr>
                                <td>{{ @$review->rental->rent_no }}</td>
                                <td>
                                    <a class="text--base fw-bold" target="_blank"
                                       href="{{ route('vehicle.detail', @$review->vehicle->id) }}">
                                        <span>@</span>{{ __(@$review->vehicle->name) }}
                                    </a>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center">
                                        <ul class="rating-list">
                                            @php
                                                echo showRatings($review->star);
                                            @endphp
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end flex-wrap gap-1">
                                        <a class="btn btn--sm btn--base outline"
                                           href="{{ route('user.review.form', [$review->rental_id, $review->id]) }}">
                                            <i class="las la-edit"></i> @lang('Edit')
                                        </a>
                                        <button class="btn btn--sm btn--danger outline confirmationBtn"
                                                data-action="{{ route('user.review.remove', $review->id) }}"
                                                data-question="@lang('Are you sure to remove this review?')" data-btn_class="btn btn--base btn--md">
                                            <i class="las la-trash"></i> @lang('Delete')
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="justify-content-center text-center" colspan="100%">
                                    @lang('No review yet')
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ paginateLinks($reviews) }}
            </div>
        </div>
    </div>

    <x-confirmation-modal closeBtn="btn btn--danger btn--sm" submitBtn="btn btn--base btn--sm" />
@endsection
