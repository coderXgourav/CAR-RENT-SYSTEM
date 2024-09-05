@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="card custom--card">
        <div class="card-body">
            <form action="{{ route('user.vehicle.update', @$vehicle->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row gy-1 mb-3">
                    <div class="col-xl-4 col-lg-5 col-md-4">
                        <label class="form--label">@lang('Image')<span class="text--danger">*</span></label>
                        <div class="profile-thumb p-0 text-center shadow-none">
                            <div class="thumb">
                                <img id="upload-img" src="{{ getImage(getFilePath('vehicle') . '/' . @$vehicle->image, getFileSize('vehicle')) }}" alt="@lang('image')">
                                <label class="badge badge--icon badge--fill-base update-thumb-icon" for="update-photo"><i class="las la-pen"></i></label>
                            </div>
                            <div class="profile__info">
                                <input class="form-control d-none" id="update-photo" name="image" type="file" accept=".png, .jpg, .jpeg">
                            </div>
                        </div>
                        <small class="text--danger">@lang('Supported files:') @lang('.jpeg'), @lang('.jpg'), @lang('.png') @lang('Image will be resized into') {{ getFileSize('vehicle') }} @lang('px')</small>
                    </div>

                    <div class="col-xl-8 col-lg-7 col-md-8">
                        <div class="form-group">
                            <label class="form--label">@lang('Drop Point')</label>
                            <select name="drop_point[]" class="form--control select2-basic" multiple required>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->id }}" @selected(in_array($zone->id, old('drop_point', @$vehicle->locationId) ?? []))>{{ __($zone->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form--label">@lang('Vehicle Type')</label>
                            <select name="vehicle_type_id" class="form--control vehicle-type" required>
                                <option value="" selected disabled>@lang('Select One')</option>
                                @foreach ($vehicleTypes as $vehicleType)
                                    <option value="{{ $vehicleType->id }}" @selected(old('vehicle_type_id', @$vehicle->vehicle_type_id) == @$vehicleType->id) data-vehicle_classes="{{ $vehicleType->vehicleClass }}" data-manage_class="{{ $vehicleType->manage_class }}">{{ __($vehicleType->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form--label">@lang('Vehicle Class')</label>
                            <select name="vehicle_class_id" class="form--control select2-basic"></select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form--label">@lang('Name')</label>
                        <input type="text" class="form--control" name="name" required value="{{ old('name', @$vehicle->name) }}">
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Brand')</label>
                            <select name="brand_id" class="form--control select2-basic" required>
                                <option value="" selected disabled>@lang('Select One')</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" @selected(old('brand_id', @$vehicle->brand_id) == @$brand->id)>{{ __($brand->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Model')</label>
                            <input type="text" class="form--control" name="model" required value="{{ old('model', @$vehicle->model) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('CC (Cubic Centimeters)')</label>
                            <div class="input-group">
                                <input type="text" class="form-control form--control" name="cc" required value="{{ old('cc', @$vehicle->cc) }}">
                                <span class="input-group-text bg--base text-white border-0">@lang('CC')</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('BHP (Brake Horsepower)')</label>
                            <div class="input-group">
                                <input type="number" step="any" class="form-control form--control" name="bhp" required value="{{ old('bhp', @$vehicle->bhp) }}">
                                <span class="input-group-text bg--base text-white border-0">@lang('BHP')</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Speed')</label>
                            <div class="input-group">
                                <input type="number" class="form-control form--control" name="speed" required value="{{ old('speed', @$vehicle->speed) }}">
                                <span class="input-group-text bg--base text-white border-0">@lang('Km/h')</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Cylinder')</label>
                            <input type="number" class="form--control" name="cylinder" required value="{{ old('cylinder', @$vehicle->cylinder) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Year')</label>
                            <input type="text" class="form--control" name="year" required value="{{ old('year', @$vehicle->year) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Color')</label>
                            <input type="text" class="form--control" name="color" required value="{{ old('color', @$vehicle->color) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Identification Number')</label>
                            <input type="text" class="form--control" name="identification_number" required value="{{ old('identification_number', @$vehicle->identification_number) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Mileage')</label>
                            <div class="input-group">
                                <input type="text" class="form-control form--control" name="mileage" required value="{{ old('mileage', @$vehicle->mileage) }}">
                                <span class="input-group-text bg--base text-white border-0">@lang('Km/l')</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Condition')</label>
                            <select name="vehicle_condition" class="form--control" required>
                                <option value="" selected disabled>@lang('Select One')</option>
                                <option value="new" @selected(old('vehicle_condition', @$vehicle->vehicle_condition) == 'new')>@lang('New')</option>
                                <option value="used" @selected(old('vehicle_condition', @$vehicle->vehicle_condition) == 'used')>@lang('Used')</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Transmission Type')</label>
                            <select name="transmission_type" class="form--control" required>
                                <option value="" selected disabled>@lang('Select One')</option>
                                <option value="automatic" @selected(old('transmission_type', @$vehicle->transmission_type) == 'automatic')>@lang('Automatic')</option>
                                <option value="manual" @selected(old('transmission_type', @$vehicle->transmission_type) == 'manual')>@lang('Manual')</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Fuel Type')</label>
                            <select name="fuel_type" class="form--control" required>
                                <option value="" selected disabled>@lang('Select One')</option>
                                <option value="gasholine" @selected(old('fuel_type', @$vehicle->fuel_type) == 'petrol')>@lang('Petrol')</option>
                                <option value="gasholine" @selected(old('fuel_type', @$vehicle->fuel_type) == 'gasholine')>@lang('Gasholine')</option>
                                <option value="diesel" @selected(old('fuel_type', @$vehicle->fuel_type) == 'diesel')>@lang('Diesel')</option>
                                <option value="electric" @selected(old('fuel_type', @$vehicle->fuel_type) == 'electric')>@lang('Electric')</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Number of Seats')</label>
                            <input type="text" class="form--control" name="seat" required value="{{ old('seat', @$vehicle->seat) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Total Run')</label>
                            <div class="input-group">
                                <input type="number" step="any" class="form-control form--control" name="total_run" required value="{{ old('total_run', @$vehicle->total_run ? getAmount(@$vehicle->total_run) : '') }}">
                                <span class="input-group-text bg--base text-white border-0">@lang('KM')</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Rental Price Per Day')</label>
                            <div class="input-group">
                                <input type="number" step="any" class="form-control form--control" name="price" required value="{{ old('price', @$vehicle->price ? getAmount(@$vehicle->price) : '') }}">
                                <span class="input-group-text bg--base text-white border-0">{{ __($general->cur_text) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form--label">@lang('Description')</label>
                        <textarea name="description" class="form-control nicEdit">@php echo @$vehicle->description @endphp</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form--label">@lang('Images')</label>
                        <p class="mb-2 text--danger"><i class="las la-exclamation-circle"></i> @lang('Maximum ') {{ $general->max_image_upload }} @lang('images can be uploaded') | @lang('File size will be ') {{ getFileSize('vehicle') }} @lang('px')</p>
                        <div class="input-images"></div>
                    </div>
                </div>
                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
            </form>
        </div>
    </div>
@endsection

@push('style-lib')
    <link href="{{ asset($activeTemplateTrue . 'css/image-uploader.min.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/image-uploader.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/nicEdit.js') }}"></script>
@endpush

@push('style')
    <style>
        .form-control:focus {
            box-shadow: none;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            bkLib.onDomLoaded(function() {
                $(".nicEdit").each(function(index) {
                    $(this).attr("id", "nicEditor" + index);
                    new nicEditor({
                        fullPanel: true
                    }).panelInstance('nicEditor' + index, {
                        hasPanel: true
                    });
                });
            });

            $(".vehicle-type").select2({
                width: "100%",
                templateSelection: (state) => {
                    $('[name=vehicle_class_id]').html('');
                    if (state.element.dataset.vehicle_classes && state.element.dataset.manage_class == 1) {
                        let vehicleClasses = JSON.parse(state.element.dataset.vehicle_classes);
                        let html = `<option value="" selected disabled>@lang('Select One')</option>`
                        $.each(vehicleClasses, function(index, item) {
                            html += `<option value="${item.id}" ${item.vehicle_type_id == state.id ? 'selected' : ''}>${item.name}</option>`
                        });
                        $('[name=vehicle_class_id]').html(html);
                    }
                    return state.text
                }
            })

            $(".select2-basic").select2({
                width: "100%",
            })

            let preloaded = [];

            @if (!empty($images))
                preloaded = @json($images);
            @endif

            $('.input-images').imageUploader({
                extensions: ['.jpg', '.jpeg', '.png'],
                preloaded: preloaded,
                imagesInputName: 'images',
                preloadedInputName: 'old',
                maxFiles: "{{ $general->max_image_upload }}"
            });
        })(jQuery)
    </script>
@endpush
