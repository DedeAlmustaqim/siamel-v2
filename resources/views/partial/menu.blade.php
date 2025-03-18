<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner">
            <!-- Dashboards -->
            <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ url('/dashboard') }}" class="menu-link">

                    <div data-i18n="DASHBOARD">DASHBOARD</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('apbd') ? 'active' : '' }}">
                <a href="{{ url('/apbd') }}" class="menu-link">

                    <div data-i18n="APBD">APBD</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('ppbj') ? 'active' : '' }}">
                <a href="{{ url('/ppbj') }}" class="menu-link">
                    <div data-i18n="PPBJ">PPBJ</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('dak') ? 'active' : '' }}">
                <a href="{{ url('/dak') }}" class="menu-link">
                    <div data-i18n="DAK">DAK</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('pendapatan') ? 'active' : '' }}">
                <a href="{{ url('/pendapatan') }}" class="menu-link">
                    <div data-i18n="PENDAPATAN">PENDAPATAN</div>
                </a>
            </li>

        </ul>
    </div>
</aside>
