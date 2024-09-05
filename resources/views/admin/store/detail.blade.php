@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30 justify-content-center">
        <div class="col-xl-4 col-md-6 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('User Information')</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Fullname')
                            <span class="fw-bold">{{ __($user->fullname) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Email')
                            <span class="fw-bold">{{ $user->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Mobile')
                            <span class="fw-bold">{{ $user->mobile }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="fw-bold">
                                <a href="{{ route('admin.users.detail', $user->id) }}">{{ @$user->username }}</a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Store Status')
                            @php echo $user->storeStatusBadge @endphp
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @if ($user->store_data || $user->store == Status::STORE_PENDING)
            <div class="col-xl-8 col-md-6 mb-30">
                <div class="card b-radius--10 overflow-hidden box--shadow1">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                            <h5 class="card-title text-muted mb-0">@lang('Store Information')</h5>
                            @if ($user->store == Status::PAYMENT_PENDING)
                                <div class="gap-3">
                                    <button class="btn btn-outline--success confirmationBtn"
                                            data-action="{{ route('admin.store.approve', $user->id) }}"
                                            data-question="@lang('Are you sure to approve this store?')"><i class="las la-check-double"></i>
                                        @lang('Approve')
                                    </button>
                                    <button class="btn btn-outline--danger rejectBtn"><i class="las la-ban"></i> @lang('Reject')</button>
                                </div>
                            @endif
                        </div>
                        @if ($user->store_data)
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @lang('Zone')
                                    <span>{{ __(@$user->zone->name) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @lang('Location')
                                    <span>{{ __(@$user->location->name) }}</span>
                                </li>
                                @foreach ($user->store_data as $key => $val)
                                    @if ($key == 'store_form_data')
                                        @foreach ($val ?? [] as $data)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ __($data->name) }}
                                                <span>
                                                    @if ($data->type == 'checkbox')
                                                        {{ implode(',', $val->value) }}
                                                    @elseif($data->type == 'file')
                                                        <a href="{{ route('admin.download.attachment', encrypt(getFilePath('verify') . '/' . $data->value)) }}"><i class="fa fa-file"></i> @lang('Attachment') </a>
                                                    @else
                                                        <p>{{ __($data->value) }}</p>
                                                    @endif
                                                </span>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ __(ucwords(str_replace('_', ' ', $key))) }}
                                            <span>
                                                @if ($key == 'store_image')
                                                    <a href="{{ route('admin.download.attachment', encrypt(getFilePath('vehicleStore') . '/' . $val)) }}"><i class="fa fa-file"></i> @lang('Attachment') </a>
                                                @else
                                                    <p>{{ __($val) }}</p>
                                                @endif
                                            </span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <h5 class="text-center">@lang('Vehicle store data not found')</h5>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="map" style="height: 500px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Reject Store Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.store.reject', $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>@lang('Are you sure to reject this store?')</p>

                        <div class="form-group">
                            <label class="mt-2">@lang('Reason for Rejection')</label>
                            <textarea name="store_feedback" maxlength="255" class="form-control" rows="5" required>{{ old('store_feedback') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.store.index') }}" />
@endpush

@push('script-lib')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ gs('api_key') }}&libraries=drawing,places"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.rejectBtn').on('click', function() {
                var modal = $('#rejectModal');
                modal.modal('show');
            });

            function initMap() {
                const locationName = `{{ @$user->location->name }}`;
                const coordinatesString = '{{ @$user->zone->coordinates }}';
                const zoom = Number('{{ @$user->zone->zoom }}') ?? 14;



                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    'address': locationName
                }, function(results, status) {
                    if (status === 'OK') {
                        const map = new google.maps.Map(document.getElementById('map'), {
                            zoom: zoom,
                            center: results[0].geometry.location
                        });

                        const marker = new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map
                        });

                        const coordinatesArray = coordinatesString.split(',');
                        const polygonCoords = [];
                        for (let i = 0; i < coordinatesArray.length; i += 2) {
                            const lat = parseFloat(coordinatesArray[i]);
                            const lng = parseFloat(coordinatesArray[i + 1]);
                            polygonCoords.push({
                                lat,
                                lng
                            });
                        }
                        const polygon = new google.maps.Polygon({
                            paths: polygonCoords,
                            strokeColor: '#FF0000',
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: '#FF0000',
                            fillOpacity: 0.35,
                            map: map
                        });
                    } else {
                        console.error('Geocode was not successful for the following reason:', status);
                    }
                });
            }
            initMap();

        })(jQuery);
    </script>
@endpush
