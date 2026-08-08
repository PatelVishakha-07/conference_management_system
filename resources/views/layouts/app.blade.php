<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CMT — LJ University')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { background:#f5f6fa; font-family:'Segoe UI',sans-serif; }
        .navbar-brand { font-weight:700; letter-spacing:.3px; }
        .card-conf { border:none; border-radius:16px; box-shadow:0 2px 12px rgba(0,0,0,.07); transition:.25s; overflow:hidden; }
        .card-conf:hover { transform:translateY(-4px); box-shadow:0 10px 24px rgba(0,0,0,.12); }
        .card-conf .card-top { height:6px; }
        .badge-current  { background:#198754 !important; }
        .badge-upcoming { background:#0d6efd !important; }
        .badge-past     { background:#6c757d !important; }
        .hero { background:linear-gradient(135deg,#1e3a8a 0%,#2563eb 60%,#3b82f6 100%); color:#fff; padding:70px 0; border-radius:0 0 28px 28px; }
        .section-title { font-weight:700; margin-bottom:1.5rem; border-left:5px solid #2563eb; padding-left:12px; }
        footer { background:#101828; color:#98a2b3; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand text-primary" href="{{ url('/') }}"><i class="bi bi-mortarboard-fill"></i> CMT · LJ University</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="nav">
      <ul class="navbar-nav gap-2 align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="{{ route('conferences.index') }}">Conferences</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('conferences.archive') }}">Archive</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('submissions.create') }}">Submit Paper</a></li>
        @auth
          <li class="nav-item"><a class="btn btn-primary btn-sm" href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
        @else
          <li class="nav-item"><a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">Admin Login</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<main>
    @if(session('success'))
        <div class="container mt-3"><div class="alert alert-success">{{ session('success') }}</div></div>
    @endif
    @yield('content')
</main>

<footer class="text-center py-4 mt-5 small">
    &copy; {{ date('Y') }} Lok Jagruti Kendra University · IEEE Student Branch · CodeApex
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>