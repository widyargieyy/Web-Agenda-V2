@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title')
    <div class="page-title-head d-flex align-items-center">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Dashboard Kabid</h4>
        </div>
        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

    {{-- ===================== GREETING ===================== --}}
    <div class="d-flex align-items-center mb-4 gap-3">
        <div>
            <h5 class="fw-semibold mb-1">
                Selamat datang, {{ Auth::user()->name ?? 'Kabid' }} 👋
            </h5>
            <p class="text-muted fs-sm mb-0">
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                &bull; Berikut ringkasan agenda Anda hari ini.
            </p>
        </div>
    </div>

    {{-- ===================== STAT CARDS ===================== --}}
    {{-- ===================== STAT CARDS ===================== --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3 mb-4">

        {{-- Pending --}}
        <div class="col">
            <div class="card border-0 h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div
                            class="avatar-md bg-secondary-subtle rounded-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-clock-hour-4 fs-xl text-secondary"></i>
                        </div>
                        <span class="badge bg-secondary-subtle text-secondary fs-xs">Total User</span>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $totalUser ?? 0 }}</h2>
                    <p class="text-muted fs-sm mb-0">Total Data User</p>
                </div>
                <div class="card-footer bg-transparent border-0 py-2 px-3">
                    <a href="" class="text-secondary fs-xs fw-medium text-decoration-none">
                        Lihat semua <i class="ti ti-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Approved --}}
        <div class="col">
            <div class="card border-0 h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar-md bg-success-subtle rounded-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle-check fs-xl text-success"></i>
                        </div>
                        <span class="badge bg-success-subtle text-success fs-xs">Total Agenda</span>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $totalAgenda ?? 0 }}</h2>
                    <p class="text-muted fs-sm mb-0">Total Agenda</p>
                </div>
                <div class="card-footer bg-transparent border-0 py-2 px-3">
                    <a href="" class="text-success fs-xs fw-medium text-decoration-none">
                        Lihat semua <i class="ti ti-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Cancelled --}}
        <div class="col">
            <div class="card border-0 h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar-md bg-warning-subtle rounded-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle-x fs-xl text-warning"></i>
                        </div>
                        <span class="badge bg-warning-subtle text-warning fs-xs">Pending</span>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $totalPending ?? 0 }}</h2>
                    <p class="text-muted fs-sm mb-0">Agenda yang menunggu persetujuan</p>
                </div>
                <div class="card-footer bg-transparent border-0 py-2 px-3">
                    <a href="" class="text-warning fs-xs fw-medium text-decoration-none">
                        Lihat semua <i class="ti ti-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        
        {{-- Completed --}}
        <div class="col">
            <div class="card border-0 h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar-md bg-primary-subtle rounded-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-file-pencil fs-xl text-primary"></i>
                        </div>
                        <span class="badge bg-primary-subtle text-primary fs-xs">Agenda Approve</span>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $totalApproved ?? 0 }}</h2>
                    <p class="text-muted fs-sm mb-0">Agenda Disetujui</p>
                </div>
                <div class="card-footer bg-transparent border-0 py-2 px-3">
                    <a href="" class="text-primary fs-xs fw-medium text-decoration-none">
                        Lihat semua <i class="ti ti-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>



    </div>
    {{-- end stat cards --}}
    {{-- end stat cards --}}

    {{-- ===================== TABEL Rekap Bulanan ===================== --}}
    <div class="row mb-4">
        <div class="col-8">
            <div class="card border-0">
                <div class="card-header border-bottom border-dashed d-flex align-items-center justify-content-between py-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar-sm bg-primary-subtle rounded-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-file-pencil text-primary"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Agenda Terbaru Masuk</h5>
                            <p class="text-muted fs-xs mb-0">Daftar agenda terbaru yang masuk</p>
                        </div>
                    </div>
                    <a href="" class="btn btn-sm btn-light">
                        Lihat Semua <i class="ti ti-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom table-nowrap table-centered table-hover w-100 mb-0">
                        <thead class="bg-light bg-opacity-50 align-middle thead-sm">
                            <tr class="text-uppercase fs-xxs text-muted">
                                <th>Judul Agenda</th>
                                <th>DIbuat Oleh</th>
                                <th>Dibuat </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataAgenda as $data)
                                <tr>
                                    <td>
                                        <span class="fw-medium fs-sm">{{ $data->title ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <span class="d-flex align-items-center gap-1 text-muted fs-sm">
                                            {{ $data->creator->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-xs">
                                            {{ $data->created_at ? \Carbon\Carbon::parse($data->created_at)->locale('id')->diffForHumans() : '-' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="text-center py-4">
                                            <i class="ti ti-file-off fs-2xl text-muted d-block mb-2"></i>
                                            <p class="text-muted fs-sm mb-0">Tidak ada agenda Pending</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="col-4">
            <div class="card border-0">
                <div class="card-header border-bottom border-dashed d-flex align-items-center justify-content-between py-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar-sm bg-primary-subtle rounded-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-file-pencil text-primary"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">User Terdaftar Per Role</h5>
                            <p class="text-muted fs-xs mb-0">Jumlah user berdasarkan role</p>
                        </div>
                    </div>

                    <a href="" class="btn btn-sm btn-light">
                        Lihat Semua <i class="ti ti-arrow-right ms-1"></i>
                    </a>

                </div>

                <div class="table-responsive">
                    <table class="table table-custom table-nowrap table-centered table-hover w-100 mb-0">
                        <thead class="bg-light bg-opacity-50 align-middle thead-sm">
                            <tr class="text-uppercase fs-xxs text-muted">
                                <th>Role</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span class="fw-medium fs-sm">Admin</span>
                                </td>
                                <td>
                                    <span class="d-flex align-items-center gap-1 text-muted fs-sm">
                                        {{ $totalAdmin ?? 0 }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-medium fs-sm">Kabid</span>
                                </td>
                                <td>
                                    <span class="d-flex align-items-center gap-1 text-muted fs-sm">
                                        {{ $totalKabid ?? 0 }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-medium fs-sm">Operator</span>
                                </td>
                                <td>
                                    <span class="d-flex align-items-center gap-1 text-muted fs-sm">
                                        {{ $totalOperator ?? 0 }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-medium fs-sm">Staff</span>
                                </td>
                                <td>
                                    <span class="d-flex align-items-center gap-1 text-muted fs-sm">
                                        {{ $totalStaff ?? 0 }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="{{ asset('assets') }}/js/pages/dashboard-finance.js"></script>
@endpush
