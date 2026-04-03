@extends('layouts.app')

@section('title', 'Detail Agenda')

@section('page-title')
    <div class="page-title-head d-flex align-items-center">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Data Agenda</h4>
        </div>
        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('staff.data-agenda') }}">Data Agenda</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-xxl-12">

            {{-- ── TOMBOL KEMBALI ── --}}
            <div class="mb-3">
                <a href="{{ route('staff.data-agenda') }}" class="btn btn-sm btn-light">
                    <i class="ti ti-arrow-left me-1"></i>Kembali ke Data Agenda
                </a>
            </div>

            <div class="row g-3">

                {{-- ══════════════════════════════════════════
                     KOLOM UTAMA (kiri)
                ══════════════════════════════════════════ --}}
                <div class="col-xl-8">

                    {{-- ── HERO CARD: STATUS + JUDUL + META ── --}}
                    <div class="card mb-3">
                        <div class="card-body p-4">

                            {{-- Baris: badge status + tanggal dibuat --}}
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                @if ($data->status == 'COMPLETED')
                                    <span class="badge bg-success-subtle text-success px-2 py-1">
                                        <i class="ti ti-circle-check me-1"></i>Selesai
                                    </span>
                                @elseif ($data->status == 'APPROVED')
                                    <span class="badge bg-primary-subtle text-primary px-2 py-1">
                                        <i class="ti ti-circle-check me-1"></i>Disetujui
                                    </span>
                                @elseif ($data->status == 'PENDING')
                                    <span class="badge bg-warning-subtle text-warning px-2 py-1">
                                        <i class="ti ti-clock me-1"></i>Menunggu Persetujuan
                                    </span>
                                @elseif ($data->status == 'REJECTED')
                                    <span class="badge bg-danger-subtle text-danger px-2 py-1">
                                        <i class="ti ti-x me-1"></i>Ditolak
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary px-2 py-1">
                                        {{ $data->status ?? 'Draft' }}
                                    </span>
                                @endif

                                @if ($data->created_at)
                                    <span class="text-muted fs-xs">
                                        Dibuat
                                        {{ \Carbon\Carbon::parse($data->created_at)->locale('id')->isoFormat('D MMM Y') }}
                                    </span>
                                @endif
                            </div>

                            {{-- Judul --}}
                            <h4 class="fw-semibold mb-3">{{ $data->title ?? '-' }}</h4>

                            {{-- Chips: tanggal, waktu, lokasi --}}
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-light text-body border fw-normal px-3 py-2">
                                    <i class="ti ti-calendar me-1 text-primary"></i>
                                    {{ \Carbon\Carbon::parse($data->date)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                </span>
                                <span class="badge bg-light text-body border fw-normal px-3 py-2">
                                    <i class="ti ti-clock me-1 text-primary"></i>
                                    {{ $data->start_time }} – {{ $data->end_time }} WIB
                                </span>
                                @if ($data->place)
                                    <span class="badge bg-light text-body border fw-normal px-3 py-2">
                                        <i class="ti ti-map-pin me-1 text-danger"></i>
                                        {{ $data->place }}
                                    </span>
                                @endif
                            </div>

                        </div>

                        {{-- ── INFO GRID: 3 kolom (tanpa duplikasi lokasi) ── --}}
                        <div class="card-footer bg-light bg-opacity-50 px-4 py-3">
                            <div class="row g-3 text-center">
                                <div class="col-4">
                                    <p class="text-muted fs-xs text-uppercase fw-semibold mb-1">Dibuat Oleh</p>
                                    <p class="fw-medium fs-sm mb-0">{{ $data->creator->name ?? '-' }}</p>
                                </div>
                                <div class="col-4 border-start border-end">
                                    <p class="text-muted fs-xs text-uppercase fw-semibold mb-1">Disetujui Oleh</p>
                                    <p class="fw-medium fs-sm mb-0">{{ $data->approver->name ?? '-' }}</p>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted fs-xs text-uppercase fw-semibold mb-1">Tanggal Dibuat</p>
                                    <p class="fw-medium fs-sm mb-0">
                                        {{ $data->created_at ? \Carbon\Carbon::parse($data->created_at)->locale('id')->isoFormat('D MMM Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ── DESKRIPSI ── --}}
                    <div class="card mb-3">
                        <div class="card-body p-4">
                            <h6 class="fw-semibold text-muted text-uppercase fs-xs mb-2">
                                <i class="ti ti-align-left me-1"></i>Deskripsi Agenda
                            </h6>
                            <p class="mb-0 text-muted" style="line-height: 1.8;">
                                {{ $data->description ?? 'Tidak ada deskripsi.' }}
                            </p>
                        </div>
                    </div>

                    {{-- ── TABS: DOKUMENTASI & UPLOAD ── --}}
                    <div class="card">
                        <div class="card-header p-0 border-bottom">
                            <ul class="nav nav-tabs nav-bordered mb-0 px-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active py-3" data-bs-toggle="tab" href="#tab-dokumentasi"
                                        role="tab">
                                        <i class="ti ti-photo fs-lg me-1 align-middle"></i>
                                        <span class="align-middle">Dokumentasi</span>
                                        @if ($data->documentations->count() > 0)
                                            <span class="badge bg-primary text-white ms-1 rounded-pill">
                                                {{ $data->documentations->count() }}
                                            </span>
                                        @endif
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-3" data-bs-toggle="tab" href="#tab-upload" role="tab">
                                        <i class="ti ti-upload fs-lg me-1 align-middle"></i>
                                        <span class="align-middle">Upload Dokumentasi</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body p-4">
                            <div class="tab-content">

                                {{-- ── TAB: DAFTAR DOKUMENTASI ── --}}
                                <div class="tab-pane fade active show" id="tab-dokumentasi" role="tabpanel">

                                    @forelse ($data->documentations->sortByDesc('uploaded_at') as $dt)
                                        <div
                                            class="d-flex gap-3 py-3 {{ !$loop->last ? 'border-bottom border-dashed' : '' }}">

                                            {{-- Avatar inisial --}}
                                            @php
                                                $initials = collect(explode(' ', $dt->uploader->name ?? 'U'))
                                                    ->take(2)
                                                    ->map(fn($w) => strtoupper($w[0]))
                                                    ->join('');
                                                $colors = [
                                                    'bg-primary-subtle text-primary',
                                                    'bg-success-subtle text-success',
                                                    'bg-warning-subtle text-warning',
                                                    'bg-info-subtle text-info',
                                                    'bg-danger-subtle text-danger',
                                                ];
                                                $colorClass = $colors[$loop->index % count($colors)];
                                            @endphp
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="avatar-md rounded-circle {{ $colorClass }} d-flex align-items-center justify-content-center fw-bold fs-sm">
                                                    {{ $initials }}
                                                </div>
                                            </div>

                                            <div class="flex-grow-1">
                                                {{-- Nama + badge "Anda" + waktu --}}
                                                <div class="d-flex justify-content-between align-items-start mb-1">
                                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                                        <span
                                                            class="fw-semibold text-body fs-sm">{{ $dt->uploader->name ?? '-' }}</span>
                                                        @if (isset($dt->uploader) && $dt->uploader->id == Auth::id())
                                                            <span
                                                                class="badge bg-secondary-subtle text-secondary fs-xxs">Anda</span>
                                                        @endif
                                                        <span class="text-muted fs-xs">menambahkan dokumentasi</span>
                                                    </div>
                                                    <span class="text-muted fs-xs text-nowrap ms-2">
                                                        {{ \Carbon\Carbon::parse($dt->uploaded_at)->locale('id')->diffForHumans() }}
                                                    </span>
                                                </div>

                                                {{-- Caption --}}
                                                @if ($dt->caption)
                                                    <div
                                                        class="py-2 px-3 bg-light bg-opacity-50 rounded-2 mb-2 fs-sm fst-italic text-muted border-start border-3 border-primary">
                                                        "{{ $dt->caption }}"
                                                    </div>
                                                @endif

                                                {{-- Thumbnail + tombol lihat --}}
                                                <div class="d-flex align-items-center gap-2 mt-2">
                                                    <a href="{{ asset('storage/' . $dt->filepath) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $dt->filepath) }}" alt="preview"
                                                            class="rounded-2 border"
                                                            style="width:64px; height:64px; object-fit:cover;"
                                                            onerror="this.style.display='none'">
                                                    </a>
                                                    <a href="{{ asset('storage/' . $dt->filepath) }}"
                                                        class="btn btn-sm btn-light border" target="_blank">
                                                        <i class="ti ti-external-link me-1"></i>Lihat Gambar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                        <div class="text-center py-5">
                                            <div
                                                class="avatar-xl bg-light bg-opacity-75 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                                <i class="ti ti-photo-off fs-2xl text-muted"></i>
                                            </div>
                                            <h5 class="text-muted fw-medium">Belum Ada Dokumentasi</h5>
                                            <p class="text-muted fs-sm mb-0">Dokumentasi akan muncul di sini setelah
                                                diupload.</p>
                                        </div>
                                    @endforelse

                                </div>
                                {{-- END TAB DOKUMENTASI --}}

                                {{-- ── TAB: UPLOAD ── --}}
                                <div class="tab-pane fade" id="tab-upload" role="tabpanel">

                                    @if ($data->status == 'COMPLETED')

                                        @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible d-flex align-items-center gap-2 mb-4"
                                                role="alert">
                                                <i class="ti ti-alert-circle fs-xl flex-shrink-0"></i>
                                                <div class="flex-grow-1">
                                                    <strong>Gagal upload:</strong> {{ $errors->first() }}
                                                </div>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="alert"></button>
                                            </div>
                                        @endif

                                        <form action="{{ route('staff.data-agenda.upload', $data->id) }}" method="POST"
                                            enctype="multipart/form-data" id="upload-form">
                                            @csrf

                                            {{-- Drop Zone --}}
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold fs-sm">
                                                    <i class="ti ti-photo me-1 text-primary"></i>Pilih Foto Dokumentasi
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div id="drop-zone" class="border border-dashed rounded-3 p-5 text-center"
                                                    style="cursor:pointer; transition:all .2s ease;"
                                                    onclick="document.getElementById('file-input').click()">
                                                    <input type="file" id="file-input" name="file"
                                                        accept="image/*" class="d-none"
                                                        onchange="handleFileSelect(this)">

                                                    <div id="drop-placeholder">
                                                        <i class="ti ti-cloud-upload fs-2xl text-muted mb-2 d-block"></i>
                                                        <p class="fw-medium text-muted mb-1 fs-sm">Klik atau seret foto ke
                                                            sini</p>
                                                        <p class="text-muted fs-xs mb-0">JPG, PNG, WEBP &bull; Maks. 5MB
                                                        </p>
                                                    </div>

                                                    <div id="drop-preview" class="d-none">
                                                        <img id="img-preview" src="" alt="preview"
                                                            class="rounded-2 mb-2"
                                                            style="max-height:200px; max-width:100%; object-fit:contain;">
                                                        <p id="file-name" class="fs-xs text-muted mb-0"></p>
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger-subtle text-danger mt-2"
                                                            onclick="clearFile(event)">
                                                            <i class="ti ti-trash me-1"></i>Ganti Foto
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Caption --}}
                                            <div class="mb-4">
                                                <label class="form-label fw-semibold fs-sm">
                                                    <i class="ti ti-message me-1 text-primary"></i>Caption
                                                    <span class="text-muted fw-normal">(Opsional)</span>
                                                </label>
                                                <textarea class="form-control" name="caption" rows="3"
                                                    placeholder="Tulis keterangan singkat tentang foto ini..." style="resize:none;">{{ old('caption') }}</textarea>
                                            </div>

                                            <div class="d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-light btn-sm"
                                                    onclick="clearFile(event); document.querySelector('textarea[name=caption]').value=''">
                                                    <i class="ti ti-x me-1"></i>Reset
                                                </button>
                                                <button type="submit" class="btn btn-primary btn-sm" id="submit-btn"
                                                    disabled>
                                                    <i class="ti ti-send-2 me-1"></i>Kirim Dokumentasi
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <div class="text-center py-5">
                                            <div
                                                class="avatar-xl bg-warning-subtle rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                                <i class="ti ti-lock fs-2xl text-warning"></i>
                                            </div>
                                            <h5 class="fw-medium text-muted">Upload Belum Tersedia</h5>
                                            <p class="text-muted fs-sm mb-0">
                                                Dokumentasi hanya dapat diupload setelah agenda berstatus
                                                <strong>Selesai</strong>.
                                            </p>
                                        </div>
                                    @endif

                                </div>
                                {{-- END TAB UPLOAD --}}

                            </div>
                        </div>
                    </div>
                    {{-- END CARD TABS --}}

                </div>
                {{-- END KOLOM UTAMA --}}

                {{-- ══════════════════════════════════════════
                     SIDEBAR (kanan)
                ══════════════════════════════════════════ --}}
                <div class="col-xl-4">
                    <div class="d-flex flex-column gap-3">

                        {{-- ── RINGKASAN STATISTIK ── --}}
                        <div class="card">
                            <div class="card-header py-3">
                                <h5 class="mb-0 fs-sm fw-semibold text-muted text-uppercase">Ringkasan</h5>
                            </div>
                            <div class="card-body p-3">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="p-3 bg-primary-subtle rounded-3 text-center">
                                            <h3 class="mb-0 text-primary fw-bold">{{ $data->documentations->count() }}
                                            </h3>
                                            <p class="mb-0 fs-xs text-muted mt-1">Dokumentasi</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 bg-success-subtle rounded-3 text-center">
                                            <h3 class="mb-0 text-success fw-bold">{{ $data->attachments->count() }}</h3>
                                            <p class="mb-0 fs-xs text-muted mt-1">Lampiran</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ── TIMELINE STATUS AGENDA ── --}}
                        <div class="card">
                            <div class="card-header py-3">
                                <h5 class="mb-0 fs-sm fw-semibold text-muted text-uppercase">
                                    <i class="ti ti-timeline me-1"></i>Status Agenda
                                </h5>
                            </div>
                            <div class="card-body p-3">
                                <div class="timeline-steps">

                                    {{-- Dibuat --}}
                                    <div class="d-flex gap-3 mb-3">
                                        <div class="d-flex flex-column align-items-center">
                                            <div
                                                class="avatar-xs rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center">
                                                <i class="ti ti-check fs-xs"></i>
                                            </div>
                                            <div class="flex-grow-1 border-start border-dashed mt-1"
                                                style="min-height:28px; margin-left:1px;"></div>
                                        </div>
                                        <div class="pb-3">
                                            <p class="fw-semibold fs-sm mb-0">Dibuat</p>
                                            <p class="text-muted fs-xs mb-0">
                                                {{ $data->created_at ? \Carbon\Carbon::parse($data->created_at)->locale('id')->isoFormat('D MMM Y') : '-' }}
                                                &bull; {{ $data->creator->name ?? '-' }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Disetujui --}}
                                    <div class="d-flex gap-3 mb-3">
                                        <div class="d-flex flex-column align-items-center">
                                            @if (in_array($data->status, ['APPROVED', 'COMPLETED']))
                                                <div
                                                    class="avatar-xs rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-check fs-xs"></i>
                                                </div>
                                            @elseif ($data->status == 'REJECTED')
                                                <div
                                                    class="avatar-xs rounded-circle bg-danger-subtle text-danger d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-x fs-xs"></i>
                                                </div>
                                            @else
                                                <div
                                                    class="avatar-xs rounded-circle bg-warning-subtle text-warning d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-clock fs-xs"></i>
                                                </div>
                                            @endif
                                            <div class="flex-grow-1 border-start border-dashed mt-1"
                                                style="min-height:28px; margin-left:1px;"></div>
                                        </div>
                                        <div class="pb-3">
                                            <p class="fw-semibold fs-sm mb-0">
                                                @if ($data->status == 'REJECTED')
                                                    Ditolak
                                                @elseif ($data->status == 'PENDING')
                                                    Menunggu Persetujuan
                                                @else
                                                    Disetujui
                                                @endif
                                            </p>
                                            <p class="text-muted fs-xs mb-0">
                                                @if ($data->approver)
                                                    {{ $data->approver->name }}
                                                @else
                                                    Menunggu tindakan
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Selesai --}}
                                    <div class="d-flex gap-3">
                                        <div class="d-flex flex-column align-items-center">
                                            @if ($data->status == 'COMPLETED')
                                                <div
                                                    class="avatar-xs rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-check fs-xs"></i>
                                                </div>
                                            @else
                                                <div
                                                    class="avatar-xs rounded-circle bg-light text-muted d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-circle fs-xs"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p
                                                class="fw-semibold fs-sm mb-0 {{ $data->status != 'COMPLETED' ? 'text-muted' : '' }}">
                                                Selesai</p>
                                            <p class="text-muted fs-xs mb-0">
                                                {{ $data->status == 'COMPLETED' ? \Carbon\Carbon::parse($data->date)->locale('id')->isoFormat('D MMM Y') : 'Belum selesai' }}
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- ── LAMPIRAN ── --}}
                        <div class="card">
                            <div class="card-header py-3">
                                <h5 class="mb-0 fs-sm fw-semibold text-muted text-uppercase">
                                    <i class="ti ti-paperclip me-1"></i>Lampiran
                                    @if ($data->attachments->count() > 0)
                                        <span
                                            class="badge bg-secondary-subtle text-secondary ms-1">{{ $data->attachments->count() }}</span>
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body p-3">

                                @forelse ($data->attachments as $dt)
                                    <div
                                        class="d-flex align-items-center gap-3 py-2 {{ !$loop->last ? 'border-bottom border-dashed' : '' }}">

                                        @php
                                            $ext = strtolower(pathinfo($dt->filename ?? '', PATHINFO_EXTENSION));
                                            $iconClass = match ($ext) {
                                                'pdf' => 'ti-file-type-pdf text-danger',
                                                'doc', 'docx' => 'ti-file-type-doc text-primary',
                                                'xls', 'xlsx' => 'ti-file-type-xls text-success',
                                                'jpg', 'jpeg', 'png', 'webp' => 'ti-photo text-info',
                                                default => 'ti-file text-secondary',
                                            };
                                        @endphp

                                        <div
                                            class="flex-shrink-0 avatar-sm bg-light rounded-2 d-flex align-items-center justify-content-center">
                                            <i class="ti {{ $iconClass }} fs-lg"></i>
                                        </div>

                                        <div class="flex-grow-1 overflow-hidden">
                                            <h6 class="mb-0 fs-xs fw-medium text-truncate"
                                                title="{{ $dt->filename ?? '-' }}">
                                                <a href="{{ asset('storage/' . $dt->filepath) }}" class="link-reset"
                                                    target="_blank">
                                                    {{ $dt->filename ?? '-' }}
                                                </a>
                                            </h6>
                                            <p class="text-muted mb-0 fs-xxs">
                                                {{ number_format($dt->file_size / 1048576, 1) }} MB</p>
                                        </div>

                                        <a href="{{ asset('storage/' . $dt->filepath) }}"
                                            class="btn btn-sm btn-icon btn-light flex-shrink-0" title="Download" download>
                                            <i class="ti ti-download"></i>
                                        </a>
                                    </div>

                                @empty
                                    <div class="text-center py-4">
                                        <i class="ti ti-paperclip-off fs-2xl text-muted d-block mb-2"></i>
                                        <p class="text-muted fs-xs mb-0">Tidak ada lampiran</p>
                                    </div>
                                @endforelse

                            </div>
                        </div>

                    </div>
                </div>
                {{-- END SIDEBAR --}}

            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        #drop-zone:hover {
            border-color: var(--bs-primary) !important;
            background-color: rgba(var(--bs-primary-rgb), .03);
        }

        #drop-zone.dragover {
            border-color: var(--bs-primary) !important;
            background-color: rgba(var(--bs-primary-rgb), .06);
        }

        .border-3 {
            border-width: 3px !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            {{-- Auto-switch ke tab upload jika ada error validasi --}}
            @if ($errors->any())
                var triggerEl = document.querySelector('a[href="#tab-upload"]');
                if (triggerEl) {
                    new bootstrap.Tab(triggerEl).show();
                    triggerEl.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            @endif

            {{-- Drag-and-drop --}}
            var dropZone = document.getElementById('drop-zone');
            if (dropZone) {
                dropZone.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    dropZone.classList.add('dragover');
                });
                dropZone.addEventListener('dragleave', function() {
                    dropZone.classList.remove('dragover');
                });
                dropZone.addEventListener('drop', function(e) {
                    e.preventDefault();
                    dropZone.classList.remove('dragover');
                    var files = e.dataTransfer.files;
                    if (files.length > 0) {
                        var input = document.getElementById('file-input');
                        input.files = files;
                        handleFileSelect(input);
                    }
                });
            }
        });

        function handleFileSelect(input) {
            var file = input.files[0];
            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('Hanya file gambar yang diperbolehkan (JPG, PNG, WEBP).');
                clearFile(null, true);
                return;
            }
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file tidak boleh lebih dari 5MB.');
                clearFile(null, true);
                return;
            }

            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('img-preview').src = e.target.result;
                document.getElementById('file-name').textContent = file.name + ' (' + (file.size / 1024).toFixed(1) +
                    ' KB)';
                document.getElementById('drop-placeholder').classList.add('d-none');
                document.getElementById('drop-preview').classList.remove('d-none');
                document.getElementById('submit-btn').disabled = false;
            };
            reader.readAsDataURL(file);
        }

        function clearFile(event, silent) {
            if (event) event.stopPropagation();
            document.getElementById('file-input').value = '';
            document.getElementById('img-preview').src = '';
            document.getElementById('file-name').textContent = '';
            document.getElementById('drop-placeholder').classList.remove('d-none');
            document.getElementById('drop-preview').classList.add('d-none');
            document.getElementById('submit-btn').disabled = true;
        }
    </script>
@endpush
