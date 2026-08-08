@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="section-title mb-0">Admin Dashboard</h3>
        <div>
            <a href="{{ route('admin.submissions') }}" class="btn btn-outline-primary btn-sm">View Submissions</a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card card-conf text-center p-3">
                <div class="fs-2 fw-bold text-success">{{ $stats['current'] }}</div>
                <div class="text-muted">Current Conferences</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-conf text-center p-3">
                <div class="fs-2 fw-bold text-primary">{{ $stats['upcoming'] }}</div>
                <div class="text-muted">Upcoming Conferences</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-conf text-center p-3">
                <div class="fs-2 fw-bold text-secondary">{{ $stats['past'] }}</div>
                <div class="text-muted">Past Conferences</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-conf text-center p-3">
                <div class="fs-2 fw-bold text-dark">{{ $stats['submissions'] }}</div>
                <div class="text-muted">Total Submissions</div>
            </div>
        </div>
    </div>
</div>
@endsection