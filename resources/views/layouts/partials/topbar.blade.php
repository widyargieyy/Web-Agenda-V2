<header class="app-topbar">
    <div class="container-fluid topbar-menu">
        <div class="d-flex align-items-center gap-2">
            @php
                $dashboardRoute = '#'; // fallback jika tidak cocok
                if (auth()->user()->role_id == 1) {
                    $dashboardRoute = route('admin.dashboard');
                } elseif (auth()->user()->role_id == 2) {
                    $dashboardRoute = route('operator.dashboard');
                } elseif (auth()->user()->role_id == 4) {
                    $dashboardRoute = route('staff.dashboard');
                } elseif (auth()->user()->role_id == 3) {
                    $dashboardRoute = route('kabid.dashboard');
                }
            @endphp
            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="{{ $dashboardRoute }}" class="logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('assets') }}/images/logo.png" alt="logo" />
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets') }}/images/logo-sm.png" alt="small logo" />
                    </span>
                </a>

                <!-- Logo Dark -->
                <a href="{{ $dashboardRoute }}" class="logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('assets') }}/images/logo.png" alt="dark logo" />
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets') }}/images/logo-sm.png" alt="small logo" />
                    </span>
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="sidenav-toggle-button btn btn-primary btn-icon">
                <i class="ti ti-menu-4"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu">
                <i class="ti ti-menu-4"></i>
            </button>

            <!-- Search -->
            <div id="search-box-rounded" class="app-search d-none d-xl-flex">
                <input type="search" class="form-control rounded-pill topbar-search" name="search"
                    placeholder="Quick Search..." />
                <i class="ti ti-search app-search-icon text-muted"></i>
            </div>

            <!-- Mega Menu - Apps -->
            <div id="megamenu-apps" class="topbar-item d-none d-md-flex">
                <div class="dropdown">
                    <button class="topbar-link btn fw-medium btn-link dropdown-toggle drop-arrow-none px-2"
                        data-bs-toggle="dropdown" type="button" aria-haspopup="false" aria-expanded="false">
                        Apps
                        <i class="ti ti-chevron-down ms-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xxl p-0">
                        <div class="h-100" style="max-height: 380px" data-simplebar="">
                            <div class="row g-0">
                                <div class="col-sm-8">
                                    {{-- admin --}}
                                    @if (Auth::user()->role_id == 1)
                                        <div class="row g-0">
                                            <div class="col-sm-6">
                                                <div class="p-2">

                                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                                        <span class="d-flex align-items-center">
                                                            <span class="avatar-md me-2">
                                                                <span
                                                                    class="avatar-title text-primary border border-light bg-light bg-opacity-50 rounded">
                                                                    <i class="ti ti-layout-dashboard fs-22"></i>
                                                                </span>
                                                            </span>
                                                            <span>
                                                                <h5 class="fs-base mb-0 lh-base">Dashboard</h5>
                                                                <span class="text-muted fs-12">Ringkasan & statistik
                                                                    agenda</span>
                                                            </span>
                                                        </span>
                                                    </a>

                                                    <a href="{{ route('admin.data-agenda.index') }}"
                                                        class="dropdown-item my-2">
                                                        <span class="d-flex align-items-center">
                                                            <span class="avatar-md me-2">
                                                                <span
                                                                    class="avatar-title text-success border border-light bg-light bg-opacity-50 rounded">
                                                                    <i class="ti ti-calendar fs-22"></i>
                                                                </span>
                                                            </span>
                                                            <span>
                                                                <h5 class="fs-base mb-0 lh-base">Data Agenda</h5>
                                                                <span class="text-muted fs-12">Kelola jadwal &
                                                                    kegiatan</span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="p-2">
                                                    <a href="{{ route('admin.user-management.index') }}"
                                                        class="dropdown-item">
                                                        <span class="d-flex align-items-center">
                                                            <span class="avatar-md me-2">
                                                                <span
                                                                    class="avatar-title text-secondary border border-light bg-light bg-opacity-50 rounded">
                                                                    <i class="ti ti-users fs-22"></i>
                                                                </span>
                                                            </span>
                                                            <span>
                                                                <h5 class="fs-base mb-0 lh-base">Manajemen User</h5>
                                                                <span class="text-muted fs-12">Pengaturan hak akses
                                                                    akun</span>
                                                            </span>
                                                        </span>
                                                    </a>

                                                    <a href="{{ route('admin.user-management.index') }}"
                                                        class="dropdown-item my-2">
                                                        <span class="d-flex align-items-center">
                                                            <span class="avatar-md me-2">
                                                                <span
                                                                    class="avatar-title text-warning border border-light bg-light bg-opacity-50 rounded">
                                                                    <i class="ti ti-category fs-22"></i>
                                                                </span>
                                                            </span>
                                                            <span>
                                                                <h5 class="fs-base mb-0 lh-base">Manajemen Kategori</h5>
                                                                <span class="text-muted fs-12">Klasifikasi jenis
                                                                    kegiatan</span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if (Auth::user()->role_id == 4)
                                        <div class="row g-0">
                                            <div class="col-sm-6">
                                                <div class="p-2">
                                                    <a href="{{ route('staff.dashboard') }}" class="dropdown-item">
                                                        <span class="d-flex align-items-center">
                                                            <span class="avatar-md me-2">
                                                                <span
                                                                    class="avatar-title text-primary border border-light bg-light bg-opacity-50 rounded">
                                                                    <i class="ti ti-layout-dashboard fs-22"></i>
                                                                </span>
                                                            </span>
                                                            <span>
                                                                <h5 class="fs-base mb-0 lh-base">Dashboard</h5>
                                                                <span class="text-muted fs-12">Ringkasan & statistik
                                                                    agenda</span>
                                                            </span>
                                                        </span>
                                                    </a>

                                                    <a href="{{ route('staff.data-agenda') }}"
                                                        class="dropdown-item my-2">
                                                        <span class="d-flex align-items-center">
                                                            <span class="avatar-md me-2">
                                                                <span
                                                                    class="avatar-title text-success border border-light bg-light bg-opacity-50 rounded">
                                                                    <i class="ti ti-calendar fs-22"></i>
                                                                </span>
                                                            </span>
                                                            <span>
                                                                <h5 class="fs-base mb-0 lh-base">Lihat Agenda</h5>
                                                                <span class="text-muted fs-12">Lihat jadwal Agenda &
                                                                    kegiatan</span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if (Auth::user()->role_id == 2)
                                        <div class="row g-0">
                                            <div class="col-sm-6">
                                                <div class="p-2">
                                                    <a href="{{ route('operator.dashboard') }}"
                                                        class="dropdown-item">
                                                        <span class="d-flex align-items-center">
                                                            <span class="avatar-md me-2">
                                                                <span
                                                                    class="avatar-title text-primary border border-light bg-light bg-opacity-50 rounded">
                                                                    <i class="ti ti-smart-home fs-22"></i>
                                                                </span>
                                                            </span>
                                                            <span>
                                                                <h5 class="fs-base mb-0 lh-base">Dashboard</h5>
                                                                <span class="text-muted fs-12">Ringkasan & statistik
                                                                    agenda</span>
                                                            </span>
                                                        </span>
                                                    </a>

                                                    <a href="{{ route('operator.agenda-saya.index') }}"
                                                        class="dropdown-item my-2">
                                                        <span class="d-flex align-items-center">
                                                            <span class="avatar-md me-2">
                                                                <span
                                                                    class="avatar-title text-success border border-light bg-light bg-opacity-50 rounded">
                                                                    <i class="ti ti-calendar-event fs-22"></i>
                                                                </span>
                                                            </span>
                                                            <span>
                                                                <h5 class="fs-base mb-0 lh-base">Lihat Agenda</h5>
                                                                <span class="text-muted fs-12">Lihat jadwal Agenda &
                                                                    kegiatan</span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                    <a href="{{ route('operator.buat-agenda.create') }}"
                                                        class="dropdown-item my-2">
                                                        <span class="d-flex align-items-center">
                                                            <span class="avatar-md me-2">
                                                                <span
                                                                    class="avatar-title text-info border border-light bg-light bg-opacity-50 rounded">
                                                                    <i class="ti ti-calendar-plus fs-22"></i>
                                                                </span>
                                                            </span>
                                                            <span>
                                                                <h5 class="fs-base mb-0 lh-base">Buat Agenda</h5>
                                                                <span class="text-muted fs-12">Buat jadwal Agenda &
                                                                    kegiatan</span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- end row-->

                                    <div class="row g-0 border-top border-light border-dashed text-center">
                                        <div class="col">
                                            <div class="p-3">
                                                <p class="fw-medium text-muted mb-2 fs-11 text-uppercase lh-1">-:
                                                    &nbsp; Support &nbsp;:-</p>
                                                <h5 class="fs-15 mb-0">BappedaKab.Sumenep@ac.id</h5>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-3">
                                                <p class="fw-medium text-muted mb-2 fs-11 text-uppercase lh-1">-:
                                                    &nbsp; Help: &nbsp;:-</p>
                                                <h5 class="fs-15 mb-0">+(12) 3456 7890</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <!-- Theme Toggle -->
            <div id="theme-dropdown" class="topbar-item d-none d-sm-flex">
                <div class="dropdown">
                    <button class="topbar-link" data-bs-toggle="dropdown" type="button" aria-haspopup="false"
                        aria-expanded="false">
                        <i class="ti ti-sun topbar-link-icon d-none" id="theme-icon-light"></i>
                        <i class="ti ti-moon topbar-link-icon d-none" id="theme-icon-dark"></i>
                        <i class="ti ti-sun-moon topbar-link-icon d-none" id="theme-icon-system"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" data-thememode="dropdown">
                        <label class="dropdown-item cursor-pointer">
                            <input class="form-check-input" type="radio" name="data-bs-theme" value="light"
                                style="display: none" />
                            <i class="ti ti-sun align-middle me-1 fs-16"></i>
                            <span class="align-middle">Light</span>
                        </label>
                        <label class="dropdown-item cursor-pointer">
                            <input class="form-check-input" type="radio" name="data-bs-theme" value="dark"
                                style="display: none" />
                            <i class="ti ti-moon align-middle me-1 fs-16"></i>
                            <span class="align-middle">Dark</span>
                        </label>
                        <label class="dropdown-item cursor-pointer">
                            <input class="form-check-input" type="radio" name="data-bs-theme" value="system"
                                style="display: none" />
                            <i class="ti ti-sun-moon align-middle me-1 fs-16"></i>
                            <span class="align-middle">System</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            {{-- <div id="notification-dropdown-people" class="topbar-item">
                @include('layouts.partials.topbar-notifications')
            </div> --}}

            <!-- Fullscreen -->
            <div id="fullscreen-toggler" class="topbar-item d-none d-md-flex">
                <button class="topbar-link" type="button" data-toggle="fullscreen">
                    <i class="ti ti-maximize topbar-link-icon"></i>
                    <i class="ti ti-minimize topbar-link-icon d-none"></i>
                </button>
            </div>

            <!-- Monochrome -->
            <div id="monochrome-toggler" class="topbar-item d-none d-xl-flex">
                <button id="monochrome-mode" class="topbar-link" type="button" data-toggle="monochrome">
                    <i class="ti ti-palette topbar-link-icon"></i>
                </button>
            </div>

            <!-- Theme Settings -->
            <div class="topbar-item d-none d-sm-flex">
                <button class="topbar-link btn-theme-setting" data-bs-toggle="offcanvas"
                    data-bs-target="#theme-settings-offcanvas" type="button">
                    <i class="ti ti-settings topbar-link-icon"></i>
                </button>
            </div>

            <!-- User Dropdown -->
            <div id="user-dropdown-detailed" class="topbar-item nav-user">
                <div class="dropdown">
                    <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                        href="#!" aria-haspopup="false" aria-expanded="false">
                        <div class="rounded-circle me-lg-2 d-flex align-items-center justify-content-center bg-primary text-white fw-bold"
                            style="width: 32px; height: 32px; font-size: 12px; flex-shrink: 0;">
                            @php
                                // Ambil nama dari user yang sedang login
                                $words = explode(' ', Auth::user()->name ?? 'U');
                                $initials = '';
                                foreach ($words as $key => $word) {
                                    if ($key < 2) {
                                        $initials .= strtoupper(substr($word, 0, 1));
                                    }
                                }
                                echo $initials;
                            @endphp
                        </div>
                        <div class="d-lg-flex align-items-center gap-1 d-none">
                            <span>
                                <h5 class="my-0 lh-1 pro-username">{{ Auth::user()->name ?? 'belum login' }}</h5>
                                <span class="fs-xs lh-1">{{ Auth::user()->role->name }}</span>
                            </span>
                            <i class="ti ti-chevron-down align-middle"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome back 👋!</h6>
                        </div>
                        <a href="#!" class="dropdown-item">
                            <i class="ti ti-user-circle me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Profile</span>
                        </a>
                        {{-- <a href="javascript:void(0);" class="dropdown-item">
                            <i class="ti ti-bell-ringing me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Notifications</span>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="ti ti-settings-2 me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Account Settings</span>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="ti ti-headset me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Support Center</span>
                        </a> --}}
                        <div class="dropdown-divider"></div>
                        {{-- <a href="auth-lock-screen.html" class="dropdown-item">
                            <i class="ti ti-lock me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Lock Screen</span>
                        </a>  --}}
                        <a href="{{ route('logout') }}" class="dropdown-item fw-semibold">
                            <i class="ti ti-logout me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
<!-- Topbar End -->
