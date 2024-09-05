@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="card custom--card">
        <div class="card-body">
            <form class="register" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="dashboard-edit-profile__thumb mb-4">
                    <div class="file-upload">
                        <label class="edit-pen" for="update-photo"><i class="lar la-edit"></i></label>
                        <input type="file" name="image" class="form-control form--control" id="update-photo" hidden="" accept=".jpg,.jpeg,.png">
                    </div>
                    <img id="upload-img" src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile'), true) }}" alt="@lang('image')">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('First Name')</label>
                            <input type="text" class="form--control" name="firstname" value="{{ $user->firstname }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Last Name')</label>
                            <input type="text" class="form--control" name="lastname" value="{{ $user->lastname }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('E-mail Address')</label>
                            <input class="form--control" value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Mobile Number')</label>
                            <input class="form--control" value="{{ $user->mobile }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Address')</label>
                            <input type="text" class="form--control" name="address" value="{{ @$user->address->address }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('State')</label>
                            <input type="text" class="form--control" name="state" value="{{ @$user->address->state }}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form--label">@lang('Zip Code')</label>
                            <input type="text" class="form--control" name="zip" value="{{ @$user->address->zip }}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form--label">@lang('City')</label>
                            <input type="text" class="form--control" name="city" value="{{ @$user->address->city }}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form--label">@lang('Country')</label>
                            <input class="form--control" value="{{ @$user->address->country }}" disabled>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
            </form>
        </div>
    </div>
@endsection
@push('style')
    <style>
        .dashboard-edit-profile__thumb {
            width: 155px;
            height: 155px;
            border-radius: 50%;
            text-align: center;
            margin: 0 auto;
            position: relative;
        }

        .dashboard-edit-profile__thumb img {
            width: 100%;
            object-fit: cover;
        }

        .dashboard-edit-profile__thumb .edit-pen {
            position: absolute;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: hsl(var(--base));
            right: 0px;
            bottom: 14px;
            color: #fff;
        }

        #upload-img {
            border-radius: 50%;
            height: 150px;
            width: 150px;
            border: 1px solid hsl(var(--base-two) / 0.1);
        }
    </style>
@endpush
