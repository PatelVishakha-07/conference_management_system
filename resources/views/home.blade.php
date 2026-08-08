@extends('layouts.app')
@section('title', 'Home')
@section('content')

<section class="hero text-center">
    <div class="container">
        <h1 class="display-5 fw-bold">Conference Management Tool</h1>
        <p class="lead">Discover current, upcoming and past conferences across all departments.</p>
        <a href="{{ route('conferences.index') }}" class="btn btn-light btn-lg mt-2 fw-semibold">Browse Conferences</a>
    </div>
</section>

<div class="container mt-5">
    <h3 class="section-title">Live Right Now</h3>
    <div class="row g-4">
        @forelse($currentConferences ?? [] as $conf)
        <div class="col-md-4">
            <div class="card card-conf h-100">
                <div class="card-top bg-success"></div>
                <div class="card-body">
                    <span class="badge badge-current mb-2">Current</span>
                    <h5 class="card-title">{{ $conf->title }}</h5>
                    <p class="text-muted small mb-1"><i class="bi bi-diagram-3"></i> {{ $conf->department->name }}</p>
                    <p class="text-muted small"><i class="bi bi-calendar-event"></i> {{ $conf->start_date->format('d M') }} – {{ $conf->end_date->format('d M Y') }}</p>
                    <a href="{{ route('conferences.show', $conf) }}" class="btn btn-sm btn-outline-primary mt-2">View Live Schedule</a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">No conferences are currently in progress.</p>
        @endforelse
    </div>
</div>

@endsection