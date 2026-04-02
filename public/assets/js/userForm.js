document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('addUserModal');
    if (!modal) return;

    const form     = modal.querySelector('form');
    const nameEl   = form.querySelector('[name="name"]');
    const emailEl  = form.querySelector('[name="email"]');
    const roleEl   = form.querySelector('[name="role_id"]');
    const statusEl = form.querySelector('[name="is_active"]');
    const pwEl     = form.querySelector('[name="password"]');
    const pwcEl    = form.querySelector('[name="password_confirmation"]');
    const submitBtn = form.querySelector('[type="submit"]');

    // ── Pakai elemen .invalid-feedback yang sudah ada di blade ──
    // Jika belum ada (field tanpa @error), buat satu saja
    function getFeedbackEl(inputEl) {
        const parent = inputEl.closest('.col-md-6');
        let fb = parent.querySelector('.invalid-feedback');
        if (!fb) {
            fb = document.createElement('div');
            fb.className = 'invalid-feedback';
            inputEl.after(fb);
        }
        return fb;
    }

    const nameFb   = getFeedbackEl(nameEl);
    const emailFb  = getFeedbackEl(emailEl);
    const roleFb   = getFeedbackEl(roleEl);
    const statusFb = getFeedbackEl(statusEl);
    const pwFb     = getFeedbackEl(pwEl);
    const pwcFb    = getFeedbackEl(pwcEl);

    // ── Strength bar (hanya buat sekali) ────────────────────────
    let strengthFill = document.getElementById('rt-strength-fill');
    if (!strengthFill) {
        const wrap = document.createElement('div');
        wrap.style.cssText = 'height:4px;border-radius:4px;background:#e9ecef;overflow:hidden;margin-top:6px';
        strengthFill = document.createElement('div');
        strengthFill.id = 'rt-strength-fill';
        strengthFill.style.cssText = 'height:100%;width:0%;border-radius:4px;transition:width .3s,background .3s';
        wrap.appendChild(strengthFill);
        pwEl.closest('.col-md-6').appendChild(wrap);
    }

    // ── Helper ───────────────────────────────────────────────────
    function setValid(inputEl, fb, msg) {
        inputEl.classList.remove('is-invalid');
        inputEl.classList.add('is-valid');
        fb.style.color = '#12b76a';
        fb.style.display = 'block';
        fb.textContent = '✓ ' + msg;
    }

    function setInvalid(inputEl, fb, msg) {
        inputEl.classList.remove('is-valid');
        inputEl.classList.add('is-invalid');
        fb.style.color = '#dc3545';
        fb.style.display = 'block';
        fb.textContent = msg;
    }

    function clearField(inputEl, fb) {
        inputEl.classList.remove('is-valid', 'is-invalid');
        fb.style.display = 'none';
        fb.textContent = '';
    }

    // ── Validasi ─────────────────────────────────────────────────
    function validateName() {
        const v = nameEl.value.trim();
        if (!v)           { setInvalid(nameEl, nameFb, 'Nama wajib diisi.'); return false; }
        if (v.length < 3) { setInvalid(nameEl, nameFb, 'Nama minimal 3 karakter.'); return false; }
        setValid(nameEl, nameFb, 'Nama valid');
        return true;
    }

    function validateEmail() {
        const v = emailEl.value.trim();
        if (!v)                                     { setInvalid(emailEl, emailFb, 'Email wajib diisi.'); return false; }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)) { setInvalid(emailEl, emailFb, 'Format email tidak valid.'); return false; }
        setValid(emailEl, emailFb, 'Email valid');
        return true;
    }

    function validateRole() {
        if (!roleEl.value) { setInvalid(roleEl, roleFb, 'Role wajib dipilih.'); return false; }
        setValid(roleEl, roleFb, 'Role dipilih');
        return true;
    }

    function validateStatus() {
        if (statusEl.value === '') { setInvalid(statusEl, statusFb, 'Status wajib dipilih.'); return false; }
        setValid(statusEl, statusFb, 'Status dipilih');
        return true;
    }

    function validatePassword() {
        const v = pwEl.value;
        const colors = ['#e9ecef','#f04438','#f79009','#6ce9a6','#12b76a'];
        const widths  = ['0%','25%','50%','75%','100%'];
        const labels  = ['','Sangat lemah','Lemah','Cukup kuat','Kuat'];
        let s = 0;
        if (v.length >= 8)          s++;
        if (/[A-Z]/.test(v))        s++;
        if (/[0-9]/.test(v))        s++;
        if (/[^A-Za-z0-9]/.test(v)) s++;
        strengthFill.style.width      = widths[s];
        strengthFill.style.background = colors[s];
        if (!v)           { setInvalid(pwEl, pwFb, 'Password wajib diisi.'); return false; }
        if (v.length < 8) { setInvalid(pwEl, pwFb, 'Password minimal 8 karakter.'); return false; }
        setValid(pwEl, pwFb, 'Kekuatan: ' + labels[s]);
        if (pwcEl.value) validateConfirm();
        return true;
    }

    function validateConfirm() {
        const v = pwcEl.value;
        if (!v)               { setInvalid(pwcEl, pwcFb, 'Konfirmasi password wajib diisi.'); return false; }
        if (v !== pwEl.value) { setInvalid(pwcEl, pwcFb, 'Password tidak cocok.'); return false; }
        setValid(pwcEl, pwcFb, 'Password cocok');
        return true;
    }

    function checkAll() {
        const allValid = [
            validateName(),
            validateEmail(),
            validateRole(),
            validateStatus(),
            validatePassword(),
            validateConfirm(),
        ].every(Boolean);
        submitBtn.disabled = !allValid;
    }

    // ── Event listeners ───────────────────────────────────────────
    nameEl.addEventListener('input',    function () { validateName();     checkAll(); });
    emailEl.addEventListener('input',   function () { validateEmail();    checkAll(); });
    roleEl.addEventListener('change',   function () { validateRole();     checkAll(); });
    statusEl.addEventListener('change', function () { validateStatus();   checkAll(); });
    pwEl.addEventListener('input',      function () { validatePassword(); checkAll(); });
    pwcEl.addEventListener('input',     function () { validateConfirm();  checkAll(); });

    // ── Reset saat modal ditutup ──────────────────────────────────
    modal.addEventListener('hidden.bs.modal', function () {
        form.reset();
        [nameEl, emailEl, roleEl, statusEl, pwEl, pwcEl].forEach(function (el) {
            el.classList.remove('is-valid', 'is-invalid');
        });
        [nameFb, emailFb, roleFb, statusFb, pwFb, pwcFb].forEach(function (fb) {
            fb.style.display = 'none';
            fb.textContent = '';
        });
        strengthFill.style.width = '0%';
        submitBtn.disabled = true;
    });

    // Sembunyikan semua feedback di awal
    [nameFb, emailFb, roleFb, statusFb, pwFb, pwcFb].forEach(function (fb) {
        fb.style.display = 'none';
    });

    submitBtn.disabled = true;
});