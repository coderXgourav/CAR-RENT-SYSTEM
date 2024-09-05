@php
    $user = auth()->user();
@endphp
<div class="sidebar-menu">
    <span class="sidebar-menu__close d-lg-none d-block"><i class="fas fa-times"></i></span>

    <div class="auth-user">
        <div class="auth-user__image">
            <img src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile'), true) }}"
                 alt="@lang('profile')" />
        </div>
        <h5 class="auth-user__name">{{ __($user->fullname) }}</h5>
        <p class="auth-user__email">{{ $user->email }}</p>
    </div>

    <ul class="sidebar-menu-list">
        <li class="sidebar-menu-list__item {{ menuActive('user.home') }}">
            <a href="{{ route('user.home') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-home"></i></span>
                <span class="text">@lang('Dashboard')</span>
            </a>
        </li>
        {{-- <li class="sidebar-menu-list__item has-dropdown {{ menuActive('user.vehicle.*') }}">
            <a href="javascript:void(0)" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-taxi"></i></span>
                <span class="text">@lang('Manage Vehicle')</span>
            </a>
            <div class="sidebar-submenu">
                <ul class="sidebar-submenu-list">
                    <li class="sidebar-submenu-list__item">
                        <a href="{{ route('user.vehicle.store') }}"
                           class="sidebar-submenu-list__link {{ menuActive('user.vehicle.store*') }}">
                            <span class="text">@lang('Store')</span>
                        </a>
                    </li>
                    <li class="sidebar-submenu-list__item">
                        <a href="{{ route('user.vehicle.add') }}"
                           class="sidebar-submenu-list__link {{ menuActive('user.vehicle.add') }}">
                            <span class="text">@lang('Add Vehicle')</span>
                        </a>
                    </li>
                    <li class="sidebar-submenu-list__item">
                        <a href="{{ route('user.vehicle.index') }}"
                           class="sidebar-submenu-list__link {{ menuActive('user.vehicle.index') }}">
                            <span class="text">@lang('All Vehicles')</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li> --}}

        @php
            $vehicleId = App\Models\Vehicle::where('user_id', auth()->id())->pluck('id')->toArray();
            $pendingRentCount = App\Models\Rental::whereIn('vehicle_id', $vehicleId)->pending()->count();
        @endphp
        <li class="sidebar-menu-list__item has-dropdown {{ menuActive('user.rental.*') }}">
            <a href="javascript:void(0)" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-truck-moving"></i></span>
                <span class="text">@lang('Manage Rental')</span>
                @if ($pendingRentCount > 0)
                    <span class="menu-count">{{ $pendingRentCount }}</span>
                @endif
            </a>
            <div class="sidebar-submenu">
                <ul class="sidebar-submenu-list">
                    <li class="sidebar-submenu-list__item">
                        <a href="{{ route('user.rental.index') }}"
                           class="sidebar-submenu-list__link {{ menuActive('user.rental.index') }}">
                            <span class="text">@lang('All')</span>
                        </a>
                    </li>

                    <li class="sidebar-submenu-list__item">
                        <a href="{{ route('user.rental.pending') }}"
                           class="sidebar-submenu-list__link {{ menuActive('user.rental.pending') }}">
                            <span class="text">@lang('Pending')</span>
                            @if ($pendingRentCount > 0)
                                <span class="sidebar-submenu-list__badge">{{ $pendingRentCount }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="sidebar-submenu-list__item">
                        <a href="{{ route('user.rental.approved') }}"
                           class="sidebar-submenu-list__link {{ menuActive('user.rental.approved') }}">
                            <span class="text">@lang('Approved')</span>
                        </a>
                    </li>
                    <li class="sidebar-submenu-list__item">
                        <a href="{{ route('user.rental.ongoing') }}"
                           class="sidebar-submenu-list__link {{ menuActive('user.rental.ongoing') }}">
                            <span class="text">@lang('Ongoing')</span>
                        </a>
                    </li>
                    <li class="sidebar-submenu-list__item">
                        <a href="{{ route('user.rental.completed') }}"
                           class="sidebar-submenu-list__link {{ menuActive('user.rental.completed') }}">
                            <span class="text">@lang('Completed')</span>
                        </a>
                    </li>
                    <li class="sidebar-submenu-list__item">
                        <a href="{{ route('user.rental.cancelled') }}"
                           class="sidebar-submenu-list__link {{ menuActive('user.rental.cancelled') }}">
                            <span class="text">@lang('Cancelled')</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- <li class="sidebar-menu-list__item {{ menuActive('user.ongoing.rental.*') }}">
            <a href="{{ route('user.ongoing.rental.list') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-list"></i></span>
                <span class="text">@lang('Ongoing Rental')</span>
            </a>
        </li> --}}

        <li class="sidebar-menu-list__item {{ menuActive('user.rented.history') }}">
            <a href="{{ route('user.rented.history') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-list"></i></span>
                <span class="text">@lang('My Rented History')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.review.index') }}">
            <a href="{{ route('user.review.index') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-star"></i></span>
                <span class="text">@lang('Reviews')</span>
            </a>
        </li>

        <li class="sidebar-menu-list__item {{ menuActive('user.deposit.history') }}">
            <a href="{{ route('user.deposit.history') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-money-bill-wave"></i></span>
                <span class="text">@lang('Payment History')</span>
            </a>
        </li>
        {{-- <li class="sidebar-menu-list__item has-dropdown {{ menuActive('user.withdraw*') }}">
            <a href="javascript:void(0)" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-hand-holding-usd"></i></span>
                <span class="text">@lang('Withdraw')</span>
            </a>
            <div class="sidebar-submenu">
                <ul class="sidebar-submenu-list">
                    <li class="sidebar-submenu-list__item">
                        <a href="{{ route('user.withdraw') }}"
                           class="sidebar-submenu-list__link {{ menuActive('user.withdraw') }}">
                            <span class="text">@lang('Withdraw Money')</span>
                        </a>
                    </li>
                    <li class="sidebar-submenu-list__item">
                        <a href="{{ route('user.withdraw.history') }}"
                           class="sidebar-submenu-list__link {{ menuActive('user.withdraw.history') }}">
                            <span class="text">@lang('Withdraw History')</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li> --}}
        <li class="sidebar-menu-list__item has-dropdown {{ menuActive('ticket*') }}">
            <a href="javascript:void(0)" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-ticket-alt"></i></span>
                <span class="text">@lang('Support Ticket')</span>
            </a>
            <div class="sidebar-submenu">
                <ul class="sidebar-submenu-list">
                    <li class="sidebar-submenu-list__item">
                        <a href="{{ route('ticket.open') }}"
                           class="sidebar-submenu-list__link {{ menuActive('ticket.open') }}">
                            <span class="text">@lang('Open New Ticket')</span>
                        </a>
                    </li>
                    <li class="sidebar-submenu-list__item">
                        <a href="{{ route('ticket.index') }}"
                           class="sidebar-submenu-list__link {{ menuActive('ticket.index') }}">
                            <span class="text">@lang('My Tickets')</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.transactions') }}">
            <a href="{{ route('user.transactions') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-exchange-alt"></i></span>
                <span class="text">@lang('Transactions')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.profile.setting') }}">
            <a href="{{ route('user.profile.setting') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-user-alt"></i></span>
                <span class="text">@lang('Profile Setting')</span>
            </a>
        </li>

        <li class="sidebar-menu-list__item {{ menuActive('user.change.password') }}">
            <a href="{{ route('user.change.password') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-key"></i></span>
                <span class="text">@lang('Change Password')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.twofactor') }}">
            <a href="{{ route('user.twofactor') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-shield-alt"></i></span>
                <span class="text">@lang('2FA Security')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.logout') }}">
            <a href="{{ route('user.logout') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                <span class="text">@lang('Logout')</span>
            </a>
        </li>
    </ul>
</div>
