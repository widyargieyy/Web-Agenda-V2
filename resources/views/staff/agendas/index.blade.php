@extends('layouts.app')

@section('title', 'Data Agenda')

@section('page-title')
    <div class="page-title-head d-flex align-items-center">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Data Agenda</h4>
        </div>
        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                <li class="breadcrumb-item active">Data Agenda</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

    <!-- Data Agenda Table Section -->

    <div class="row">
        <div class="col-12">
            <div data-table data-table-rows-per-page="8" class="card">
                <div class="card-header border-light d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div class="d-flex gap-2 align-items-center">
                        <!-- Search -->
                        <div class="app-search">
                            <input data-table-search type="search" class="form-control" placeholder="Cari agenda..." />
                            <i class="ti ti-search app-search-icon text-muted"></i>
                        </div>
                        <!-- Delete Selected -->
                        <button data-table-delete-selected class="btn btn-danger d-none">Hapus</button>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="me-2 fw-semibold">Filter:</span>
                        <!-- Kategori Filter -->
                        <div class="app-search">
                            <select data-table-filter="kategori" class="form-select form-control my-1 my-md-0">
                                <option value="All">Kategori</option>
                                @foreach ($dataKategori as $data)
                                    <option value="{{ $data->name }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                            <i class="ti ti-list-check app-search-icon text-muted"></i>
                        </div>

                        <!-- Status Filter -->
                        <div class="app-search">
                            <select data-table-filter="status" class="form-select form-control my-1 my-md-0">
                                <option value="All">Status</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                            <i class="ti ti-list-check app-search-icon text-muted"></i>
                        </div>
                        <!-- Records Per Page -->
                        <div>
                            <select data-table-set-rows-per-page class="form-select form-control my-1 my-md-0">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom table-centered table-select table-hover w-100 mb-0">
                        <thead class="bg-light align-middle bg-opacity-25 thead-sm">
                            <tr class="text-uppercase fs-xxs">
                                <th data-table-sort>Judul Agenda</th>
                                <th data-table-sort>Tanggal Agenda</th>
                                <th data-table-sort data-column="kategori">Kategori</th>
                                <th data-table-sort data-column="status">Status</th>
                                <th class="text-center" style="width: 1%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agendas as $data)
                                <tr>
                                    <td>
                                        <h5 class="fs-base mb-0">
                                            <a href="{{ route('staff.data-agenda.detail', $data->id) }}" class="link-reset">
                                                {{ $data->title ?? '-' }}
                                            </a>
                                        </h5>
                                        <p class="text-muted fs-xs mb-0">Dibuat:
                                            {{ \Carbon\Carbon::parse($data->created_at)->format('j M, Y') }} <small
                                                class="text-muted">
                                                {{ \Carbon\Carbon::parse($data->created_at)->format('H:i') }} WIB
                                            </small>
                                        </p>
                                    </td>
                                    <td><i class="ti ti-calendar text-muted me-1"></i> {{ $data->date ?? '-' }}</td>
                                    <td>{{ $data->category->name ?? '-' }}</td>
                                    <td>
                                        @if ($data->status == 'COMPLETED')
                                            <span class="badge bg-success-subtle text-success p-1">Selesai</span>
                                        @elseif ($data->status == 'APPROVED')
                                            <span class="badge bg-primary-subtle text-primary p-1">Disetujui</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('staff.data-agenda.detail', $data->id) }}"
                                                class="btn btn-default btn-icon btn-sm">
                                                <i class="ti ti-eye fs-lg"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div data-table-pagination-info="tasks"></div>
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
