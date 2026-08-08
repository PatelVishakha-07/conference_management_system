@extends('layouts.app')
@section('title', 'Admin Login')
@section('content')

<div class="card auth-card" style="max-width:900px; width:100%;">
    <div class="row g-0">

        <!-- Left branding panel -->
        <div class="col-md-5 d-none d-md-flex flex-column justify-content-center auth-brand p-5">
            <i class="bi bi-mortarboard-fill" style="font-size:2.8rem;"></i>
            <h3 class="fw-bold mt-3 mb-2">CMT Admin</h3>
            <p class="text-white-50 mb-0">
                Manage conferences, materials and paper submissions across every department.
            </p>
            <hr class="border-white-50 my-4">
            <div class="d-flex align-items-center gap-2 text-white-50 small">
                <i class="bi bi-shield-lock-fill"></i> Restricted to authorized organizers
            </div>
        </div>

        <!-- Right form panel -->
        <div class="col-md-7">
            <div class="p-4 p-lg-5">
                <div class="text-center d-md-none mb-3">
                    <i class="bi bi-mortarboard-fill text-primary" style="font-size:2rem;"></i>
                </div>
                <h4 class="fw-bold mb-1">Welcome back</h4>
                <p class="text-muted mb-4">Sign in to manage conferences and submissions.</p>

                @if($errors->any())
                    <div class="alert alert-danger d-flex align-items-center gap-2 py-2">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.attempt') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-uppercase text-muted">Email</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="form-control border-start-0 ps-0" placeholder="admin@lju.ac.in" required autofocus>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-uppercase text-muted">Password</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password"
                                   class="form-control border-start-0 ps-0" placeholder="••••••••" required>
                        </div>
                    </div>

                    <button class="btn btn-primary w-100 py-2 fw-semibold mt-2">
                        Sign In <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </form>

                <div class="text-center mt-4">
                    <span class="badge bg-light text-muted border px-3 py-2">
                        <i class="bi bi-info-circle me-1"></i>
                        Demo: admin@lju.ac.in / admin123
                    </span>
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('home') }}" class="text-decoration-none small text-muted">
                        <i class="bi bi-arrow-left"></i> Back to homepage
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection