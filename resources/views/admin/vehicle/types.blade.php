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
                                    <th>@lang('Image | Name')</th>
                                    <th>@lang('Description')</th>
                                    <th>@lang('Manage Class')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($vehicleTypes as $vehicleType)
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb">
                                                    <img class="plugin_bg" src="{{ getImage(getFilePath('vehicleType') . '/' . @$vehicleType->image, getFileSize('vehicleType')) }}" alt="@lang('image')">
                                                </div>
                                                <span class="name">{{ __($vehicleType->name) }}</span>
                                            </div>
                                        </td>
                                        <td>{{ __(strLimit($vehicleType->description, 70)) }}</td>
                                        <td>
                                            @if ($vehicleType->manage_class == Status::YES)
                                                <span class="badge badge--primary">@lang('Yes')</span>
                                            @else
                                                <span class="badge badge--danger">@lang('No')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                echo $vehicleType->statusBadge;
                                            @endphp
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <button class="btn btn-sm btn-outline--primary editButton" data-vehicle_type="{{ $vehicleType }}" data-image="{{ getImage(getFilepath('vehicleType') . '/' . $vehicleType->image) }}">
                                                    <i class="la la-pencil"></i> @lang('Edit')
                                                </button>

                                                @if ($vehicleType->status == Status::ENABLE)
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.type.status', $vehicleType->id) }}" data-question="@lang('Are you sure to disable this vehicle?')">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.type.status', $vehicleType->id) }}" data-question="@lang('Are you sure to enable this vehicle?')">
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
                @if ($vehicleTypes->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($vehicleTypes) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="vehicleTypeModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>@lang('Image')<span class="text--danger">*</span></label>
                                    <x-image-uploader image="" class="w-100" type="vehicleType" :required=false />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input class="form-control" name="name" type="text" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Description')</label>
                                    <textarea name="description" class="form-control" rows="5" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Manage Class')</label>
                                    <input type="checkbox" data-width="100%" data-height="40px" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('YES')" data-off="@lang('NO')" name="manage_class">
                                </div>
                            </div>
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

            let modal = $('#vehicleTypeModal');
            $('.createButton').on('click', function() {
                modal.find('.modal-title').text(`@lang('Add New Vehicle Type')`);
                modal.find('form').attr('action', `{{ route('admin.type.store', '') }}`);
                modal.find('input[name=manage_class]').bootstrapToggle('on');
                modal.modal('show');
            });
            $('.editButton').on('click', function() {
                var vehicleType = $(this).data('vehicle_type');
                modal.find('.modal-title').text(`@lang('Update Vehicle Type')`);
                modal.find('form').attr('action', `{{ route('admin.type.store', '') }}/${vehicleType.id}`);
                modal.find('[name=name]').val(vehicleType.name);
                modal.find('[name=description]').val(vehicleType.description);
                modal.find('.image-upload-preview').attr('style', `background-image: url(${$(this).data('image')})`);
                modal.find('input[name=manage_class]').bootstrapToggle(vehicleType.manage_class == 1 ? 'on' : 'off');
                modal.modal('show')
            });
            var defautlImage = `{{ getImage(getFilePath('vehicleType'), getFileSize('vehicleType')) }}`;
            modal.on('hidden.bs.modal', function() {
                modal.find('.image-upload-preview').attr('style', `background-image: url(${defautlImage})`);
                $('#vehicleTypeModal form')[0].reset();
            });

        })(jQuery);
    </script>
@endpush
