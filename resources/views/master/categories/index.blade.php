@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('page-title')
    <div class="page-title-head d-flex align-items-center">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Daftar Kategori</h4>
        </div>
        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                <li class="breadcrumb-item active">Daftar Kategori</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div data-table data-table-rows-per-page="8" class="card">
                <div class="card-header border-light justify-content-between">
                    <div class="d-flex gap-2">
                        <div class="app-search">
                            <input data-table-search type="search" class="form-control" placeholder="Search kategori..." />
                            <i class="ti ti-search app-search-icon text-muted"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="me-2 fw-semibold">Show:</span>
                        <div>
                            <select data-table-set-rows-per-page class="form-select form-control my-1 my-md-0">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addKategoriModal"
                            class="btn btn-secondary">
                            <i class="ti ti-plus fs-sm me-1"></i> Tambah Kategori
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom table-centered table-hover w-100 mb-0">
                        <thead class="bg-light align-middle bg-opacity-25 thead-sm">
                            <tr class="text-uppercase fs-xxs">
                                <th data-table-sort>Nama Kategori</th>
                                <th data-table-sort>Deskripsi</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataKategori as $data)
                                <tr>
                                    <td>
                                        <h5 class="fs-base mb-0">
                                            <a href="#" class="link-reset">{{ $data->name ?? '-' }}</a>
                                        </h5>
                                    </td>
                                    <td class="text-muted">{{ $data->description ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            {{-- Tombol Edit --}}
                                            <button type="button" class="btn btn-default btn-icon btn-sm btn-edit-kategori"
                                                data-id="{{ $data->id }}" data-name="{{ $data->name }}"
                                                data-description="{{ $data->description }}"
                                                data-url="{{ route('admin.data-kategori.update', $data->id) }}"
                                                title="Edit">
                                                <i class="ti ti-edit fs-lg"></i>
                                            </button>

                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('admin.data-kategori.destroy', $data->id) }}"
                                                method="POST" class="d-inline form-delete-kategori">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="btn btn-default btn-icon btn-sm btn-delete-kategori"
                                                    title="Hapus">
                                                    <i class="ti ti-trash fs-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada kategori.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div data-table-pagination-info="Kategori"></div>
                        <div data-table-pagination></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL TAMBAH KATEGORI --}}
    {{-- ============================================================ --}}
    <div class="modal fade" id="addKategoriModal" tabindex="-1" aria-labelledby="addKategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addKategoriModalLabel">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.data-kategori.store') }}" method="POST" id="addKategoriForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="add_name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    placeholder="Masukkan nama kategori" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback" id="add_name_feedback"></div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi <span
                                        class="text-muted fw-normal">(opsional)</span></label>
                                <textarea name="description" id="add_description" rows="3"
                                    class="form-control @error('description') is-invalid @enderror" placeholder="Masukkan deskripsi kategori">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback" id="add_desc_feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="addKategoriSubmit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL EDIT KATEGORI --}}
    {{-- ============================================================ --}}
    <div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editKategoriForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="edit_kat_name" class="form-control"
                                    placeholder="Masukkan nama kategori" required>
                                <div class="invalid-feedback" id="edit_kat_name_feedback"></div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi <span
                                        class="text-muted fw-normal">(opsional)</span></label>
                                <textarea name="description" id="edit_kat_description" rows="3" class="form-control"
                                    placeholder="Masukkan deskripsi kategori"></textarea>
                                <div class="invalid-feedback" id="edit_kat_desc_feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="editKategoriSubmit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('addKategoriModal'));
                myModal.show();
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ── Helper validasi ───────────────────────────────────────────
            function fieldOk(el, fbId, msg) {
                el.classList.remove('is-invalid');
                el.classList.add('is-valid');
                if (fbId) {
                    const fb = document.getElementById(fbId);
                    fb.style.color = '#12b76a';
                    fb.textContent = '✓ ' + msg;
                }
            }

            function fieldErr(el, fbId, msg) {
                el.classList.remove('is-valid');
                el.classList.add('is-invalid');
                if (fbId) {
                    const fb = document.getElementById(fbId);
                    fb.style.color = '#dc3545';
                    fb.textContent = msg;
                }
            }

            function fieldClear(el, fbId) {
                el.classList.remove('is-valid', 'is-invalid');
                if (fbId) {
                    const fb = document.getElementById(fbId);
                    fb.textContent = '';
                }
            }

            // ── VALIDASI MODAL TAMBAH ─────────────────────────────────────
            const addNameEl = document.getElementById('add_name');
            const addDescEl = document.getElementById('add_description');
            const addSubmit = document.getElementById('addKategoriSubmit');

            function vAddName() {
                const v = addNameEl.value.trim();
                if (!v) {
                    fieldErr(addNameEl, 'add_name_feedback', 'Nama kategori wajib diisi.');
                    return false;
                }
                if (v.length < 2) {
                    fieldErr(addNameEl, 'add_name_feedback', 'Nama minimal 2 karakter.');
                    return false;
                }
                if (v.length > 255) {
                    fieldErr(addNameEl, 'add_name_feedback', 'Nama maksimal 255 karakter.');
                    return false;
                }
                fieldOk(addNameEl, 'add_name_feedback', 'Nama valid');
                return true;
            }

            function vAddDesc() {
                const v = addDescEl.value.trim();
                if (v.length > 500) {
                    fieldErr(addDescEl, 'add_desc_feedback', 'Deskripsi maksimal 500 karakter.');
                    return false;
                }
                if (v) fieldOk(addDescEl, 'add_desc_feedback', 'Deskripsi valid');
                else fieldClear(addDescEl, 'add_desc_feedback');
                return true;
            }

            function checkAdd() {
                addSubmit.disabled = ![vAddName(), vAddDesc()].every(Boolean);
            }

            addNameEl.addEventListener('input', function() {
                vAddName();
                checkAdd();
            });
            addDescEl.addEventListener('input', function() {
                vAddDesc();
                checkAdd();
            });

            // Reset saat modal tambah ditutup
            const addModalEl = document.getElementById('addKategoriModal');
            addModalEl.addEventListener('hidden.bs.modal', function() {
                document.getElementById('addKategoriForm').reset();
                [addNameEl, addDescEl].forEach(function(el) {
                    el.classList.remove('is-valid', 'is-invalid');
                });
                ['add_name_feedback', 'add_desc_feedback'].forEach(function(id) {
                    document.getElementById(id).textContent = '';
                });
                addSubmit.disabled = false;
            });
            // Bersihkan backdrop
            addModalEl.addEventListener('hidden.bs.modal', function() {
                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('overflow');
                document.body.style.removeProperty('padding-right');
                const bd = document.querySelector('.modal-backdrop');
                if (bd) bd.remove();
            });

            // ── TOMBOL EDIT KATEGORI ──────────────────────────────────────
            const editKatModalEl = document.getElementById('editKategoriModal');
            const editKatModalInstance = new bootstrap.Modal(editKatModalEl);
            const editKatNameEl = document.getElementById('edit_kat_name');
            const editKatDescEl = document.getElementById('edit_kat_description');
            const editKatSubmit = document.getElementById('editKategoriSubmit');

            document.querySelectorAll('.btn-edit-kategori').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const form = document.getElementById('editKategoriForm');
                    form.action = this.dataset.url;

                    editKatNameEl.value = this.dataset.name;
                    editKatDescEl.value = this.dataset.description !== 'undefined' ? this.dataset
                        .description : '';

                    // Reset validasi
                    [editKatNameEl, editKatDescEl].forEach(function(el) {
                        el.classList.remove('is-valid', 'is-invalid');
                    });
                    ['edit_kat_name_feedback', 'edit_kat_desc_feedback'].forEach(function(id) {
                        document.getElementById(id).textContent = '';
                    });

                    editKatSubmit.disabled = false;
                    editKatModalInstance.show();
                });
            });

            // Bersihkan backdrop saat modal edit ditutup
            editKatModalEl.addEventListener('hidden.bs.modal', function() {
                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('overflow');
                document.body.style.removeProperty('padding-right');
                const bd = document.querySelector('.modal-backdrop');
                if (bd) bd.remove();
            });

            // ── VALIDASI REALTIME MODAL EDIT KATEGORI ────────────────────
            function vEditKatName() {
                const v = editKatNameEl.value.trim();
                if (!v) {
                    fieldErr(editKatNameEl, 'edit_kat_name_feedback', 'Nama kategori wajib diisi.');
                    return false;
                }
                if (v.length < 2) {
                    fieldErr(editKatNameEl, 'edit_kat_name_feedback', 'Nama minimal 2 karakter.');
                    return false;
                }
                if (v.length > 255) {
                    fieldErr(editKatNameEl, 'edit_kat_name_feedback', 'Nama maksimal 255 karakter.');
                    return false;
                }
                fieldOk(editKatNameEl, 'edit_kat_name_feedback', 'Nama valid');
                return true;
            }

            function vEditKatDesc() {
                const v = editKatDescEl.value.trim();
                if (v.length > 500) {
                    fieldErr(editKatDescEl, 'edit_kat_desc_feedback', 'Deskripsi maksimal 500 karakter.');
                    return false;
                }
                if (v) fieldOk(editKatDescEl, 'edit_kat_desc_feedback', 'Deskripsi valid');
                else fieldClear(editKatDescEl, 'edit_kat_desc_feedback');
                return true;
            }

            function checkEditKat() {
                editKatSubmit.disabled = ![vEditKatName(), vEditKatDesc()].every(Boolean);
            }

            editKatNameEl.addEventListener('input', function() {
                vEditKatName();
                checkEditKat();
            });
            editKatDescEl.addEventListener('input', function() {
                vEditKatDesc();
                checkEditKat();
            });

            // ── KONFIRMASI HAPUS KATEGORI ─────────────────────────────────
            document.querySelectorAll('.btn-delete-kategori').forEach(function(button) {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Hapus Kategori?',
                        text: 'Data kategori yang dihapus tidak dapat dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6e7d88',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then(function(result) {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });

        });
    </script>
@endpush
