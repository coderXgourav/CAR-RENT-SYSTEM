@php
    $user = auth()->user();
@endphp
<div class="dashboard-body__bar navigation-bar d-lg-none d-flex">
    <span class="dashboard-body__bar-icon"><i class="las la-bars"></i></span>
    <div class="dashboard-profile">
        <img src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}" alt="@lang('profile')" />
        <p class="name">{{ $user->username }}</p>
    </div>
</div>
