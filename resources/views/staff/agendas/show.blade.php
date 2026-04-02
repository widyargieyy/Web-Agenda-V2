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
            <div class="row g-0">

                {{-- ===================== MAIN CONTENT ===================== --}}
                <div class="col-xl-9">
                    <div class="card card-h-100 rounded-0 rounded-start border-end border-dashed">

                        {{-- ---- CARD HEADER ---- --}}
                        <div class="card-header align-items-start p-4 pb-3">
                            <div class="w-100 mb-3">
                                <a href="{{ route('staff.data-agenda') }}" class="btn btn-sm btn-light">
                                    <i class="ti ti-arrow-left me-1"></i>Kembali ke Data Agenda
                                </a>
                            </div>
                            <div class="flex-grow-1">

                                {{-- Status Badge --}}
                                <div class="mb-2">
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

                                {{-- Title --}}
                                <h3 class="mb-1 fw-semibold">{{ $data->title ?? '-' }}</h3>

                                {{-- Date & Time --}}
                                <div class="d-flex flex-wrap gap-3 mt-2">
                                    <span class="text-muted fs-xs d-flex align-items-center gap-1">
                                        <i class="ti ti-calendar fs-sm text-primary"></i>
                                        {{ \Carbon\Carbon::parse($data->date)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                    </span>
                                    <span class="text-muted fs-xs d-flex align-items-center gap-1">
                                        <i class="ti ti-clock fs-sm text-primary"></i>
                                        {{ $data->start_time . ' WIB' }} &ndash; {{ $data->end_time . ' WIB' }}
                                    </span>
                                    @if ($data->place)
                                        <span class="text-muted fs-xs d-flex align-items-center gap-1">
                                            <i class="ti ti-map-pin fs-sm text-danger"></i>
                                            {{ $data->place }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- ---- END CARD HEADER ---- --}}

                        <div class="card-body px-4 pt-3">

                            {{-- ---- META INFO GRID ---- --}}
                            <div class="row g-3 mb-4 p-3 bg-light bg-opacity-50 rounded-2">
                                <div class="col-6 col-md-3">
                                    <p class="text-muted fs-xs text-uppercase mb-1 fw-semibold">Dibuat Pada</p>
                                    <p class="fw-medium mb-0 fs-sm">
                                        {{ $data->created_at ? \Carbon\Carbon::parse($data->created_at)->locale('id')->isoFormat('D MMM Y') : '-' }}
                                    </p>
                                </div>
                                <div class="col-6 col-md-3">
                                    <p class="text-muted fs-xs text-uppercase mb-1 fw-semibold">Lokasi</p>
                                    <p class="fw-medium mb-0 fs-sm text-danger">{{ $data->place ?? '-' }}</p>
                                </div>
                                <div class="col-6 col-md-3">
                                    <p class="text-muted fs-xs text-uppercase mb-1 fw-semibold">Dibuat Oleh</p>
                                    <p class="fw-medium mb-0 fs-sm">{{ $data->creator->name ?? '-' }}</p>
                                </div>
                                <div class="col-6 col-md-3">
                                    <p class="text-muted fs-xs text-uppercase mb-1 fw-semibold">Disetujui Oleh</p>
                                    <p class="fw-medium mb-0 fs-sm">{{ $data->approver->name ?? '-' }}</p>
                                </div>
                            </div>

                            {{-- ---- DESCRIPTION ---- --}}
                            <div class="mb-4">
                                <h5 class="fs-base mb-2 fw-semibold">
                                    <i class="ti ti-align-left me-1 text-muted"></i>Deskripsi Agenda
                                </h5>
                                <p class="text-muted mb-0" style="line-height: 1.7;">
                                    {{ $data->description ?? 'Tidak ada deskripsi.' }}</p>
                            </div>

                            <hr class="border-dashed my-4">

                            {{-- ---- TABS ---- --}}
                            <ul class="nav nav-tabs nav-bordered mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tab-dokumentasi" role="tab">
                                        <i class="ti ti-photo fs-lg me-md-1 align-middle"></i>
                                        <span class="d-none d-md-inline-block align-middle">
                                            Dokumentasi
                                            @if ($data->documentations->count() > 0)
                                                <span
                                                    class="badge bg-primary-subtle text-primary ms-1">{{ $data->documentations->count() }}</span>
                                            @endif
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tab-upload" role="tab">
                                        <i class="ti ti-upload fs-lg me-md-1 align-middle"></i>
                                        <span class="d-none d-md-inline-block align-middle">Upload Dokumentasi</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">

                                {{-- ========== TAB: DOKUMENTASI TERUPLOAD ========== --}}
                                <div class="tab-pane fade active show" id="tab-dokumentasi" role="tabpanel">

                                    @forelse ($data->documentations->sortByDesc('uploaded_at') as $dt)
                                        <div class="d-flex gap-3 border-bottom border-dashed py-3">

                                            {{-- Avatar Inisial --}}
                                            <div class="flex-shrink-0">
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
                                                <div
                                                    class="avatar-md rounded-circle {{ $colorClass }} d-flex align-items-center justify-content-center fw-bold fs-sm">
                                                    {{ $initials }}
                                                </div>
                                            </div>

                                            <div class="flex-grow-1">
                                                {{-- Uploader name + waktu --}}
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

                                                {{-- Caption --}}
                                                @if ($dt->caption)
                                                    <div
                                                        class="py-2 px-3 bg-light bg-opacity-50 rounded-2 mb-2 fs-sm fst-italic text-muted border-start border-3 border-primary">
                                                        "{{ $dt->caption }}"
                                                    </div>
                                                @endif

                                                {{-- Thumbnail Preview + Tombol Lihat --}}
                                                <div class="d-flex align-items-center gap-2 mt-2">
                                                    {{-- Thumbnail kecil --}}
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
                                        {{-- Empty State --}}
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
                                {{-- ========== END TAB DOKUMENTASI ========== --}}

                                {{-- ========== TAB: UPLOAD ========== --}}
                                <div class="tab-pane fade" id="tab-upload" role="tabpanel">

                                    @if ($data->status == 'COMPLETED')

                                        {{-- Alert Error --}}
                                        @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible d-flex align-items-center gap-2 mb-3"
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

                                            {{-- Upload Area --}}
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold fs-sm">
                                                    <i class="ti ti-photo me-1 text-primary"></i>Pilih Foto Dokumentasi
                                                    <span class="text-danger">*</span>
                                                </label>

                                                {{-- Drop Zone --}}
                                                <div id="drop-zone"
                                                    class="border border-dashed rounded-3 p-4 text-center position-relative"
                                                    style="cursor: pointer; transition: all 0.2s ease; border-color: var(--bs-border-color) !important;"
                                                    onclick="document.getElementById('file-input').click()">
                                                    <input type="file" id="file-input" name="file"
                                                        accept="image/*" class="d-none"
                                                        onchange="handleFileSelect(this)">

                                                    {{-- Default state --}}
                                                    <div id="drop-placeholder">
                                                        <i class="ti ti-cloud-upload fs-2xl text-muted mb-2 d-block"></i>
                                                        <p class="fw-medium text-muted mb-1 fs-sm">Klik untuk pilih foto
                                                        </p>
                                                        <p class="text-muted fs-xs mb-0">JPG, PNG, WEBP &bull; Maks. 5MB
                                                        </p>
                                                    </div>

                                                    {{-- Preview state (hidden by default) --}}
                                                    <div id="drop-preview" class="d-none">
                                                        <img id="img-preview" src="" alt="preview"
                                                            class="rounded-2 mb-2"
                                                            style="max-height: 200px; max-width: 100%; object-fit: contain;">
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
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold fs-sm">
                                                    <i class="ti ti-message me-1 text-primary"></i>Caption
                                                    <span class="text-muted fw-normal">(Opsional)</span>
                                                </label>
                                                <textarea class="form-control" name="caption" rows="3"
                                                    placeholder="Tulis keterangan singkat tentang foto ini..." style="resize: none;">{{ old('caption') }}</textarea>
                                            </div>

                                            {{-- Submit --}}
                                            <div class="d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-light btn-sm"
                                                    onclick="clearFile(event); document.querySelector('textarea[name=caption]').value = ''">
                                                    <i class="ti ti-x me-1"></i>Reset
                                                </button>
                                                <button type="submit" class="btn btn-primary btn-sm" id="submit-btn"
                                                    disabled>
                                                    <i class="ti ti-send-2 me-1"></i>Kirim Dokumentasi
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        {{-- Blocked State --}}
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
                                {{-- ========== END TAB UPLOAD ========== --}}

                            </div>
                            {{-- end tab-content --}}

                        </div>
                        {{-- end card-body --}}
                    </div>
                    {{-- end card --}}
                </div>
                {{-- end col-xl-9 --}}

                {{-- ===================== SIDEBAR ===================== --}}
                <div class="col-xl-3">
                    <div class="card card-h-100 rounded-0 rounded-end border-start border-dashed shadow-none">
                        <div class="card-body p-0">

                            {{-- ---- STATISTIK DOKUMENTASI ---- --}}
                            <div class="px-3 pt-3 pb-3 border-bottom border-dashed">
                                <h5 class="mb-3 fs-sm fw-semibold text-muted text-uppercase">Ringkasan</h5>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="p-2 bg-primary-subtle rounded-2 text-center">
                                            <h4 class="mb-0 text-primary fw-bold">{{ $data->documentations->count() }}
                                            </h4>
                                            <p class="mb-0 fs-xs text-muted">Dokumentasi</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-2 bg-success-subtle rounded-2 text-center">
                                            <h4 class="mb-0 text-success fw-bold">{{ $data->attachments->count() }}</h4>
                                            <p class="mb-0 fs-xs text-muted">Lampiran</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ---- LAMPIRAN ---- --}}
                            <div class="px-3 pt-3">
                                <h5 class="mb-3 fs-sm fw-semibold text-muted text-uppercase">
                                    <i class="ti ti-paperclip me-1"></i>Lampiran
                                </h5>

                                @forelse ($data->attachments as $dt)
                                    <div
                                        class="d-flex justify-content-between align-items-center py-2 border-bottom border-dashed">
                                        <div class="d-flex align-items-center gap-2 overflow-hidden">
                                            {{-- Icon berdasarkan ekstensi --}}
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
                                                <h6 class="mb-0 fs-xs fw-medium text-truncate" style="max-width: 120px;"
                                                    title="{{ $dt->filename ?? '-' }}">
                                                    <a href="{{ asset('storage/' . $dt->filepath) }}" class="link-reset"
                                                        target="_blank">{{ $dt->filename ?? '-' }}</a>
                                                </h6>
                                                <p class="text-muted mb-0 fs-xxs">{{ $dt->file_size ?? '-' }} MB</p>
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
                        {{-- end card-body --}}
                    </div>
                    {{-- end card --}}
                </div>
                {{-- end col-xl-3 --}}

            </div>
            {{-- end row g-0 --}}
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Drop Zone hover effect */
        #drop-zone:hover {
            border-color: var(--bs-primary) !important;
            background-color: rgba(var(--bs-primary-rgb), 0.03);
        }

        #drop-zone.dragover {
            border-color: var(--bs-primary) !important;
            background-color: rgba(var(--bs-primary-rgb), 0.06);
        }

        /* Caption border-start accent */
        .border-3 {
            border-width: 3px !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ── Auto-switch ke tab upload jika ada error validasi ──
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

            // ── Drag-and-drop untuk drop zone ──
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

            // Validasi tipe
            if (!file.type.startsWith('image/')) {
                alert('Hanya file gambar yang diperbolehkan (JPG, PNG, WEBP).');
                clearFile(null, true);
                return;
            }

            // Validasi ukuran (5MB)
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

        // ── Reset/ganti foto ──
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
