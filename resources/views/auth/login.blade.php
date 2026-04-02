<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIMAGA – Sistem Informasi Manajemen Agenda | BAPPEDA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --green-dark: #1a4a1a;
            --green-mid: #2d6a2d;
            --green-light: #3d8a3d;
            --gold: #c9a227;
            --gold-light: #e8c04a;
            --cream: #faf7ef;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--green-dark);
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            overflow: hidden;
        }

        /* ── Left panel ── */
        .left-panel {
            flex: 1.1;
            background: var(--green-dark);
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
            overflow: hidden;
        }

        .ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(201, 162, 39, .12);
            pointer-events: none;
        }

        .ring-1 {
            width: 320px;
            height: 320px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .ring-2 {
            width: 480px;
            height: 480px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .ring-3 {
            width: 640px;
            height: 640px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .ring-4 {
            width: 820px;
            height: 820px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .accent-bar {
            position: absolute;
            top: -60px;
            right: -40px;
            width: 6px;
            height: 140%;
            background: linear-gradient(180deg, transparent, var(--gold) 30%, var(--gold-light) 70%, transparent);
            transform: rotate(12deg);
            opacity: .22;
        }

        .accent-bar-2 {
            position: absolute;
            top: -60px;
            right: 20px;
            width: 2px;
            height: 140%;
            background: linear-gradient(180deg, transparent, var(--gold) 30%, var(--gold-light) 70%, transparent);
            transform: rotate(12deg);
            opacity: .14;
        }

        .noise {
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            opacity: .4;
        }

        .logo-glow {
            filter: drop-shadow(0 0 28px rgba(201, 162, 39, .35)) drop-shadow(0 0 8px rgba(201, 162, 39, .2));
            animation: pulse-glow 3.5s ease-in-out infinite;
        }

        @keyframes pulse-glow {

            0%,
            100% {
                filter: drop-shadow(0 0 28px rgba(201, 162, 39, .35)) drop-shadow(0 0 8px rgba(201, 162, 39, .2));
            }

            50% {
                filter: drop-shadow(0 0 40px rgba(201, 162, 39, .55)) drop-shadow(0 0 14px rgba(201, 162, 39, .3));
            }
        }

        .divider-gold {
            width: 64px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            margin: 1.25rem auto;
        }

        /* ── Right panel ── */
        .right-panel {
            flex: 1;
            background: var(--cream);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 3.5rem;
            position: relative;
        }

        .right-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(180deg, var(--gold-light), var(--gold), var(--green-mid));
        }

        .form-card {
            width: 100%;
            max-width: 400px;
        }

        label {
            display: block;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--green-dark);
            margin-bottom: .45rem;
        }

        .input-wrap {
            position: relative;
            margin-bottom: .5rem;
        }

        .input-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            pointer-events: none;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: .72rem 1rem .72rem 2.6rem;
            border: 1.5px solid #d8d2c4;
            border-radius: 8px;
            background: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: .9rem;
            color: #1a1a1a;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        input:focus {
            border-color: var(--green-mid);
            box-shadow: 0 0 0 3px rgba(45, 106, 45, .12);
        }

        input::placeholder {
            color: #bbb;
        }

        .eye-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #aaa;
            padding: 2px;
            display: flex;
            align-items: center;
        }

        .eye-btn:hover {
            color: var(--green-mid);
        }

        .field-error {
            display: none;
            color: #c0392b;
            font-size: .75rem;
            margin-bottom: .8rem;
        }

        .btn-login {
            width: 100%;
            padding: .8rem;
            background: linear-gradient(135deg, var(--green-mid), var(--green-dark));
            color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            font-size: .95rem;
            letter-spacing: .04em;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform .15s, box-shadow .15s;
            box-shadow: 0 4px 18px rgba(26, 74, 26, .35);
        }

        .btn-login::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .08), transparent);
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(26, 74, 26, .45);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert-success {
            background: rgba(45, 106, 45, 0.1);
            color: #1a4a1a;
            border: 1px solid rgba(45, 106, 45, 0.3);
        }

        .alert-error {
            background: rgba(200, 0, 0, 0.08);
            color: #7a1a1a;
            border: 1px solid rgba(200, 0, 0, 0.25);
        }

        /* ── Animations ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-8px);
            }

            40% {
                transform: translateX(8px);
            }

            60% {
                transform: translateX(-6px);
            }

            80% {
                transform: translateX(6px);
            }
        }

        .fade-up {
            animation: fadeUp .6s ease both;
        }

        .delay-1 {
            animation-delay: .1s;
        }

        .delay-2 {
            animation-delay: .2s;
        }

        .delay-3 {
            animation-delay: .3s;
        }

        .delay-4 {
            animation-delay: .4s;
        }

        .delay-5 {
            animation-delay: .5s;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .left-panel {
                flex: none;
                padding: 2.5rem 2rem 2rem;
                min-height: 38vh;
            }

            .right-panel {
                padding: 2.5rem 2rem;
            }

            .right-panel::before {
                width: 100%;
                height: 4px;
                top: 0;
                left: 0;
                bottom: auto;
            }
        }
    </style>
</head>

<body>

    <!-- ═══════════ LEFT PANEL ═══════════ -->
    <div class="left-panel">
        <div class="noise"></div>
        <div class="ring ring-1"></div>
        <div class="ring ring-2"></div>
        <div class="ring ring-3"></div>
        <div class="ring ring-4"></div>
        <div class="accent-bar"></div>
        <div class="accent-bar-2"></div>

        <div class="logo-glow fade-up" style="z-index:1;">
            <img src="{{ asset('assets/images/logo_bappeda.png') }}" alt="Logo BAPPEDA Sumenep"
                style="width:130px; height:130px; object-fit:contain;" />
        </div>

        <div class="divider-gold fade-up delay-1" style="z-index:1;"></div>

        <div class="text-center fade-up delay-2" style="z-index:1;">
            <p
                style="font-size:.7rem; letter-spacing:.2em; text-transform:uppercase; color:var(--gold-light); font-weight:600; margin-bottom:.5rem;">
                Pemerintah Kabupaten Sumenep
            </p>
            <h1
                style="font-family:'Playfair Display',serif; font-size:1.5rem; color:#fff; line-height:1.3; margin-bottom:.3rem;">
                Badan Perencanaan<br>Pembangunan Daerah
            </h1>
            <p style="font-size:.72rem; color:rgba(255,255,255,.45); letter-spacing:.06em; text-transform:uppercase;">
                BAPPEDA — Kabupaten Sumenep
            </p>
        </div>

        <div class="divider-gold fade-up delay-3" style="z-index:1;"></div>

        <div class="fade-up delay-3" style="z-index:1; text-align:center;">
            <div
                style="display:inline-block; border:1px solid rgba(201,162,39,.4); border-radius:50px; padding:.4rem 1.4rem; background:rgba(201,162,39,.06);">
                <p
                    style="font-size:.75rem; letter-spacing:.18em; text-transform:uppercase; color:var(--gold-light); font-weight:600;">
                    ✦ &nbsp;SIMAGA&nbsp; ✦
                </p>
            </div>
            <p style="margin-top:.6rem; font-size:.8rem; color:rgba(255,255,255,.5); line-height:1.5;">
                Sistem Informasi Manajemen Agenda
            </p>
        </div>

        <p class="fade-up delay-4"
            style="z-index:1; position:absolute; bottom:2rem; font-size:.68rem; color:rgba(255,255,255,.25); letter-spacing:.12em; text-transform:uppercase;">
            Membangun Sumenep Bermartabat
        </p>
    </div>

    <!-- ═══════════ RIGHT PANEL ═══════════ -->
    <div class="right-panel">
        <div class="form-card">

            <!-- Heading -->
            <div class="fade-up" style="margin-bottom:2rem;">
                <p
                    style="font-size:.7rem; letter-spacing:.18em; text-transform:uppercase; color:var(--green-mid); font-weight:600; margin-bottom:.6rem;">
                    Portal Pengguna
                </p>
                <h2
                    style="font-family:'Playfair Display',serif; font-size:1.8rem; color:var(--green-dark); line-height:1.2; margin-bottom:.5rem;">
                    Selamat Datang
                </h2>
                <p style="font-size:.85rem; color:#6b7280; line-height:1.55;">
                    Silakan masuk menggunakan akun yang telah didaftarkan oleh administrator sistem.
                </p>
            </div>

            <!-- Alert -->
            <div id="alert-box" style="display:none; margin-bottom:1.2rem;">
                <div id="alert-content"
                    style="padding:.75rem 1rem; border-radius:8px; font-size:.85rem; display:flex; align-items:center; gap:.6rem;">
                    <span id="alert-icon">⚠️</span>
                    <span id="alert-text"></span>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('login-proses') }}" method="post" onsubmit="return onSubmit()">
                @csrf

                <!-- Email -->
                <div class="fade-up delay-1">
                    <label for="email">Email Pengguna</label>
                    <div class="input-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <input type="text" name="email" id="email" placeholder="Masukkan email pengguna"
                            autocomplete="email" value="{{ old('email') }}" />
                    </div>
                    <small id="email-error" class="field-error"></small>
                </div>

                <!-- Password -->
                <div class="fade-up delay-2">
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                        <input type="password" name="password" id="password" placeholder="Masukkan kata sandi"
                            autocomplete="current-password" />
                        {{-- <button class="eye-btn" type="button" onclick="togglePassword()">
                            <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button> --}}
                    </div>
                    <small id="password-error" class="field-error"></small>
                </div>

                <!-- Remember me + forgot -->
                <div class="fade-up delay-3"
                    style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.6rem;">
                    <label
                        style="display:flex; align-items:center; gap:.5rem; text-transform:none; letter-spacing:0; font-weight:400; font-size:.83rem; color:#555; cursor:pointer;">
                        <input type="checkbox" style="accent-color:var(--green-mid); width:15px; height:15px;" />
                        Ingat saya
                    </label>
                    <a href="#"
                        style="font-size:.83rem; color:var(--green-mid); font-weight:500; text-decoration:none; transition:color .15s;"
                        onmouseover="this.style.color='var(--gold)'" onmouseout="this.style.color='var(--green-mid)'">
                        Lupa kata sandi?
                    </a>
                </div>

                <!-- Submit -->
                <div class="fade-up delay-4">
                    <button class="btn-login" type="submit">Login</button>
                </div>
            </form>

            <!-- Footer -->
            <div class="fade-up delay-5"
                style="margin-top:2.2rem; padding-top:1.5rem; border-top:1px solid #e8e2d6; text-align:center;">
                <p style="font-size:.75rem; color:#a0998a; line-height:1.6;">
                    Sistem ini hanya untuk pengguna yang berwenang.<br>
                    Hubungi administrator jika mengalami kendala akses.
                </p>
                <p style="margin-top:.8rem; font-size:.7rem; color:#c8c0b4;">
                    © 2025 BAPPEDA Kabupaten Sumenep · SIMAGA v1.0
                </p>
            </div>
        </div>
    </div>

    <script>
        // ── Alert ────────────────────────────────────────────────────────────────
        function showAlert(type, message) {
            const box = document.getElementById('alert-box');
            const content = document.getElementById('alert-content');
            const icon = document.getElementById('alert-icon');
            const text = document.getElementById('alert-text');

            box.style.display = 'block';
            content.className = type === 'success' ? 'alert-success' : 'alert-error';
            icon.textContent = type === 'success' ? '✅' : '⚠️';
            text.textContent = message;

            setTimeout(() => {
                box.style.display = 'none';
            }, 3000);
        }

        // ── Toggle password visibility ───────────────────────────────────────────
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('icon-eye');
            const isHidden = input.type === 'password';

            input.type = isHidden ? 'text' : 'password';
            icon.innerHTML = isHidden ?
                `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>` :
                `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                   <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>`;
        }

        // ── Realtime validation ──────────────────────────────────────────────────
        const EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        function setFieldState(inputEl, errorEl, isValid, message = '') {
            inputEl.style.borderColor = isValid ? 'var(--green-mid)' : '#c0392b';
            inputEl.style.boxShadow = isValid ?
                '0 0 0 3px rgba(45,106,45,.12)' :
                '0 0 0 3px rgba(192,57,43,.12)';
            errorEl.style.display = (!isValid && message) ? 'block' : 'none';
            errorEl.textContent = (!isValid && message) ? message : '';
        }

        function validateEmail() {
            const el = document.getElementById('email');
            const err = document.getElementById('email-error');
            const val = el.value.trim();

            if (!val) return setFieldState(el, err, false, 'Email wajib diisi.');
            if (!EMAIL_RE.test(val)) return setFieldState(el, err, false, 'Format email tidak valid.');
            setFieldState(el, err, true);
            return true;
        }

        function validatePassword() {
            const el = document.getElementById('password');
            const err = document.getElementById('password-error');
            const val = el.value;

            if (!val) return setFieldState(el, err, false, 'Password wajib diisi.');
            if (val.length < 6) return setFieldState(el, err, false, `Password minimal 6 karakter. (${val.length}/6)`);
            setFieldState(el, err, true);
            return true;
        }

        // ── Form submit ──────────────────────────────────────────────────────────
        function onSubmit() {
            const emailOk = validateEmail();
            const passwordOk = validatePassword();

            if (!emailOk || !passwordOk) return false;

            const btn = document.querySelector('.btn-login');
            btn.textContent = 'Memverifikasi...';
            btn.disabled = true;
            return true;
        }

        // ── Attach listeners ─────────────────────────────────────────────────────
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('email').addEventListener('input', validateEmail);
            document.getElementById('email').addEventListener('blur', validateEmail);
            document.getElementById('password').addEventListener('input', validatePassword);
            document.getElementById('password').addEventListener('blur', validatePassword);
        });
    </script>

    @if (session('error'))
        <script>
            showAlert('error', "{{ session('error') }}");
        </script>
    @endif

</body>

</html>
