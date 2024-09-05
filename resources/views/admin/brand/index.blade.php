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
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($brands as $brand)
                                    <tr>
                                        <td>{{ $brands->firstItem() + $loop->index }}</td>
                                        <td>{{ __($brand->name) }}</td>
                                        <td>
                                            @php
                                                echo $brand->statusBadge;
                                            @endphp
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <button class="btn btn-sm btn-outline--primary editButton" data-brand="{{ $brand }}">
                                                    <i class="la la-pencil"></i> @lang('Edit')
                                                </button>

                                                @if ($brand->status == Status::ENABLE)
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.brand.status', $brand->id) }}" data-question="@lang('Are you sure to disable this brand?')">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.brand.status', $brand->id) }}" data-question="@lang('Are you sure to enable this brand?')">
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
                @if ($brands->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($brands) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="brandModal" role="dialog" tabindex="-1">
        <div class="modal-dialog " role="document">
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
                        <div class="row">
                            <div class="form-group">
                                <label>@lang('Name')</label>
                                <input class="form-control" name="name" type="text" value="{{ old('name') }}" required>
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

            let modal = $('#brandModal');
            $('.createButton').on('click', function() {
                modal.find('.modal-title').text(`@lang('Add New Brand')`);
                modal.find('form').attr('action', `{{ route('admin.brand.store', '') }}`);
                modal.modal('show');
            });
            $('.editButton').on('click', function() {
                var brand = $(this).data('brand');
                modal.find('.modal-title').text(`@lang('Update Brand')`);
                modal.find('form').attr('action', `{{ route('admin.brand.store', '') }}/${brand.id}`);
                modal.find('[name=name]').val(brand.name);
                modal.modal('show')
            });
            modal.on('hidden.bs.modal', function() {
                $('#brandModal form')[0].reset();
            });

        })(jQuery);
    </script>
@endpush
