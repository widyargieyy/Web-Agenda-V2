@extends('layouts.app')

@section('title', 'Buat Agenda')

@section('page-title')
    <div class="page-title-head d-flex align-items-center">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Edit Agenda</h4>
        </div>
        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('operator.agenda-saya.index') }}">Data Agenda</a></li>
                <li class="breadcrumb-item active">Buat Agenda</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-xxl-9">

            {{-- Alert Error --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible d-flex align-items-center gap-2 mb-4" role="alert">
                    <i class="ti ti-alert-circle fs-xl flex-shrink-0"></i>
                    <div class="flex-grow-1">
                        <strong>Gagal menyimpan:</strong> {{ $errors->first() }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('operator.agenda-saya.update', $data->id) }}" method="POST"
                enctype="multipart/form-data" id="agenda-form">
                @csrf
                @method('PUT')

                {{-- ===== SECTION 1: INFO AGENDA ===== --}}
                <div class="card border-0 mb-3">
                    <div class="card-header border-bottom border-dashed py-3 d-flex align-items-center gap-2">
                        <div
                            class="avatar-sm bg-primary-subtle rounded-2 d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-info-circle text-primary"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Informasi Agenda</h5>
                            <p class="text-muted fs-xs mb-0">Isi detail informasi agenda</p>
                        </div>
                    </div>
                    <div class="card-body pt-4">

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium fs-sm">
                                Judul Agenda <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                placeholder="Contoh: Rapat Koordinasi Bulanan" value="{{ old('title', $data->title) }}"
                                required />
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium fs-sm">
                                Deskripsi
                                <span class="text-muted fw-normal">(Opsional)</span>
                            </label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4"
                                placeholder="Tuliskan deskripsi singkat agenda ini..." style="resize: none;">{{ old('description', $data->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kategori & Lokasi --}}
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium fs-sm">Kategori<span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    @foreach ($dataKategori as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('category_id', $data->category_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium fs-sm">
                                    Lokasi <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="place"
                                    class="form-control @error('place') is-invalid @enderror"
                                    placeholder="Contoh: Aula Gedung A" value="{{ old('place', $data->place) }}"
                                    required />
                                @error('place')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ===== SECTION 2: JADWAL ===== --}}
                <div class="card border-0 mb-3">
                    <div class="card-header border-bottom border-dashed py-3 d-flex align-items-center gap-2">
                        <div
                            class="avatar-sm bg-warning-subtle rounded-2 d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-calendar-event text-warning"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Jadwal Agenda</h5>
                            <p class="text-muted fs-xs mb-0">Tentukan tanggal dan waktu pelaksanaan</p>
                        </div>
                    </div>
                    <div class="card-body pt-4">

                        <div class="row g-3">
                            {{-- Tanggal --}}
                            <div class="col-md-4">
                                <label class="form-label fw-medium fs-sm">
                                    Tanggal Kegiatan <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="date" data-provider="flatpickr" data-date-format="Y-m-d"
                                    class="form-control @error('date') is-invalid @enderror" placeholder="Pilih tanggal..."
                                    value="{{ old('date', $data->date) }}" required />
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jam Mulai --}}
                            <div class="col-md-4">
                                <label class="form-label fw-medium fs-sm">
                                    Jam Mulai <span class="text-danger">*</span>
                                </label>
                                <input type="time" name="start_time"
                                    class="form-control @error('start_time') is-invalid @enderror"
                                    value="{{ old('start_time', $data->start_time) }}" required />
                                @error('start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jam Selesai --}}
                            <div class="col-md-4">
                                <label class="form-label fw-medium fs-sm">
                                    Jam Selesai <span class="text-danger">*</span>
                                </label>
                                <input type="time" name="end_time"
                                    class="form-control @error('end_time') is-invalid @enderror"
                                    value="{{ old('end_time', $data->end_time) }}" required />
                                @error('end_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ===== SECTION 3: LAMPIRAN ===== --}}
                <div class="card border-0 mb-4">
                    <div class="card-header border-bottom border-dashed py-3 d-flex align-items-center gap-2">
                        <div
                            class="avatar-sm bg-success-subtle rounded-2 d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-paperclip text-success"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Lampiran</h5>
                            <p class="text-muted fs-xs mb-0">
                                Upload file PDF
                            </p>
                        </div>
                    </div>
                    <div class="card-body pt-4">
                        {{-- Input file asli — dikelola Filepond --}}
                        <input class="form-control" name="attachments[]" type="file" id="formFileMultiple01" multiple
                            accept="application/pdf" />
                    </div>
                </div>

                {{-- ===== ACTION BUTTONS ===== --}}
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <a href="{{ route('operator.agenda-saya.index') }}" class="btn btn-light">
                        <i class="ti ti-arrow-left me-1"></i>Kembali
                    </a>
                    <div class="d-flex gap-2">
                        <button type="reset" class="btn btn-light" id="reset-btn">
                            <i class="ti ti-refresh me-1"></i>Reset
                        </button>
                        <button type="submit" name="action" value="draft" class="btn btn-success" id="btn-draft">
                            <i class="ti ti-device-floppy me-1"></i>Simpan Sebagai Draft
                        </button>
                        <button type="submit" name="action" value="submit" class="btn btn-primary" id="btn-submit">
                            <i class="ti ti-send me-1"></i>Kirim Ke Kabid
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
