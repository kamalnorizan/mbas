<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
        data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
        aria-controls="navbarVerticalCollapse" aria-expanded="false"
        aria-label="Toggle Navigation">
        <span class="navbar-toggle-icon">
            <span class="toggle-line"></span>
        </span>
    </button>

    <a class="navbar-brand me-1 me-sm-3" href="{{ url('/') }}">
        <div class="d-flex align-items-center">
            <img class="me-2" src="{{ asset('/falcon/assets/img/icons/spot-illustrations/falcon.png') }}" alt="" width="40" />
            {{-- <img class="me-2" src="{{ asset('/images/logo.png') }}" alt="" width="40" /> --}}
            <span class="font-sans-serif">DPMA</span>
        </div>
    </a>

    <!-- right menu -->
    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">

        <!-- theme dark / light -->
        <li class="nav-item px-2">
            <div class="theme-control-toggle fa-icon-wait">
                <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle" type="checkbox" data-theme-control="theme" value="dark" />
                <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch to light theme">
                    <span class="fas fa-sun fs-0"></span>
                </label>
                <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch to dark theme">
                    <span class="fas fa-moon fs-0"></span>
                </label>
            </div>
        </li>

        <!-- profile -->
        <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser"
                role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="avatar avatar-xl">
                    @if(isset(Auth::user()->details['profile_img']))
                        <img class="rounded-circle" src="{{ asset('/storage/profile/' . Auth::user()->details['profile_img']) }}" alt="" />
                    @else
                        <img class="rounded-circle" src="{{ asset('/falcon/assets/img/team/avatar.png') }}" alt="" />
                    @endif
                </div>
            </a>
            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                aria-labelledby="navbarDropdownUser">
                <div class="bg-white dark__bg-1000 rounded-2 py-2">

                    {{-- @if (@Auth()->user()->hasRole('client-admin')) --}}
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Account</a>
                    {{-- @endif --}}

                    {{-- @if (@Auth()->user()->hasRole('client-respondent')) --}}
                        <a class="dropdown-item" href="#">Profile</a>
                    {{-- @endif --}}

                    {{-- @if (@Auth()->user()->hasRole('admin')) --}}
                        <a class="dropdown-item" href="#">Profile & &nbsp;Account</a>
                    {{-- @endif --}}

                    @if(@Auth()->check())
                    <a class="dropdown-item" href="/logout">Logout</a>
                    @endif
                </div>
            </div>
        </li>
    </ul>
</nav>
