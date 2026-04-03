@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title')
    <div class="page-title-head d-flex align-items-center">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Staff</h4>
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

    <!-- Stat Cards Section -->

    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3 mb-4">
        <!-- Total Agenda Card -->
        <div class="col">
            <div class="card border-0 rounded-3 text-white"
                style="background-image: url('{{ asset('assets/images/stock/small-1.jpg') }}'); background-size: cover;">
                <div class="card-body bg-gradient bg-primary bg-opacity-90 rounded-3">
                    <iconify-icon icon="solar:bus-bold-duotone" class="fs-36"></iconify-icon>
                    <p class="text-white text-opacity-75 mb-1 text-uppercase">Total Agenda</p>
                    <h4 class="fw-medium fs-16 mb-1 text-white">{{ $totalAgenda ?? 0 }}</h4>
                    <h3 class="fw-semibold mb-2 fs-20 text-white">Agenda</h3>
                </div>
            </div>
        </div>
        <!-- Agenda Bulan Ini Card -->
        <div class="col">
            <div class="card border-0 rounded-3 text-white"
                style="background-image: url('{{ asset('assets/images/stock/small-2.jpg') }}'); background-size: cover;">
                <div class="card-body bg-gradient bg-secondary bg-opacity-90 rounded-3">
                    <iconify-icon icon="solar:globus-bold-duotone" class="fs-36"></iconify-icon>
                    <p class="text-white text-opacity-75 mb-1 text-uppercase">Bulan Ini</p>
                    <h4 class="fw-medium fs-16 mb-1 text-white">{{ $agendaBulanIni ?? 0 }}</h4>
                    <h3 class="fw-semibold mb-2 fs-20 text-white">Agenda</h3>
                </div>
            </div>
        </div>
        <!-- Dokumen Terupload Card -->
        <div class="col">
            <div class="card border-0 rounded-3 text-white"
                style="background-image: url('{{ asset('assets/images/stock/small-3.jpg') }}'); background-size: cover;">
                <div class="card-body bg-gradient bg-warning bg-opacity-90 rounded-3">
                    <iconify-icon icon="solar:square-academic-cap-2-bold-duotone" class="fs-36"></iconify-icon>
                    <p class="text-white text-opacity-75 mb-1 text-uppercase">Dok. Terupload</p>
                    <h4 class="fw-medium fs-16 mb-1 text-white">{{ $totalDokumen ?? 0 }}</h4>
                    <h3 class="fw-semibold mb-2 fs-20 text-white">Agenda</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Alert Section -->
    <div class="alert alert-success alert-dismissible d-flex align-items-center mb-4" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <i class="ti ti-lifebuoy fs-24 me-2"></i>
        <div>
            <strong>Lihat Semua Agenda</strong>
            Lihat semua agenda yang ada di sistem untuk memastikan tidak ada agenda yang terlewatkan.
        </div>
        <a href="#" class="text-reset text-decoration-underline ms-auto"><b>Lihat Semua</b></a>
    </div>

    <!-- Jadwal Agenda Mendatang Table -->
    <div class="row">
        <div class="col-12">
            <div data-table data-table-rows-per-page="8" class="card">
                <div class="card-header border-light d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Jadwal Agenda Mendatang</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom table-nowrap table-centered table-select table-hover w-100 mb-0">
                        <thead class="bg-light align-middle bg-opacity-25 thead-sm">
                            <tr class="text-uppercase fs-xxs">
                                <th data-table-sort class="text-muted">Tanggal Jadwal Agenda</th>
                                <th data-table-sort class="text-muted">Judul</th>
                                <th data-table-sort class="text-muted">Lokasi</th>
                                <th data-table-sort class="text-muted">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agendaMendatang as $data)
                                <tr>
                                    <td>
                                        <a href="#" class="fw-medium text-reset">
                                            {{ $data->date ?? '-' }}
                                            {{ \Carbon\Carbon::parse($data->start_time)->format('H:i') . ' WIB' }} -
                                            {{ \Carbon\Carbon::parse($data->end_time)->format('H:i') . ' WIB' }}
                                        </a>
                                    </td>
                                    <td>{{ $data->title }}</td>
                                    <td class="text-success text-capitalize">{{ $data->place ?? '-' }}</td>
                                    <td>{{ $data->category->name ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div data-table-pagination-info="Agenda"></div>
                        <div data-table-pagination></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/pages/dashboard-finance.js') }}"></script>
@endpush
