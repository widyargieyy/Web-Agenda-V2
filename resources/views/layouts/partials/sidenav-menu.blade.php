{{-- Staff --}}
@if (Auth::user()->role_id == 4)
    <ul class="side-nav">
        {{-- ==================== MAIN ==================== --}}
        <li class="side-nav-title mt-2" data-lang="main">Home</li>

        {{-- Dashboards --}}
        <li class="side-nav-item">
            <a href="{{ route('staff.dashboard') }}" class="side-nav-link ">
                <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                <span class="menu-text" data-lang="apps-chat">Dashboard</span>
            </a>
        </li>

        {{-- ==================== APPS ==================== --}}
        <li class="side-nav-title mt-2" data-lang="apps">Utama</li>

        {{-- Projects --}}
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#projects" aria-expanded="false" aria-controls="projects"
                class="side-nav-link">
                <span class="menu-icon"><i class="ti ti-calendar-event"></i></span>
                <span class="menu-text" data-lang="projects">Agenda</span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="projects">
                <ul class="sub-menu">
                    <li class="side-nav-item">
                        <a href="{{ route('staff.data-agenda') }}" class="side-nav-link">
                            <span class="menu-text" data-lang="apps-projects-grid">Lihat Agenda</span>
                        </a>
                    </li>
                    {{-- <li class="side-nav-item">
                    <a href="" class="side-nav-link">
                        <span class="menu-text" data-lang="apps-projects-grid">Upload Dokumen</span>
                    </a>
                </li> --}}
                </ul>
            </div>
        </li>
    </ul>
@elseif (Auth::user()->role_id == 2)
    {{-- Operator --}}
    <ul class="side-nav">
        {{-- ==================== MAIN ==================== --}}
        <li class="side-nav-title mt-2" data-lang="main">Home</li>

        {{-- Dashboards --}}
        <li class="side-nav-item">
            <a href="{{ route('operator.dashboard') }}" class="side-nav-link ">
                <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                <span class="menu-text" data-lang="apps-chat">Dashboard</span>
            </a>
        </li>

        {{-- ==================== APPS ==================== --}}
        <li class="side-nav-title mt-2" data-lang="apps">Utama</li>

        {{-- Projects --}}
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#projects" aria-expanded="false" aria-controls="projects"
                class="side-nav-link">
                <span class="menu-icon"><i class="ti ti-calendar-event"></i></span>
                <span class="menu-text" data-lang="projects">Agenda</span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="projects">
                <ul class="sub-menu">
                    <li class="side-nav-item">
                        <a href="{{ route('operator.buat-agenda.create') }}" class="side-nav-link">
                            <span class="menu-text" data-lang="apps-projects-grid">Buat Agenda</span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ route('operator.agenda-saya.index') }}" class="side-nav-link">
                            <span class="menu-text" data-lang="apps-projects-grid">Agenda Saya</span>
                        </a>
                    </li>

                </ul>
            </div>
        </li>
    </ul>
@elseif (Auth::user()->role_id == 1)
    {{-- Admin --}}
    <ul class="side-nav">
        {{-- ==================== MAIN ==================== --}}
        <li class="side-nav-title mt-2" data-lang="main">Home</li>

        {{-- Dashboards --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.dashboard') }}" class="side-nav-link ">
                <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                <span class="menu-text" data-lang="apps-chat">Dashboard</span>
            </a>
        </li>

        {{-- ==================== APPS ==================== --}}
        <li class="side-nav-title mt-2" data-lang="apps">Utama</li>

        {{-- Projects --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.user-management.index') }}" class="side-nav-link">
                <span class="menu-icon"><i class="ti ti-briefcase"></i></span>
                <span class="menu-text" data-lang="projects">Manajemen User</span>
            </a>

        </li>

        {{-- Dashboards --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.data-kategori.index') }}" class="side-nav-link ">
                <span class="menu-icon"><i class="ti ti-tags"></i></span>
                <span class="menu-text" data-lang="apps-chat">Manajemen Kategori</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="#" class="side-nav-link ">
                <span class="menu-icon"><i class="ti ti-calendar-event"></i></span>
                <span class="menu-text" data-lang="apps-chat">Data Agenda</span>
            </a>
        </li>

    </ul>
@elseif (Auth::user()->role_id == 3)
    {{-- Kabid --}}
    <ul class="side-nav">
        {{-- ==================== MAIN ==================== --}}
        <li class="side-nav-title mt-2" data-lang="main">Home</li>

        {{-- Dashboards --}}
        <li class="side-nav-item">
            <a href="{{ route('kabid.dashboard') }}" class="side-nav-link ">
                <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                <span class="menu-text" data-lang="apps-chat">Dashboard</span>
            </a>
        </li>

        {{-- ==================== APPS ==================== --}}
        <li class="side-nav-title mt-2" data-lang="apps">Utama</li>

        {{-- Projects --}}
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#projects" aria-expanded="false" aria-controls="projects"
                class="side-nav-link">
                <span class="menu-icon"><i class="ti ti-checklist"></i></span>
                <span class="menu-text" data-lang="projects">Approval</span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="projects">
                <ul class="sub-menu">
                    <li class="side-nav-item">
                        <a href="{{ route('kabid.approval.index') }}" class="side-nav-link">
                            <span class="menu-text" data-lang="apps-projects-grid">Agenda Pending</span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ route('kabid.completed.index') }}" class="side-nav-link">
                            <span class="menu-text" data-lang="apps-projects-grid">Agenda Disetujui</span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ route('kabid.riwayat.index') }}" class="side-nav-link">
                            <span class="menu-text" data-lang="apps-projects-grid">Riwayat</span>
                        </a>
                    </li>

                    {{-- <li class="side-nav-item">
                    <a href="" class="side-nav-link">
                        <span class="menu-text" data-lang="apps-projects-grid">Upload Dokumen</span>
                    </a>
                </li> --}}
                </ul>
            </div>
        </li>
    </ul>
@endif
