@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="card custom--card">
        <div class="card-body">
            <form action="{{ route('user.vehicle.store.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row gy-3 mb-3">
                    <div class="col-xl-4 col-lg-5 col-md-4">
                        <label class="form--label">@lang('Store Image')<span class="text--danger">*</span></label>
                        <div class="profile-thumb p-0 text-center shadow-none">
                            <div class="thumb">
                                <img id="upload-img" src="{{ getImage(getFilePath('vehicleStore') . '/' . @$user->store_data->image, getFileSize('vehicleStore')) }}" alt="@lang('image')">
                                <label class="badge badge--icon badge--fill-base update-thumb-icon" for="update-photo"><i class="las la-pen"></i></label>
                            </div>
                            <div class="profile__info">
                                <input class="form-control d-none" id="update-photo" name="store_image" type="file" accept=".png, .jpg, .jpeg" required="">
                            </div>
                        </div>
                        <small class="text--warning">@lang('Supported files:') @lang('.jpeg'), @lang('.jpg'), @lang('.png')</small>
                    </div>

                    <div class="col-xl-8 col-lg-7 col-md-8">
                        <div class="form-group">
                            <label class="form--label">@lang('Zone')</label>
                            <select name="zone_id" class="form--control select2-basic" required>
                                <option value="" selected disabled>@lang('Select One')</option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->id }}">{{ __($zone->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form--label">@lang('Name')</label>
                            <input type="text" class="form--control" name="name" required value="{{ old('name', @$user->store_data->name) }}">
                        </div>

                        <div class="form-group">
                            <label class="form--label">@lang('Location')</label>
                            <input type="text" class="form--control" name="location" required value="{{ old('location', @$user->location) }}">
                        </div>
                    </div>
                </div>

                <x-viser-form identifier="act" identifierValue="store_kyc" />

                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.form-group').find('input').removeClass('form-control');

            $(".select2-basic").select2({
                width: "100%",
            })
        })(jQuery)
    </script>
@endpush
