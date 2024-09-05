@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-md-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two custom-data-table table">
                            <thead>
                                <tr>
                                    <th>@lang('Title')</th>
                                    <th>@lang('Client ID')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$general->socialite_credentials ?? [] as $key => $credential)
                                    <tr>
                                        <td class="fw-bold">{{ ucfirst($key) }}</td>
                                        <td>{{ $credential->client_id }}</td>
                                        <td>
                                            @if (@$credential->status == 1)
                                                <span class="badge badge--success">@lang('Enabled')</span>
                                            @else
                                                <span class="badge badge--warning">@lang('Disabled')</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end flex-wrap gap-1">
                                                <button class="btn btn-outline--primary btn-sm editBtn" data-client_id="{{ $credential->client_id }}" data-client_secret="{{ $credential->client_secret }}" data-key="{{ $key }}"><i class="la la-cogs"></i>@lang('Configure')</button>
                                                <button class="btn btn-sm btn-outline--dark helpBtn" data-type="{{ $key }}" type="button">
                                                    <i class="la la-question"></i>@lang('Help')</button>
                                                @if (@$credential->status == 1)
                                                    <button class="btn btn-outline--danger btn-sm confirmationBtn" data-question="@lang('Are you sure that you want to enable this login credential?')" data-action="{{ route('admin.socialite.credentials.status', $key) }}"><i class="las la-eye-slash"></i>@lang('Disable')</button>
                                                @else
                                                    <button class="btn btn-outline--success btn-sm confirmationBtn" data-question="@lang('Are you sure that you want to disable login credential?')" data-action="{{ route('admin.socialite.credentials.status', $key) }}"><i class="las la-eye"></i>@lang('Enable')</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Update Credential'): <span class="credential-name"></span></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form method="POST" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Client ID')</label>
                            <input class="form-control" name="client_id" type="text">
                        </div>
                        <div class="form-group">
                            <label>@lang('Client Secret')</label>
                            <input class="form-control" name="client_secret" type="text">
                        </div>
                        <div class="form-group">
                            <label>@lang('Callback URL')</label>
                            <div class="input-group">
                                <input class="form-control callback" type="text" readonly>
                                <button class="input-group-text copyInput" type="button" title="@lang('Copy')">
                                    <i class="las la-clipboard"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary w-100 h-45" id="editBtn" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="helpModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Update Credential'): <span class="credential-name"></span></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="description"></div>
                </div>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $(document).on('click', '.editBtn', function() {
                let modal = $('#editModal');
                let data = $(this).data();
                let route = "{{ route('admin.socialite.credentials.update', '') }}";
                let callbackUrl = "{{ route('user.social.login.callback', '') }}";
                modal.find('form').attr('action', `${route}/${data.key}`);
                modal.find('.credential-name').text(data.key);
                modal.find('[name=client_id]').val(data.client_id);
                modal.find('[name=client_secret]').val(data.client_secret);
                modal.find('.callback').val(`${callbackUrl}/${data.key}`);
                modal.modal('show');
            });

            $('.copyInput').on('click', function(e) {
                var copybtn = $(this);
                var input = copybtn.closest('.input-group').find('input');
                if (input && input.select) {
                    input.select();
                    try {
                        document.execCommand('SelectAll')
                        document.execCommand('Copy', false, null);
                        input.blur();
                        notify('success', `Copied: ${copybtn.closest('.input-group').find('input').val()}`);
                    } catch (err) {
                        alert('Please press Ctrl/Cmd + C to copy');
                    }
                }
            });

            $('.helpBtn').on('click', function() {
                var modal = $('#helpModal');
                var type = $(this).data('type');
                if (type == 'google') {
                    var html = `
                            <li class="mb-2"><span class="fw-bold">Step 1:</span> Go to <a href="https://console.developers.google.com" target="_blank">google developer console</a></li>
                            <li class="mb-2"><span class="fw-bold">Step 2:</span> Click on Select a project than click on <a href="https://console.cloud.google.com/projectcreate" target="_blank">New Project</a> and create a project providing the project name</li>
                            <li class="mb-2"><span class="fw-bold">Step 3:</span> Click on <a href="https://console.cloud.google.com/apis/credentials" target="_blank">credentials</a></li>
                            <li class="mb-2"><span class="fw-bold">Step 4:</span> Click on create credentials and select <a href="https://console.cloud.google.com/apis/credentials/oauthclient" target="_blank">OAuth client ID</a></li>
                            <li class="mb-2"><span class="fw-bold">Step 5:</span> Click on <a href="https://console.cloud.google.com/apis/credentials/consent" target="_blank">Configure Consent Screen</a></li>
                            <li class="mb-2"><span class="fw-bold">Step 6:</span> Choose External option and press the create button</li>
                            <li class="mb-2"><span class="fw-bold">Step 7:</span> Please fill up the required informations for app configuration</li>
                            <li class="mb-2"><span class="fw-bold">Step 8:</span> Again click on <a href="https://console.cloud.google.com/apis/credentials" target="_blank">credentials</a> and select type as web application and fill up the required informations. Also don't forget to add redirect url and press create button</li>
                            <li class="mb-2"><span class="fw-bold">Step 9:</span> Finally you've got the credentials. Please copy the Client ID and Client Secret and paste it in admin panel google configuration.</li>
                        `;
                } else if (type == 'facebook') {
                    var html = `
                            <li class="mb-2"><span class="fw-bold">Step 1:</span> Go to <a href="https://developers.facebook.com/" target="_blank">facebook developer</a></li>
                            <li class="mb-2"><span class="fw-bold">Step 2:</span> Click on Get Started and create Meta Developer account</li>
                            <li class="mb-2"><span class="fw-bold">Step 3:</span> Create an app by selecting Consumer option</li>
                            <li class="mb-2"><span class="fw-bold">Step 4:</span> Click on Setup Facebook Login and select Web option</li>
                            <li class="mb-2"><span class="fw-bold">Step 5:</span> Add site url</li>
                            <li class="mb-2"><span class="fw-bold">Step 6:</span> Go to Facebook Login > Settings and add callback URL here.</li>
                            <li class="mb-2"><span class="fw-bold">Step 7:</span> Go to Settingd > Basic and copy the credentials and paste to admin panel.</li>
                    `;
                } else {
                    var html = `
                            <li class="mb-2"><span class="fw-bold">Step 1:</span> Go to <a href="https://developer.linkedin.com/" target="_blank">linkedin developer</a></li>
                            <li class="mb-2"><span class="fw-bold">Step 2:</span> Click on create app and provide required information</li>
                            <li class="mb-2"><span class="fw-bold">Step 3:</span> Click on Sign In with Linkedin > Request access</li>
                            <li class="mb-2"><span class="fw-bold">Step 4:</span> Click Auth option and copy the credentials and paste it to admin panel and don't forget to add redirect url here.</li>
                    `;
                }
                $('.description').html(html);
                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush
