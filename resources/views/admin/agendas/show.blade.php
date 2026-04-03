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
                <li class="breadcrumb-item"><a href="{{ route('operator.agenda-saya.index') }}">Data Agenda</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

    {{-- ===================== HERO HEADER ===================== --}}
    <div class="agenda-hero mb-4">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('admin.data-agenda.index') }}" class="btn btn-sm btn-light">
                <i class="ti ti-arrow-left me-1"></i>Kembali
            </a>
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
            @else
                <span class="badge bg-secondary-subtle text-secondary fs-xs px-2 py-1">
                    {{ $data->status ?? 'Draft' }}
                </span>
            @endif
        </div>

        <h2 class="fw-semibold mb-2">{{ $data->title ?? '-' }}</h2>

        <div class="d-flex flex-wrap gap-3">
            <span class="text-muted fs-sm d-flex align-items-center gap-1">
                <i class="ti ti-calendar text-primary"></i>
                {{ \Carbon\Carbon::parse($data->date)->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </span>
            <span class="text-muted fs-sm d-flex align-items-center gap-1">
                <i class="ti ti-clock text-primary"></i>
                {{ $data->start_time }} &ndash; {{ $data->end_time }} WIB
            </span>
            @if ($data->place)
                <span class="text-muted fs-sm d-flex align-items-center gap-1">
                    <i class="ti ti-map-pin text-danger"></i>
                    {{ $data->place }}
                </span>
            @endif
        </div>
    </div>

    {{-- ===================== BANNER DITOLAK ===================== --}}
    @if ($data->status == 'REJECTED' && isset($data->rejected_reason))
        <div class="card border-danger mb-4" style="border-width: 1.5px !important;">
            <div class="card-body p-4">
                <div class="d-flex align-items-start gap-3">
                    <div
                        class="avatar-md bg-danger-subtle rounded-circle d-flex align-items-center justify-content-center flex-shrink-0">
                        <i class="ti ti-x text-danger fs-xl"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-semibold mb-1 text-danger">Agenda Ini Ditolak</h6>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="fw-medium fs-sm text-body">{{ $data->approver->name ?? '-' }}</span>
                            <span class="text-muted fs-xs">
                                &bull;
                                {{ \Carbon\Carbon::parse($data->approved_at)->locale('id')->isoFormat('D MMMM Y, HH:mm') }}
                                WIB
                            </span>
                        </div>
                        <div
                            class="py-2 px-3 bg-danger-subtle rounded-2 fs-sm text-danger border-start border-3 border-danger">
                            {{ $data->rejected_reason }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ===================== MAIN LAYOUT ===================== --}}
    <div class="row g-4">

        {{-- ===================== KOLOM KIRI ===================== --}}
        <div class="col-xl-8">

            {{-- ---- DESKRIPSI ---- --}}
            <div class="card mb-4">
                <div class="card-body p-4">
                    <h5 class="fs-sm fw-semibold text-muted text-uppercase mb-3">
                        <i class="ti ti-align-left me-1"></i>Deskripsi Agenda
                    </h5>
                    <p class="text-body mb-0" style="line-height: 1.8;">
                        {{ $data->description ?? 'Tidak ada deskripsi.' }}
                    </p>
                </div>
            </div>

            {{-- ---- DOKUMENTASI ---- --}}
            @if ($data->status == 'APPROVED' || $data->status == 'COMPLETED')
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between p-4 pb-3">
                        <h5 class="fs-sm fw-semibold text-muted text-uppercase mb-0">
                            <i class="ti ti-photo me-1"></i>Dokumentasi
                            @if ($data->documentations->count() > 0)
                                <span
                                    class="badge bg-primary-subtle text-primary ms-1">{{ $data->documentations->count() }}</span>
                            @endif
                        </h5>

                        {{-- @if ($data->status == 'COMPLETED')
                            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse"
                                data-bs-target="#upload-panel" aria-expanded="false">
                                <i class="ti ti-upload me-1"></i>Upload Dokumentasi
                            </button>
                        @endif --}}
                    </div>

                    {{-- Panel Upload (hanya status COMPLETED) --}}
                    @if ($data->status == 'COMPLETED')
                        <div class="collapse" id="upload-panel">
                            <div class="card-body px-4 pt-0 pb-4 border-top border-dashed">

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible d-flex align-items-center gap-2 mt-3 mb-3"
                                        role="alert">
                                        <i class="ti ti-alert-circle fs-xl flex-shrink-0"></i>
                                        <div class="flex-grow-1">
                                            <strong>Gagal upload:</strong> {{ $errors->first() }}
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <form action="{{ route('staff.data-agenda.upload', $data->id) }}" method="POST"
                                    enctype="multipart/form-data" id="upload-form" class="mt-3">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold fs-sm">
                                                <i class="ti ti-photo me-1 text-primary"></i>Foto Dokumentasi
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div id="drop-zone"
                                                class="border border-dashed rounded-3 p-4 text-center position-relative"
                                                style="cursor: pointer; min-height: 180px; display: flex; align-items: center; justify-content: center; flex-direction: column;"
                                                onclick="document.getElementById('file-input').click()">
                                                <input type="file" id="file-input" name="file" accept="image/*"
                                                    class="d-none" onchange="handleFileSelect(this)">
                                                <div id="drop-placeholder">
                                                    <i class="ti ti-cloud-upload fs-2xl text-muted mb-2 d-block"></i>
                                                    <p class="fw-medium text-muted mb-1 fs-sm">Klik atau seret foto ke
                                                        sini</p>
                                                    <p class="text-muted fs-xs mb-0">JPG, PNG, WEBP &bull; Maks. 5MB</p>
                                                </div>
                                                <div id="drop-preview" class="d-none">
                                                    <img id="img-preview" src="" alt="preview"
                                                        class="rounded-2 mb-2"
                                                        style="max-height: 140px; max-width: 100%; object-fit: contain;">
                                                    <p id="file-name" class="fs-xs text-muted mb-0"></p>
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger-subtle text-danger mt-2"
                                                        onclick="clearFile(event)">
                                                        <i class="ti ti-trash me-1"></i>Ganti Foto
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-flex flex-column">
                                            <label class="form-label fw-semibold fs-sm">
                                                <i class="ti ti-message me-1 text-primary"></i>Caption
                                                <span class="text-muted fw-normal">(Opsional)</span>
                                            </label>
                                            <textarea class="form-control flex-grow-1" name="caption" rows="4"
                                                placeholder="Tulis keterangan singkat tentang foto ini..." style="resize: none;">{{ old('caption') }}</textarea>
                                            <div class="d-flex justify-content-end gap-2 mt-3">
                                                <button type="button" class="btn btn-light btn-sm"
                                                    onclick="clearFile(null, true); document.querySelector('textarea[name=caption]').value = ''">
                                                    <i class="ti ti-x me-1"></i>Reset
                                                </button>
                                                <button type="submit" class="btn btn-primary btn-sm" id="submit-btn"
                                                    disabled>
                                                    <i class="ti ti-send-2 me-1"></i>Kirim Dokumentasi
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    {{-- Daftar Dokumentasi --}}
                    <div class="card-body px-4 pt-3">
                        @forelse ($data->documentations->sortByDesc('uploaded_at') as $dt)
                            <div class="d-flex gap-3 py-3 {{ !$loop->last ? 'border-bottom border-dashed' : '' }}">

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
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <div>
                                            <span
                                                class="fw-semibold text-body fs-sm">{{ $dt->uploader->name ?? '-' }}</span>
                                            @if (isset($dt->uploader) && $dt->uploader->id == Auth::id())
                                                <span
                                                    class="badge bg-secondary-subtle text-secondary ms-1 fs-xxs">Anda</span>
                                            @endif
                                            <span class="text-muted fs-xs ms-1">menambahkan dokumentasi</span>
                                        </div>
                                        <span class="text-muted fs-xs text-nowrap">
                                            {{ \Carbon\Carbon::parse($dt->uploaded_at)->locale('id')->diffForHumans() }}
                                        </span>
                                    </div>

                                    @if ($dt->caption)
                                        <div
                                            class="py-2 px-3 bg-light bg-opacity-50 rounded-2 mb-2 fs-sm fst-italic text-muted border-start border-3 border-primary">
                                            "{{ $dt->caption }}"
                                        </div>
                                    @endif

                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        <a href="{{ asset('storage/' . $dt->filepath) }}" target="_blank"
                                            class="d-block">
                                            <img src="{{ asset('storage/' . $dt->filepath) }}" alt="preview"
                                                class="rounded-2 border"
                                                style="width: 64px; height: 64px; object-fit: cover;"
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
                                <p class="text-muted fs-sm mb-0">Dokumentasi akan muncul setelah diupload.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif

        </div>
        {{-- end col-xl-8 --}}

        {{-- ===================== KOLOM KANAN (SIDEBAR) ===================== --}}
        <div class="col-xl-4">

            {{-- ---- INFO AGENDA ---- --}}
            <div class="card mb-4">
                <div class="card-body p-4">
                    <h5 class="fs-sm fw-semibold text-muted text-uppercase mb-3">Info Agenda</h5>
                    <div class="d-flex flex-column gap-3">

                        <div class="d-flex align-items-start gap-2">
                            <div class="flex-shrink-0 mt-1"><i class="ti ti-user fs-sm text-muted"></i></div>
                            <div>
                                <p class="text-muted fs-xs mb-0">Dibuat Oleh</p>
                                <p class="fw-medium mb-0 fs-sm">{{ $data->creator->name ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-2">
                            <div class="flex-shrink-0 mt-1"><i class="ti ti-calendar-plus fs-sm text-muted"></i></div>
                            <div>
                                <p class="text-muted fs-xs mb-0">Dibuat Pada</p>
                                <p class="fw-medium mb-0 fs-sm">
                                    {{ $data->created_at ? \Carbon\Carbon::parse($data->created_at)->locale('id')->isoFormat('D MMMM Y, HH:mm') : '-' }}
                                    WIB
                                </p>
                            </div>
                        </div>

                        @if ($data->approver)
                            <div class="d-flex align-items-start gap-2">
                                <div class="flex-shrink-0 mt-1">
                                    @if ($data->status == 'REJECTED')
                                        <i class="ti ti-user-x fs-sm text-danger"></i>
                                    @else
                                        <i class="ti ti-user-check fs-sm text-success"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-muted fs-xs mb-0">
                                        {{ $data->status == 'REJECTED' ? 'Ditolak Oleh' : 'Disetujui Oleh' }}
                                    </p>
                                    <p class="fw-medium mb-0 fs-sm">{{ $data->approver->name ?? '-' }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($data->place)
                            <div class="d-flex align-items-start gap-2">
                                <div class="flex-shrink-0 mt-1"><i class="ti ti-map-pin fs-sm text-muted"></i></div>
                                <div>
                                    <p class="text-muted fs-xs mb-0">Lokasi</p>
                                    <p class="fw-medium mb-0 fs-sm">{{ $data->place }}</p>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            {{-- ---- STATISTIK ---- --}}
            <div class="row g-3 mb-4">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <h3 class="mb-0 fw-bold text-primary">{{ $data->documentations->count() }}</h3>
                            <p class="mb-0 fs-xs text-muted mt-1">Dokumentasi</p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <h3 class="mb-0 fw-bold text-success">{{ $data->attachments->count() }}</h3>
                            <p class="mb-0 fs-xs text-muted mt-1">Lampiran</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ---- LAMPIRAN ---- --}}
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="fs-sm fw-semibold text-muted text-uppercase mb-3">
                        <i class="ti ti-paperclip me-1"></i>Lampiran
                    </h5>

                    @forelse ($data->attachments as $dt)
                        <div
                            class="d-flex justify-content-between align-items-center py-2 {{ !$loop->last ? 'border-bottom border-dashed' : '' }}">
                            <div class="d-flex align-items-center gap-2 overflow-hidden">
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
                                <div class="overflow-hidden">
                                    <h6 class="mb-0 fs-xs fw-medium text-truncate" style="max-width: 140px;"
                                        title="{{ $dt->filename ?? '-' }}">
                                        <a href="{{ asset('storage/' . $dt->filepath) }}" class="link-reset"
                                            target="_blank">
                                            {{ $dt->filename ?? '-' }}
                                        </a>
                                    </h6>
                                    <p class="text-muted mb-0 fs-xxs">
                                        {{ number_format($dt->file_size / 1048576, 1) }} MB
                                    </p>
                                </div>
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
        {{-- end col-xl-4 --}}

    </div>
    {{-- end row --}}

@endsection

@push('styles')
    <style>
        .agenda-hero {
            padding: 0.5rem 0 1rem;
        }

        #drop-zone:hover {
            border-color: var(--bs-primary) !important;
            background-color: rgba(var(--bs-primary-rgb), 0.03);
        }

        #drop-zone.dragover {
            border-color: var(--bs-primary) !important;
            background-color: rgba(var(--bs-primary-rgb), 0.06);
        }

        .border-3 {
            border-width: 3px !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ── Auto-buka panel upload jika ada error validasi ──
            @if ($errors->any())
                var uploadPanel = document.getElementById('upload-panel');
                if (uploadPanel) {
                    new bootstrap.Collapse(uploadPanel, {
                        show: true
                    });
                    uploadPanel.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            @endif

            // ── Drag-and-drop drop zone ──
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

        // ── Preview gambar setelah dipilih ──
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
                document.getElementById('file-name').textContent =
                    file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                document.getElementById('drop-placeholder').classList.add('d-none');
                document.getElementById('drop-preview').classList.remove('d-none');
                document.getElementById('submit-btn').disabled = false;
            };
            reader.readAsDataURL(file);
        }

        // ── Reset / ganti foto ──
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
