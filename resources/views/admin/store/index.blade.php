@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('S.N')</th>
                                    <th>@lang('Username')</th>
                                    <th>@lang('Email-Phone')</th>
                                    <th>@lang('Store-Location')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stores as $store)
                                    <tr>
                                        <td>{{ $stores->firstItem() + $loop->index }}</td>
                                        <td>
                                            <span class="fw-bold">{{ $store->fullname }}</span>
                                            <br>
                                            <span class="small">
                                                <a href="{{ route('admin.users.detail', $store->id) }}"><span>@</span>{{ $store->username }}</a>
                                            </span>
                                        </td>
                                        <td>{{ $store->email }}<br>{{ $store->mobile }}</td>
                                        <td>
                                            <span>{{ __(@$store->store_data->name) }}</span>
                                            <br>
                                            <span>{{ __(@$store->location->name) }}</span>
                                        </td>
                                        <td>
                                            @php
                                                echo $store->storeStatusBadge;
                                            @endphp
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <a href="{{ route('admin.store.edit', $store->id) }}" class="btn btn-sm btn-outline--primary">
                                                    <i class="las la-pen"></i> @lang('Edit')
                                                </a>
                                                <a href="{{ route('admin.store.detail', $store->id) }}" class="btn btn-sm btn-outline--info">
                                                    <i class="las la-desktop"></i> @lang('Details')
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($stores->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($stores) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <x-search-form />
@endpush
