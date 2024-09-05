@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="card custom--card">
        <div class="card-header">
            <h5 class="mb-0">{{ __($pageTitle) }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('user.review.add', [@$rental->id, @$rental->review->id]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Vehicle')</label>
                            <input class="form--control" type="text" value="{{ __(@$rental->vehicle->name) }} - {{ __(@$rental->vehicle->model) }}" readonly required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Rental Number')</label>
                            <input class="form--control" type="text" value="{{ __(@$rental->rent_no) }}" readonly required>
                        </div>
                    </div>
                </div>
                <div class="form-group rating">
                    <label class="form--label">@lang('Rating'): <span class="text--danger">*</span></label>
                    <div class="rating-form-group">
                        <label class="star-label">
                            <input name="star" type="radio" value="1" @checked(@$rental->review->star == 1) />
                            <span class="icon"><i class="las la-star"></i></span>
                        </label>
                        <label class="star-label">
                            <input name="star" type="radio" value="2" @checked(@$rental->review->star == 2) />
                            <span class="icon"><i class="las la-star"></i></span>
                            <span class="icon"><i class="las la-star"></i></span>
                        </label>
                        <label class="star-label">
                            <input name="star" type="radio" value="3" @checked(@$rental->review->star == 3) />
                            <span class="icon"><i class="las la-star"></i></span>
                            <span class="icon"><i class="las la-star"></i></span>
                            <span class="icon"><i class="las la-star"></i></span>
                        </label>
                        <label class="star-label">
                            <input name="star" type="radio" value="4" @checked(@$rental->review->star == 4) />
                            <span class="icon"><i class="las la-star"></i></span>
                            <span class="icon"><i class="las la-star"></i></span>
                            <span class="icon"><i class="las la-star"></i></span>
                            <span class="icon"><i class="las la-star"></i></span>
                        </label>
                        <label class="star-label">
                            <input name="star" type="radio" value="5" @checked(@$rental->review->star == 5) />
                            <span class="icon"><i class="las la-star"></i></span>
                            <span class="icon"><i class="las la-star"></i></span>
                            <span class="icon"><i class="las la-star"></i></span>
                            <span class="icon"><i class="las la-star"></i></span>
                            <span class="icon"><i class="las la-star"></i></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form--label">@lang('Review')</label>
                    <textarea class="form--control" name="review" placeholder="@lang('Write here')..." required>{{ old('review', @$rental->review->review) }}</textarea>
                </div>
                <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
            </form>
        </div>
    </div>
@endsection
