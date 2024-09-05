@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="card custom--card">
        <div class="card-body">
            <div class="text-end mb-3">
                <form action="" class="filter-search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form--control" value="{{ request()->search }}" placeholder="@lang('Search here...')">
                        <button class="input-group-text bg--base text-white border-0" type="submit"><i class="las la-search"></i></button>
                    </div>
                </form>
            </div>
            <table class="table table--responsive--xl">
                <thead>
                    <tr>
                        <th>@lang('Gateway | Transaction')</th>
                        <th>@lang('Initiated')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Conversion')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Details')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($deposits as $deposit)
                        <tr>
                            <td>
                                <div>
                                    <span class="fw-bold"> <span class="text--base">{{ __($deposit->gateway?->name) }}</span> </span>
                                    <br>
                                    <small> {{ $deposit->trx }} </small>
                                </div>
                            </td>

                            <td>
                                <span>{{ showDateTime($deposit->created_at) }}<br>{{ diffForHumans($deposit->created_at) }}</span>
                            </td>
                            <td>
                                <div>
                                    {{ __($general->cur_sym) }}{{ showAmount($deposit->amount) }} + <span class="text--danger" title="@lang('charge')">{{ showAmount($deposit->charge) }} </span>
                                    <br>
                                    <strong title="@lang('Amount with charge')">
                                        {{ showAmount($deposit->amount + $deposit->charge) }} {{ __($general->cur_text) }}
                                    </strong>
                                </div>
                            </td>
                            <td>
                                <div>
                                    1 {{ __($general->cur_text) }} = {{ showAmount($deposit->rate) }} {{ __($deposit->method_currency) }}
                                    <br>
                                    <strong>{{ showAmount($deposit->final_amount) }} {{ __($deposit->method_currency) }}</strong>
                                </div>
                            </td>
                            <td>
                                @php echo $deposit->statusBadge @endphp
                            </td>
                            @php
                                $details = $deposit->detail != null ? json_encode($deposit->detail) : null;
                            @endphp

                            <td>
                                <a href="javascript:void(0)" class="btn btn--base btn--sm @if ($deposit->method_code >= 1000) detailBtn @else disabled @endif"
                                   @if ($deposit->method_code >= 1000) data-info="{{ $details }}" @endif
                                   @if ($deposit->status == Status::PAYMENT_REJECT) data-admin_feedback="{{ $deposit->admin_feedback }}" @endif>
                                    <i class="las la-lg la-desktop"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ paginateLinks($deposits) }}
        </div>
    </div>

    {{-- APPROVE MODAL --}}
    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Details')</h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush userData mb-2">
                    </ul>
                    <div class="feedback"></div>
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

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');

                var userData = $(this).data('info');
                var html = '';
                if (userData) {
                    userData.forEach(element => {
                        if (element.type != 'file') {
                            html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>${element.name}</span>
                                <span">${element.value}</span>
                            </li>`;
                        }
                    });
                }

                modal.find('.userData').html(html);

                if ($(this).data('admin_feedback') != undefined) {
                    var adminFeedback = `
                        <div class="my-3">
                            <strong>@lang('Admin Feedback')</strong>
                            <p>${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                } else {
                    var adminFeedback = '';
                }

                modal.find('.feedback').html(adminFeedback);


                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
