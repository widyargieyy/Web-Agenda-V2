@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title')
    <div class="page-title-head d-flex align-items-center">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Daftar User</h4>
        </div>
        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                <li class="breadcrumb-item active">Daftar User</li>
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
                            <input data-table-search type="search" class="form-control" placeholder="Search users..." />
                            <i class="ti ti-search app-search-icon text-muted"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="me-2 fw-semibold">Filter By:</span>
                        <div class="app-search">
                            <select data-table-filter="roles" class="form-select form-control my-1 my-md-0">
                                <option value="All">Role</option>
                                @foreach ($dataRole as $data)
                                    <option value="{{ $data->name }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                            <i class="ti ti-user-hexagon app-search-icon text-muted"></i>
                        </div>
                        <div class="app-search">
                            <select data-table-filter="status" class="form-select form-control my-1 my-md-0">
                                <option value="All">Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                            <i class="ti ti-user-check app-search-icon text-muted"></i>
                        </div>
                        <div>
                            <select data-table-set-rows-per-page class="form-select form-control my-1 my-md-0">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addUserModal"
                            class="btn btn-secondary"><i class="ti ti-plus fs-sm me-2"></i>Add User</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom table-centered table-select table-hover w-100 mb-0">
                        <thead class="bg-light align-middle bg-opacity-25 thead-sm">
                            <tr class="text-uppercase fs-xxs">
                                <th data-table-sort="user">User</th>
                                <th data-table-sort data-column="roles">Role</th>
                                <th data-table-sort>Last Updated</th>
                                <th data-table-sort data-column="status">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataUser as $data)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            {{-- Avatar Inisial --}}
                                            <div class="avatar avatar-sm d-flex align-items-center justify-content-center rounded-circle bg-primary text-white fw-bold"
                                                style="width: 32px; height: 32px; font-size: 12px;">
                                                @php
                                                    $words = explode(' ', $data->name ?? 'U');
                                                    $initials = '';
                                                    foreach ($words as $key => $word) {
                                                        if ($key < 2) {
                                                            // Ambil maksimal 2 huruf (depan & belakang)
                                                            $initials .= strtoupper(substr($word, 0, 1));
                                                        }
                                                    }
                                                    echo $initials;
                                                @endphp
                                            </div>
                                            <div>
                                                <h5 class="fs-base mb-0">
                                                    <a data-sort="user" href="#"
                                                        class="link-reset">{{ $data->name ?? '-' }}</a>
                                                </h5>
                                                <p class="text-muted fs-xs mb-0">{{ $data->email ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $data->role->name ?? '-' }}</td>
                                    <td>
                                        {{ $data->updated_at ? \Carbon\Carbon::parse($data->updated_at)->locale('id')->isoFormat('D MMM, Y') : '-' }}
                                        <small class="text-muted">
                                            {{ $data->updated_at ? \Carbon\Carbon::parse($data->updated_at)->locale('id')->isoFormat('h:mm') : '-' }}
                                            WIB
                                        </small>
                                    </td>
                                    <td>
                                        @if ($data->is_active == 1)
                                            <span class="badge bg-success-subtle text-success badge-label">Aktif</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger badge-label">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            {{-- Tombol Edit --}}
                                            <button type="button" class="btn btn-default btn-icon btn-sm btn-edit"
                                                data-id="{{ $data->id }}" data-name="{{ $data->name }}"
                                                data-email="{{ $data->email }}" data-role="{{ $data->role_id }}"
                                                data-status="{{ $data->is_active }}"
                                                data-url="{{ route('admin.user-management.update', $data->id) }}"
                                                title="Edit">
                                                <i class="ti ti-edit fs-lg"></i>
                                            </button>

                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('admin.user-management.destroy', $data->id) }}"
                                                method="POST" class="d-inline form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-default btn-icon btn-sm btn-delete"
                                                    title="Hapus">
                                                    <i class="ti ti-trash fs-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div data-table-pagination-info="User"></div>
                        <div data-table-pagination></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL TAMBAH USER --}}
    {{-- ============================================================ --}}
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Tambah User Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.user-management.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <select name="role_id" class="form-select @error('role_id') is-invalid @enderror"
                                    required>
                                    <option value="">Pilih role</option>
                                    @foreach ($dataRole as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="is_active" class="form-select @error('is_active') is-invalid @enderror"
                                    required>
                                    <option value="">Pilih status</option>
                                    <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif
                                    </option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL EDIT USER --}}
    {{-- ============================================================ --}}
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                                <div class="invalid-feedback" id="edit_name_feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="edit_email" class="form-control" required>
                                <div class="invalid-feedback" id="edit_email_feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <select name="role_id" id="edit_role_id" class="form-select" required>
                                    <option value="">Pilih role</option>
                                    @foreach ($dataRole as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="edit_role_feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="is_active" id="edit_is_active" class="form-select" required>
                                    <option value="">Pilih status</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                <div class="invalid-feedback" id="edit_status_feedback"></div>
                            </div>
                            <div class="col-12">
                                <hr class="my-1">
                                <p class="text-muted fs-xs mb-2">
                                    <i class="ti ti-info-circle me-1"></i>
                                    Kosongkan field password jika tidak ingin mengubah password.
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password Baru <span
                                        class="text-muted fw-normal">(opsional)</span></label>
                                <input type="password" name="password" id="edit_password" class="form-control"
                                    placeholder="Kosongkan jika tidak diubah">
                                <div class="invalid-feedback" id="edit_password_feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" id="edit_password_confirmation"
                                    class="form-control" placeholder="Kosongkan jika tidak diubah">
                                <div class="invalid-feedback" id="edit_confirm_feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="editSubmitBtn">Simpan Perubahan</button>
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
                var myModal = new bootstrap.Modal(document.getElementById('addUserModal'));
                myModal.show();
            });
        </script>
    @endif

    <script src="{{ asset('assets/js/userForm.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ── TOMBOL EDIT ───────────────────────────────────────────────
            const editModalEl = document.getElementById('editUserModal');
            const editModalInstance = new bootstrap.Modal(editModalEl);

            document.querySelectorAll('.btn-edit').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const form = document.getElementById('editUserForm');

                    form.action = this.dataset.url;

                    document.getElementById('edit_name').value = this.dataset.name;
                    document.getElementById('edit_email').value = this.dataset.email;
                    document.getElementById('edit_role_id').value = this.dataset.role;
                    document.getElementById('edit_is_active').value = this.dataset.status;
                    document.getElementById('edit_password').value = '';
                    document.getElementById('edit_password_confirmation').value = '';

                    form.querySelectorAll('.form-control, .form-select').forEach(function(el) {
                        el.classList.remove('is-valid', 'is-invalid');
                    });
                    form.querySelectorAll('.invalid-feedback').forEach(function(el) {
                        el.textContent = '';
                        el.style.display = '';
                    });

                    editModalInstance.show();
                });
            });

            // Bersihkan backdrop saat edit modal ditutup
            editModalEl.addEventListener('hidden.bs.modal', function() {
                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('overflow');
                document.body.style.removeProperty('padding-right');
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) backdrop.remove();
            });

            // ── VALIDASI REALTIME MODAL EDIT ─────────────────────────────
            const editNameEl = document.getElementById('edit_name');
            const editEmailEl = document.getElementById('edit_email');
            const editRoleEl = document.getElementById('edit_role_id');
            const editStatEl = document.getElementById('edit_is_active');
            const editPwEl = document.getElementById('edit_password');
            const editPwcEl = document.getElementById('edit_password_confirmation');
            const editSubmit = document.getElementById('editSubmitBtn');

            function ev(inputEl, fb, msg) {
                inputEl.classList.remove('is-valid');
                inputEl.classList.add('is-invalid');
                document.getElementById(fb).style.color = '#dc3545';
                document.getElementById(fb).textContent = msg;
            }

            function ok(inputEl, fb, msg) {
                inputEl.classList.remove('is-invalid');
                inputEl.classList.add('is-valid');
                document.getElementById(fb).style.color = '#12b76a';
                document.getElementById(fb).textContent = '✓ ' + msg;
            }

            function vEditName() {
                const v = editNameEl.value.trim();
                if (!v) {
                    ev(editNameEl, 'edit_name_feedback', 'Nama wajib diisi.');
                    return false;
                }
                if (v.length < 3) {
                    ev(editNameEl, 'edit_name_feedback', 'Nama minimal 3 karakter.');
                    return false;
                }
                ok(editNameEl, 'edit_name_feedback', 'Nama valid');
                return true;
            }

            function vEditEmail() {
                const v = editEmailEl.value.trim();
                if (!v) {
                    ev(editEmailEl, 'edit_email_feedback', 'Email wajib diisi.');
                    return false;
                }
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)) {
                    ev(editEmailEl, 'edit_email_feedback', 'Format email tidak valid.');
                    return false;
                }
                ok(editEmailEl, 'edit_email_feedback', 'Email valid');
                return true;
            }

            function vEditRole() {
                if (!editRoleEl.value) {
                    ev(editRoleEl, 'edit_role_feedback', 'Role wajib dipilih.');
                    return false;
                }
                ok(editRoleEl, 'edit_role_feedback', 'Role dipilih');
                return true;
            }

            function vEditStatus() {
                if (editStatEl.value === '') {
                    ev(editStatEl, 'edit_status_feedback', 'Status wajib dipilih.');
                    return false;
                }
                ok(editStatEl, 'edit_status_feedback', 'Status dipilih');
                return true;
            }

            function vEditPassword() {
                const v = editPwEl.value;
                if (!v) {
                    editPwEl.classList.remove('is-valid', 'is-invalid');
                    document.getElementById('edit_password_feedback').textContent = '';
                    vEditConfirm();
                    return true;
                }
                if (v.length < 6) {
                    ev(editPwEl, 'edit_password_feedback', 'Password minimal 6 karakter.');
                    return false;
                }
                ok(editPwEl, 'edit_password_feedback', 'Password valid');
                vEditConfirm();
                return true;
            }

            function vEditConfirm() {
                const v = editPwcEl.value;
                const pw = editPwEl.value;
                if (!pw && !v) {
                    editPwcEl.classList.remove('is-valid', 'is-invalid');
                    document.getElementById('edit_confirm_feedback').textContent = '';
                    return true;
                }
                if (v !== pw) {
                    ev(editPwcEl, 'edit_confirm_feedback', 'Password tidak cocok.');
                    return false;
                }
                ok(editPwcEl, 'edit_confirm_feedback', 'Password cocok');
                return true;
            }

            function checkEditAll() {
                editSubmit.disabled = ![
                    vEditName(), vEditEmail(), vEditRole(), vEditStatus(), vEditPassword(), vEditConfirm()
                ].every(Boolean);
            }

            editNameEl.addEventListener('input', function() {
                vEditName();
                checkEditAll();
            });
            editEmailEl.addEventListener('input', function() {
                vEditEmail();
                checkEditAll();
            });
            editRoleEl.addEventListener('change', function() {
                vEditRole();
                checkEditAll();
            });
            editStatEl.addEventListener('change', function() {
                vEditStatus();
                checkEditAll();
            });
            editPwEl.addEventListener('input', function() {
                vEditPassword();
                checkEditAll();
            });
            editPwcEl.addEventListener('input', function() {
                vEditConfirm();
                checkEditAll();
            });

            // ── KONFIRMASI HAPUS ─────────────────────────────────────────
            document.querySelectorAll('.btn-delete').forEach(function(button) {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Hapus User?',
                        text: 'Data user yang dihapus tidak dapat dikembalikan!',
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
