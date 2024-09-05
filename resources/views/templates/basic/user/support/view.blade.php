@extends($activeTemplate . 'layouts.' . $layout)

@section('content')

    @if ($layout == 'frontend')
        <div class="pt-60 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                    </div>
    @endif

    <div class="card custom--card">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                @php echo $myTicket->statusBadge; @endphp
                <h6 class="mb-0">[@lang('Ticket')#{{ $myTicket->ticket }}] {{ $myTicket->subject }}</h6>
            </div>
            @if ($myTicket->status != Status::TICKET_CLOSE && $myTicket->user)
                <button class="btn btn--danger btn--sm confirmationBtn" type="button" data-question="@lang('Are you sure to close this ticket?')" data-action="{{ route('ticket.close', $myTicket->id) }}"><i class="las la-lg la-times-circle"></i>
                </button>
            @endif
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('ticket.reply', $myTicket->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-between">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="message" class="form--control" rows="4" placeholder="@lang('Reply here...')">{{ old('message') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="text-end mb-2">
                    <a href="javascript:void(0)" class="btn btn--base btn--sm addFile"><i class="la la-lg la-plus"></i> @lang('Add New')</a>
                </div>
                <div class="form-group">
                    <label class="form-label">@lang('Attachments')</label> <small class="text--danger">@lang('Max 5 files can be uploaded'). @lang('Maximum upload size is') {{ ini_get('upload_max_filesize') }}</small>
                    <input type="file" name="attachments[]" class="form--control" />
                    <div id="fileUploadsContainer"></div>
                    <p class="my-2 ticket-attachments-message">
                        @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')
                    </p>
                </div>
                <button type="submit" class="btn btn--base w-100"> <i class="fa fa-reply"></i> @lang('Reply')</button>
            </form>
        </div>
    </div>

    @if (!blank($messages))
        <h5 class="my-3">@lang('Previous Replies')</h5>
        <div class="list support-list">
            @foreach ($messages as $message)
                @if ($message->admin_id == 0)
                    <div class="support-card">
                        <div class="support-card__head">
                            <h6 class="support-card__title">{{ __($message->ticket->name) }}</h6>
                            <span class="support-card__date">
                                <code><i class="far fa-clock"></i>{{ $message->created_at->format('dS F Y @ H:i') }}</code>
                            </span>
                        </div>
                        <div class="support-card__body">
                            <p class="support-card__body-text">{{ $message->message }}</p>
                            @if ($message->attachments->count() > 0)
                                <ul class="list list--row support-card__list">
                                    @foreach ($message->attachments as $k => $image)
                                        <li>
                                            <a class="support-card__file" href="{{ route('ticket.download', encrypt($image->id)) }}">
                                                <span class="support-card__file-icon">
                                                    <i class="far fa-file-alt"></i>
                                                </span>
                                                <span class="support-card__file-text">
                                                    @lang('Attachment') {{ ++$k }}
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="support-card">
                        <div class="support-card__head">
                            <h6 class="support-card__title">{{ __($message->admin->name) }}</h6>
                            <span class="support-card__date">
                                <code><i class="far fa-clock"></i> {{ $message->created_at->format('dS F Y @ H:i') }}</code>
                            </span>
                        </div>
                        <div class="support-card__body">
                            <p class="support-card__body-text text-md-start mb-0 text-center">
                                {{ $message->message }}
                            </p>
                            @if ($message->attachments->count() > 0)
                                <ul class="list list--row support-card__list justify-content-center justify-content-md-start flex-wrap">
                                    @foreach ($message->attachments as $k => $image)
                                        <li>
                                            <a class="support-card__file" href="{{ route('ticket.download', encrypt($image->id)) }}">
                                                <span class="support-card__file-icon">
                                                    <i class="far fa-file-alt"></i>
                                                </span>
                                                <span class="support-card__file-text">
                                                    @lang('Attachment') {{ ++$k }}
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
    @if ($layout == 'frontend')
        </div>
        </div>
        </div>
    @endif

    <x-confirmation-modal closeBtn="btn btn--danger btn--sm" submitBtn="btn btn--base btn--sm" />
@endsection
@push('style')
    <style>
        .input-group-text:focus {
            box-shadow: none !important;
        }
    </style>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            var fileAdded = 0;
            $('.addFile').on('click', function() {
                if (fileAdded >= 4) {
                    notify('error', 'You\'ve added maximum number of file');
                    return false;
                }
                fileAdded++;
                $("#fileUploadsContainer").append(`
                    <div class="input-group my-3">
                        <input type="file" name="attachments[]" class="form-control form--control" required />
                        <button type="submit" class="input-group-text bg--danger text-white border-0 remove-btn"><i class="las la-times"></i></button>
                    </div>
                `)
            });
            $(document).on('click', '.remove-btn', function() {
                fileAdded--;
                $(this).closest('.input-group').remove();
            });
        })(jQuery);
    </script>
@endpush
