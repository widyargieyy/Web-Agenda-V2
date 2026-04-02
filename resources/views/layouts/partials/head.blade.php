<meta charset="utf-8" />

@php
    $roles = [
        1 => 'Admin',
        2 => 'Operator',
        3 => 'Kabid',
        4 => 'Staff',
    ];

    $role = Auth::check() ? $roles[Auth::user()->role_id] : 'Guest';
@endphp

<title>@yield('title') | {{ $role }} SIMAGA</title>

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description"
    content="Paces is a modern, responsive admin dashboard available on ThemeForest. Ideal for building CRM, CMS, project management tools, and custom web applications with a clean UI, flexible layouts, and rich features." />
<meta name="keywords"
    content="Paces, admin dashboard, ThemeForest, Bootstrap 5 admin, responsive admin, CRM dashboard, CMS admin, web app UI, admin theme, premium admin template" />
<meta name="author" content="Coderthemes" />

<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.ico" />

<!-- Theme Config Js -->
<script src="{{ asset('assets') }}/js/config.js"></script>
<script src="{{ asset('assets') }} }}/js/demo.js"></script>

<!-- Vendor css -->
<link href="{{ asset('assets') }}/css/vendors.min.css" rel="stylesheet" type="text/css" />

<!-- App css -->
<link id="app-style" href="{{ asset('assets') }}/css/app.min.css" rel="stylesheet" type="text/css" />

{{-- Page-specific styles --}}
@stack('styles')
