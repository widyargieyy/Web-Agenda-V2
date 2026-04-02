@extends('layouts.app')

@section('title', 'Data Agenda')

@section('page-title')
    <div class="page-title-head d-flex align-items-center">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Riwayat Agenda</h4>
        </div>
        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                <li class="breadcrumb-item active">Riwayat Agenda</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    {{-- Alert --}}
    {{-- <div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <i class="ti ti-lifebuoy fs-24 me-1"></i>
        <div>
            <strong> Dear David Dev - </strong>
            We kindly encourage you to review your recent transactions and financial commitments to ensure that your account
            is in good standing.
        </div>
        <a href="#!" class="text-reset text-decoration-underline ms-auto link-offset-2"><b>Action Now</b></a>
    </div> --}}

    <div class="row">
        <div class="col-12">
            <div data-table data-table-rows-per-page="8" class="card">
                <div class="card-header border-light justify-content-between">
                    <div class="d-flex gap-2">
                        <!-- Search -->
                        <div class="app-search">
                            <input data-table-search type="search" class="form-control" placeholder="Search task..." />
                            <i class="ti ti-search app-search-icon text-muted"></i>
                        </div>

                        <!-- Delete Selected -->
                        <button data-table-delete-selected class="btn btn-danger d-none">Delete</button>
                    </div>

                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="me-2 fw-semibold">Filter By:</span>

                        <!-- Task kategori Filter -->
                        <div class="app-search">
                            <select data-table-filter="kategori" class="form-select form-control my-1 my-md-0">
                                <option value="All">Kategori</option>
                                @foreach ($dataKategori as $data)
                                    <option value="{{ $data->name }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                            <i class="ti ti-list-check app-search-icon text-muted"></i>
                        </div>

                        <!-- Task kategori Filter -->
                        <div class="app-search">
                            <select data-table-filter="status" class="form-select form-control my-1 my-md-0">
                                <option value="All">Status</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Menunggu Persetujuan">Menunggu Persetujuan</option>
                                <option value="Ditolak">Ditolak</option>
                                <option value="Dibatalkan">Dibatalkan</option>
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

                    {{-- <div class="d-flex gap-1">
                        <a href="apps-task-create.html" class="btn btn-primary ms-1"> <i class="ti ti-plus fs-sm me-2"></i>
                            Add Task </a>
                    </div> --}}
                </div>

                <div class="table-responsive">
                    <table class="table table-custom table-centered table-select table-hover w-100 mb-0">
                        <thead class="bg-light align-middle bg-opacity-25 thead-sm">
                            <tr class="text-uppercase fs-xxs">
                                <th data-table-sort>Judul Agenda</th>
                                <th data-table-sort>Tanggal Agenda</th>
                                <th data-table-sort data-column="kategori">Kategori</th>
                                <th data-table-sort data-column="status">Status</th>
                                <th class="text-center" style="width: 1%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Task 12 -->
                            @foreach ($dataAgenda as $data)
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
                                                {{ \Carbon\Carbon::parse($data->created_at)->format('H:i') }}
                                                WIB</small></p>
                                    </td>

                                    <td><i class="ti ti-calendar text-muted me-1"></i>
                                        {{ $data->date ?? '-' }}</td>

                                    <td>{{ $data->category->name ?? '-' }}</td>
                                    <td>
                                        @if ($data->status == 'COMPLETED')
                                            <span class="badge bg-success-subtle text-success fs-xs px-2 py-1">
                                                <i class="ti ti-circle-check me-1"></i>Selesai
                                            </span>
                                        @elseif ($data->status == 'APPROVED')
                                            <span class="badge bg-primary-subtle text-primary fs-xs px-2 py-1">
                                                <i class="ti ti-circle-check me-1"></i>Disetujui
                                            </span>
                                        @elseif ($data->status == 'PENDING')
                                            <span class="badge bg-warning-subtle text-warning fs-xs px-2 py-1">
                                                <i class="ti ti-clock me-1"></i>Menunggu Persetujuan
                                            </span>
                                        @elseif ($data->status == 'REJECTED')
                                            <span class="badge bg-danger-subtle text-danger fs-xs px-2 py-1">
                                                <i class="ti ti-x me-1"></i>Ditolak
                                            </span>
                                        @elseif ($data->status == 'CANCELLED')
                                            <span class="badge bg-purple-subtle text-purple fs-xs px-2 py-1">
                                                <i class="ti ti-x me-1"></i>Dibatalkan
                                            </span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary fs-xs px-2 py-1">
                                                {{ $data->status ?? 'Draft' }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('kabid.riwayat.show', $data->id) }}"
                                                class="btn btn-default btn-icon btn-sm">
                                                <i class="ti ti-eye fs-lg"></i>
                                            </a>
                                            {{-- <a href="#" class="btn btn-default btn-icon btn-sm"><i
                                                class="ti ti-edit fs-lg"></i></a>
                                        <a href="#" data-table-delete-row class="btn btn-default btn-icon btn-sm"><i
                                                class="ti ti-trash fs-lg"></i></a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div data-table-pagination-info="Agendas"></div>
                        <div data-table-pagination></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

@endsection

@push('scripts')
@endpush
