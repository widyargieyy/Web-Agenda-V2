@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title')
    <div class="page-title-head d-flex align-items-center">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Dashboard Operator</h4>
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
                Selamat datang, {{ Auth::user()->name ?? 'Operator' }} 👋
            </h5>
            <p class="text-muted fs-sm mb-0">
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                &bull; Berikut ringkasan agenda Anda hari ini.
            </p>
        </div>
    </div>

    {{-- ===================== STAT CARDS ===================== --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3 mb-4">

        {{-- Draft --}}
        <div class="col">
            <div class="card border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar-md bg-primary-subtle rounded-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-file-pencil fs-xl text-primary"></i>
                        </div>
                        <span class="badge bg-primary-subtle text-primary fs-xs">Draft</span>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $agendaDraft ?? 0 }}</h2>
                    <p class="text-muted fs-sm mb-0">Agenda belum dikirim</p>
                </div>
                <div class="card-footer bg-primary-subtle border-0 py-2 px-3">
                    <a href="{{ route('operator.agenda-saya.index') }}"
                        class="text-primary fs-xs fw-medium text-decoration-none">
                        Lihat semua <i class="ti ti-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Pending --}}
        <div class="col">
            <div class="card border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar-md bg-warning-subtle rounded-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-clock-hour-4 fs-xl text-warning"></i>
                        </div>
                        <span class="badge bg-warning-subtle text-warning fs-xs">Pending</span>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $agendaPending ?? 0 }}</h2>
                    <p class="text-muted fs-sm mb-0">Menunggu persetujuan</p>
                </div>
                <div class="card-footer bg-warning-subtle border-0 py-2 px-3">
                    <a href="{{ route('operator.agenda-saya.index') }}"
                        class="text-warning fs-xs fw-medium text-decoration-none">
                        Lihat semua <i class="ti ti-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Approved --}}
        <div class="col">
            <div class="card border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar-md bg-success-subtle rounded-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle-check fs-xl text-success"></i>
                        </div>
                        <span class="badge bg-success-subtle text-success fs-xs">Approved</span>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $agendaApproved ?? 0 }}</h2>
                    <p class="text-muted fs-sm mb-0">Agenda disetujui</p>
                </div>
                <div class="card-footer bg-success-subtle border-0 py-2 px-3">
                    <a href="{{ route('operator.agenda-saya.index') }}"
                        class="text-success fs-xs fw-medium text-decoration-none">
                        Lihat semua <i class="ti ti-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Rejected --}}
        <div class="col">
            <div class="card border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar-md bg-danger-subtle rounded-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle-x fs-xl text-danger"></i>
                        </div>
                        <span class="badge bg-danger-subtle text-danger fs-xs">Rejected</span>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $agendaRejected ?? 0 }}</h2>
                    <p class="text-muted fs-sm mb-0">Agenda ditolak</p>
                </div>
                <div class="card-footer bg-danger-subtle border-0 py-2 px-3">
                    <a href="{{ route('operator.agenda-saya.index') }}"
                        class="text-danger fs-xs fw-medium text-decoration-none">
                        Lihat semua <i class="ti ti-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
    {{-- end stat cards --}}

    {{-- ===================== TABEL DRAFT ===================== --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-header border-bottom border-dashed d-flex align-items-center justify-content-between py-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar-sm bg-primary-subtle rounded-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-file-pencil text-primary"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Agenda Draft</h5>
                            <p class="text-muted fs-xs mb-0">Belum dikirim untuk persetujuan</p>
                        </div>
                    </div>
                    @if (isset($dataAgendaDraft) && $dataAgendaDraft->count() > 0)
                        <a href="{{ route('operator.agenda-saya.index') }}" class="btn btn-sm btn-light">
                            Lihat Semua <i class="ti ti-arrow-right ms-1"></i>
                        </a>
                    @endif
                </div>

                <div class="table-responsive">
                    <table class="table table-custom table-nowrap table-centered table-hover w-100 mb-0">
                        <thead class="bg-light bg-opacity-50 align-middle thead-sm">
                            <tr class="text-uppercase fs-xxs text-muted">
                                <th>Judul Agenda</th>
                                <th>Tanggal</th>
                                <th>Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataAgendaDraft as $data)
                                <tr>
                                    <td>
                                        <span class="fw-medium fs-sm">{{ $data->title ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <span class="d-flex align-items-center gap-1 text-muted fs-sm">
                                            <i class="ti ti-calendar fs-xs"></i>
                                            {{ $data->date ? \Carbon\Carbon::parse($data->date)->locale('id')->isoFormat('D MMM Y') : '-' }}
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
                                            <p class="text-muted fs-sm mb-0">Tidak ada agenda draft</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- ===================== TABEL REJECTED ===================== --}}
    <div class="row">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-header border-bottom border-dashed d-flex align-items-center justify-content-between py-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar-sm bg-danger-subtle rounded-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle-x text-danger"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Agenda Ditolak</h5>
                            <p class="text-muted fs-xs mb-0">Perlu diperbaiki dan dikirim kembali</p>
                        </div>
                    </div>
                    @if (isset($dataAgendaRejected) && $dataAgendaRejected->count() > 0)
                        <a href="{{ route('operator.agenda-saya.index') }}" class="btn btn-sm btn-light">
                            Lihat Semua <i class="ti ti-arrow-right ms-1"></i>
                        </a>
                    @endif
                </div>

                <div class="table-responsive">
                    <table class="table table-custom table-nowrap table-centered table-hover w-100 mb-0">
                        <thead class="bg-light bg-opacity-50 align-middle thead-sm">
                            <tr class="text-uppercase fs-xxs text-muted">
                                <th>Judul Agenda</th>
                                <th>Tanggal</th>
                                <th>Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataAgendaRejected as $data)
                                <tr>
                                    <td>
                                        <span class="fw-medium fs-sm">{{ $data->title ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <span class="d-flex align-items-center gap-1 text-muted fs-sm">
                                            <i class="ti ti-calendar fs-xs"></i>
                                            {{ $data->date ? \Carbon\Carbon::parse($data->date)->locale('id')->isoFormat('D MMM Y') : '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-xs">
                                            {{ $data->updated_at ? \Carbon\Carbon::parse($data->updated_at)->locale('id')->diffForHumans() : '-' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="text-center py-4">
                                            <i class="ti ti-mood-happy fs-2xl text-muted d-block mb-2"></i>
                                            <p class="text-muted fs-sm mb-0">Tidak ada agenda yang ditolak 🎉</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
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
