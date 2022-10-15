<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-normal">{{ $page }}</a>
        </div>
        <ul class="nav">
            {{-- for the dashboard page --}}
            @if ($pageSlug == 'dashboard')
                <li @if ($pageSlug == 'admin-dashboard') class="active " @endif>
                    <a href="{{ route('adminDashboard') }}">
                        <i class="tim-icons icon-single-02"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>

                <li @if ($pageSlug == 'users') class="active " @endif>
                    <a href="/profile">
                        <i class="tim-icons icon-single-02"></i>
                        <p>{{ __('Profile') }}</p>
                    </a>
                </li>

                <li @if ($pageSlug == 'tables') class="active " @endif>
                    <a href="{{ route('pages.tables') }}">
                        <i class="tim-icons icon-puzzle-10"></i>
                        <p>{{ __('Tabular stats') }}</p>
                    </a>
                </li>
            @elseif ($pageSlug == 'customer-dashboard')

            <li @if ($pageSlug == 'dashboard') class="active" @endif>
                <a href="/customer/dashboard">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="/shop">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('Shop') }}</p>
                </a>
            </li>

            <li @if ($pageSlug == 'users') class="active " @endif>
                <a href="/profile">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('User Profile') }}</p>
                </a>
            </li>

            <li @if ($pageSlug == 'notifications') class="active " @endif>
                <a href="/about/participants">
                    <i class="tim-icons icon-bell-55"></i>
                    <p>{{ __('Browse paticipants') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'tables') class="active " @endif>
                <a href="/customer/tables">
                    <i class="tim-icons icon-puzzle-10"></i>
                    <p>{{ __('Tabular stats') }}</p>
                </a>
            </li>
            @elseif ($pageSlug == 'participant')

            <li @if ($pageSlug == 'dashboard') class="active" @endif>
                <a href="/participant/dashboard">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>



            <li @if ($pageSlug == 'users') class="active " @endif>
                <a href="/profile">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('User Profile') }}</p>
                </a>
            </li>


            @else
                <li @if ($pageSlug == 'dashboard') class="active " @endif>
                    <a href="{{ route('home') }}">

                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>

                <li @if ($pageSlug == 'users') class="active " @endif>
                    <a href="{{ route('user.index') }}">
                        <i class="tim-icons icon-single-02"></i>
                        <p>{{ __('User Profile') }}</p>
                    </a>
                </li>
                <li @if ($pageSlug == 'maps') class="active " @endif>
                    <a href="{{ route('pages.maps') }}">
                        <i class="tim-icons icon-pin"></i>
                        <p>{{ __('Maps') }}</p>
                    </a>
                </li>
                <li @if ($pageSlug == 'notifications') class="active " @endif>
                    <a href="{{ route('pages.notifications') }}">
                        <i class="tim-icons icon-bell-55"></i>
                        <p>{{ __('Notifications') }}</p>
                    </a>
                </li>
                <li @if ($pageSlug == 'tables') class="active " @endif>
                    <a href="{{ route('pages.tables') }}">
                        <i class="tim-icons icon-puzzle-10"></i>
                        <p>{{ __('Tabular stats') }}</p>
                    </a>
                </li>
            @endif




        </ul>
    </div>
</div>
