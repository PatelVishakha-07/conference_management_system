@extends('layouts.app')
@section('title', 'Conferences')
@section('content')
<div class="container mt-4">
    <h3 class="section-title">All Conferences</h3>
    <div class="row g-4">
        @foreach($conferences as $conf)
        <div class="col-md-4">
            <div class="card card-conf h-100">
                <div class="card-top bg-{{ $conf->status === 'current' ? 'success' : 'primary' }}"></div>
                <div class="card-body">
                    <span class="badge badge-{{ $conf->status }} mb-2 text-capitalize">{{ $conf->status }}</span>
                    <h5 class="card-title">{{ $conf->title }}</h5>
                    <p class="text-muted small mb-1"><i class="bi bi-diagram-3"></i> {{ $conf->department->name }}</p>
                    <p class="text-muted small"><i class="bi bi-calendar-event"></i> {{ $conf->start_date->format('d M') }} – {{ $conf->end_date->format('d M Y') }}</p>
                    <a href="{{ route('conferences.show', $conf) }}" class="btn btn-sm btn-outline-primary mt-2">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection