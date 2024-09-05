@extends('admin.layouts.app')
@section('panel')
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.store.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xxl-4 col-lg-6">
                                <div class="form-group">
                                    <label>@lang('Image')</label>
                                    <x-image-uploader image="{{ $user->store_data->store_image }}" class="w-100" type="vehicleStore" :required=false name="store_image" />
                                </div>
                            </div>
                            <div class="col-xxl-8 col-lg-6">
                                <div class="form-group select2--parent position-relative">
                                    <label>@lang('Zone')</label>
                                    <select name="zone_id" class="form-control select2-basic" required>
                                        <option value="" selected disabled>@lang('Select One')</option>
                                        @foreach ($zones as $zone)
                                            <option value="{{ $zone->id }}" @selected($zone->id == @$user->zone_id)>{{ __($zone->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label>@lang('Name')</label>
                                    <input class="form-control" type="text" name="name" value="{{ @$user->store_data->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Location')</label>
                                    <input class="form-control" type="text" name="location" value="{{ @$user->location->name }}" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.store.index') }}" />
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            $(".select2-basic").select2({
                width: "100%",
                dropdownParent: $('.select2--parent'),
            })
        })(jQuery)
    </script>
@endpush
