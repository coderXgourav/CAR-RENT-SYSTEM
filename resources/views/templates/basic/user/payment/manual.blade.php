@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card custom--card">
                <div class="card-body  ">
                    <form action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center mt-2">@lang('You have requested') <b class="text--success">{{ showAmount($data['amount']) }} {{ __($general->cur_text) }}</b> , @lang('Please pay')
                                    <b class="text--success">{{ showAmount($data['final_amount']) . ' ' . $data['method_currency'] }} </b> @lang('for successful payment')
                                </p>
                                <p class="my-4">@php echo  $data->gateway->description @endphp</p>
                            </div>

                            <x-viser-form identifier="id" identifierValue="{{ $gateway->form_id }}" />
                        </div>
                        <button type="submit" class="btn btn--base w-100">@lang('Pay Now')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        .form-control:focus {
            box-shadow: none;
        }
    </style>
@endpush
