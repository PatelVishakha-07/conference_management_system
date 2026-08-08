@extends('layouts.app')
@section('title', 'Admin Login')
@section('content')
<div class="container mt-5" style="max-width:420px;">
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h4 class="mb-3 text-center">Admin Login</h4>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf
            <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
            <button class="btn btn-primary w-100">Login</button>
        </form>
        <p class="text-muted small mt-3 mb-0">Demo credentials: admin@lju.ac.in / admin123</p>
    </div>
</div>
@endsection