@extends($activeTemplate . 'layouts.master')
@section('content')
    @php
        $storeContent = getContent('vehicle_store.content', true);
    @endphp
    <div class="card custom--card">
        <div class="card-body">
            @if ($user->store == Status::STORE_APPROVED)
                <div class="d-flex justify-content-center align-items-center mb-4 store-alert-message gap-2">
                    <i class="las la-exclamation-circle text--success"></i>
                    <p class="text--success">{{ __(@$storeContent->data_values->store_approved_content) }}</p>
                </div>
            @endif
            @if ($user->store == Status::STORE_PENDING)
                <div class="d-flex justify-content-center align-items-center mb-4 store-alert-message gap-2">
                    <i class="las la-exclamation-circle text--warning"></i>
                    <p class="text--warning">{{ __(@$storeContent->data_values->store_pending_content) }}</p>
                </div>
            @endif
            @if ($user->store_data)
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="fw-bold">@lang('Zone')</span>
                        <span>{{ __(@$user->zone->name) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="fw-bold">@lang('Location')</span>
                        <span>{{ __(@$user->location->name) }}</span>
                    </li>
                    @foreach ($user->store_data as $key => $val)
                        @if ($key == 'store_form_data')
                            @foreach ($val ?? [] as $data)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="fw-bold">{{ __($data->name) }}</span>
                                    <span>
                                        @if ($data->type == 'checkbox')
                                            {{ implode(',', $val->value) }}
                                        @elseif($data->type == 'file')
                                            <a href="{{ route('user.attachment.download', encrypt(getFilePath('verify') . '/' . $data->value)) }}" class="text--base"><i class="fa fa-file"></i> @lang('Attachment') </a>
                                        @else
                                            {{ __($data->value) }}
                                        @endif
                                    </span>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="fw-bold">{{ __(ucwords(str_replace('_', ' ', $key))) }}</span>
                                <span>
                                    @if ($key == 'store_image')
                                        <a href="{{ route('user.attachment.download', encrypt(getFilePath('vehicleStore') . '/' . $val)) }}" class="text--base"><i class="fa fa-file"></i> @lang('Attachment') </a>
                                    @else
                                        {{ __($val) }}
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
@endsection
