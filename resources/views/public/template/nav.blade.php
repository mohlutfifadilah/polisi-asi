@php
    $containerNav = $containerNav ?? 'container-xxl';
    $navbarDetached = $navbarDetached ?? '';
@endphp

<!-- Navbar -->
@if (isset($navbarDetached) && $navbarDetached == 'navbar-detached')
    <nav class="layout-navbar {{ $containerNav }} navbar navbar-expand-xl {{ $navbarDetached }} align-items-center bg-navbar-theme"
        id="layout-navbar">
@endif
@if (isset($navbarDetached) && $navbarDetached == '')
    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="{{ $containerNav }}">
@endif

<!--  Brand demo (display only for navbar-full and hide on below xl) -->
@if (isset($navbarFull))
    <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{ url('/') }}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
                {{-- @include('_partials.macros',["width"=>25,"withbg"=>'#666cff']) --}}
                <img src="{{ asset('assets/img/favicon/logo_POLISI-ASI(with text).png') }}" alt="logodinsos" width="180">
            </span>
            {{-- <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span> --}}
        </a>
    </div>
@endif

<!-- ! Not required for layout-without-menu -->
@if (!isset($navbarHideToggle))
    <div
        class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ? ' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="mdi mdi-menu mdi-24px"></i>
        </a>
    </div>
@endif

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- Style Switcher -->
        <li class="nav-item me-1 me-xl-0">
            <a class="nav-link btn btn-text-secondary rounded-pill btn-icon style-switcher-toggle hide-arrow"
                href="javascript:void(0);">
                <i class='mdi mdi-24px'></i>
            </a>
        </li>
        <!--/ Style Switcher -->
        <li class="nav-item mx-4">
          <a href="/" class="nav-link active">Beranda</a>
        </li>
        <li class="nav-item mx-4">
          <a href="" class="nav-link">Tentang</a>
        </li>
        <li class="nav-item mx-4">
          <a href="{{ url('/lapor') }}" class="nav-link">Lapor</a>
        </li>
        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown ms-3">
            @if (Auth::check())
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    @if (empty(Auth::user()->profile_photo_path))
                        <div class="avatar avatar-online">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                class="w-px-40 h-auto rounded-circle">
                        </div>
                    @else
                        <div class="avatar avatar-online">
                            <img src="{{ asset('storage/profile/' . Auth::user()->profile_photo_path) }}" alt
                                class="w-px-40 h-auto rounded-circle">
                        </div>
                    @endif
                </a>
            @else
                <a href="/login" class="btn btn-success ms-3">Masuk</a>
            @endif
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                @if (empty(Auth::user()->profile_photo_path))
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                            class="w-px-40 h-auto rounded-circle">
                                    </div>
                                @else
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('storage/profile/' . Auth::user()->profile_photo_path) }}"
                                            alt class="w-px-40 h-auto rounded-circle">
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-semibold d-block">
                                    @if (Auth::check())
                                        {{ Auth::user()->name }}
                                    @else
                                        John Doe
                                    @endif
                                </span>
                                @if (Auth::check())
                                  @php
                                    $role = App\Models\Role::find(Auth::user()->id_role);
                                @endphp
                                <small class="text-muted">{{ $role ? $role->name : 'xxx' }}</small>
                                @endif
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ url('/profile') }}">
                        <i class="mdi mdi-account-outline me-2"></i>
                        <span class="align-middle">Akun Saya</span>
                    </a>
                </li>
                {{-- @if (Auth::check() && Laravel\Jetstream\Jetstream::hasApiFeatures())
            <li>
              <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
                <i class='mdi mdi-key-outline me-2'></i>
                <span class="align-middle">API Tokens</span>
              </a>
            </li>
            @endif
            <li>
              <a class="dropdown-item" href="{{url('app/invoice/list')}}">
                <i class="mdi mdi-credit-card-outline me-2"></i>
                <span class="align-middle">Billing</span>
              </a>
            </li>
            @if (Auth::User() && Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <h6 class="dropdown-header">Manage Team</h6>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <a class="dropdown-item" href="{{ Auth::user() ? route('teams.show', Auth::user()->currentTeam->id) : 'javascript:void(0)' }}">
                <i class='mdi mdi-cog-outline me-2'></i>
                <span class="align-middle">Team Settings</span>
              </a>
            </li>
            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
            <li>
              <a class="dropdown-item" href="{{ route('teams.create') }}">
                <i class='mdi mdi-account-outline me-2'></i>
                <span class="align-middle">Create New Team</span>
              </a>
            </li>
            @endcan
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <lI>
              <h6 class="dropdown-header">Switch Teams</h6>
            </lI>
            <li>
              <div class="dropdown-divider"></div>
            </li> --}}
                {{-- @if (Auth::user())
            @foreach (Auth::user()->allTeams() as $team)
            Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use jetstream.

            <x-switchable-team :team="$team" />
            @endforeach
            @endif
            @endif --}}
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                {{-- @if (Auth::check()) --}}
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class='mdi mdi-logout me-2'></i>
                        <span class="align-middle">Keluar</span>
                    </a>
                </li>
                <form method="POST" id="logout-form" action="{{ route('logout') }}">
                    @csrf
                </form>
                {{-- @else
            <li>
              <a class="dropdown-item" href="{{ Route::has('login') ? route('login') : url('auth/login-basic') }}">
                <i class='mdi mdi-login me-2'></i>
                <span class="align-middle">Login</span>
              </a>
            </li>
            @endif --}}
            </ul>
        </li>
        <!--/ User -->
    </ul>
</div>
@if (!isset($navbarDetached))
    </div>
@endif
</nav>
<!-- / Navbar -->
