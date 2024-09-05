@extends($activeTemplate . 'layouts.master')
@section('content')
    @php
        $kycContent = getContent('kyc.content', true);
    @endphp

    <div class="card custom--card">
        <div class="card-body">
            @if ($user->kv == Status::KYC_PENDING)
                <div class="d-flex justify-content-center align-items-center mb-4 store-alert-message gap-2">
                    <i class="las la-exclamation-circle text-warning"></i>
                    <p class="text--warning">{{ __(@$kycContent->data_values->kyc_pending) }}</p>
                </div>
            @endif
            @if ($user->kyc_data)
                <ul class="list-group list-group-flush">
                    @foreach ($user->kyc_data as $val)
                        @continue(!$val->value)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            {{ __($val->name) }}
                            <span>
                                @if ($val->type == 'checkbox')
                                    {{ implode(',', $val->value) }}
                                @elseif($val->type == 'file')
                                    <a href="{{ route('user.attachment.download', encrypt(getFilePath('verify') . '/' . $val->value)) }}" class="text--base"><i class="fa fa-file"></i> @lang('Attachment') </a>
                                @else
                                    <p>{{ __($val->value) }}</p>
                                @endif
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <h5 class="text-center">@lang('KYC data not found')</h5>
            @endif
        </div>
    </div>

@endsection
