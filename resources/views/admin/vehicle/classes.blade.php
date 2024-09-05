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
                                    <th>@lang('Name')</th>
                                    <th>@lang('Vehicle')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($vehicleClasses as $vehicleClass)
                                    <tr>
                                        <td>{{ __($vehicleClass->name) }}</td>
                                        <td>{{ __(@$vehicleClass->vehicleType->name) }}</td>
                                        <td>
                                            @php
                                                echo $vehicleClass->statusBadge;
                                            @endphp
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <button class="btn btn-sm btn-outline--primary editButton" data-vehicle_class="{{ $vehicleClass }}">
                                                    <i class="la la-pencil"></i> @lang('Edit')
                                                </button>
                                                @if ($vehicleClass->status == Status::ENABLE)
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.class.status', $vehicleClass->id) }}" data-question="@lang('Are you sure to disable this vehicle class?')">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.class.status', $vehicleClass->id) }}" data-question="@lang('Are you sure to enable this vehicle class?')">
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
                @if ($vehicleClasses->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($vehicleClasses) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="vehicleClassModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Vehicle Type')</label>
                            <select name="vehicle_type_id" class="form-control" required>
                                <option value="" selected disabled>@lang('Select One')</option>
                                @foreach ($vehicleTypes as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ __($vehicle->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input class="form-control" name="name" type="text" value="{{ old('name') }}" required>
                        </div>
                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
    <button class="btn btn--lg btn-outline--primary createButton" type="button"><i class="las la-plus"></i>@lang('Add New')</button>
@endpush

@push('style')
    <style>
        table .user {
            justify-content: center;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict"

            let modal = $('#vehicleClassModal');
            $('.createButton').on('click', function() {
                modal.find('.modal-title').text(`@lang('Add New Vehicle Class')`);
                modal.find('form').attr('action', `{{ route('admin.class.store', '') }}`);
                modal.modal('show');
            });
            $('.editButton').on('click', function() {
                var vehicleClass = $(this).data('vehicle_class');
                modal.find('.modal-title').text(`@lang('Update Vehicle Class')`);
                modal.find('form').attr('action', `{{ route('admin.class.store', '') }}/${vehicleClass.id}`);
                modal.find('select[name=vehicle_type_id]').val(vehicleClass.vehicle_type_id);
                modal.find('[name=name]').val(vehicleClass.name);
                modal.modal('show')
            });
            modal.on('hidden.bs.modal', function() {
                $('#vehicleClassModal form')[0].reset();
            });

        })(jQuery);
    </script>
@endpush
