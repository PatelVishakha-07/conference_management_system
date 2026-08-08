@extends('layouts.app')
@section('title', $department->name)
@section('content')
<div class="container mt-4">
    <h3 class="section-title">{{ $department->name }} Department — Conferences</h3>

    @php
        $grouped = $conferences->groupBy('status');
    @endphp

    @foreach(['current', 'upcoming', 'past'] as $status)
        @if(($grouped[$status] ?? collect())->isNotEmpty())
        <h5 class="text-capitalize mt-4">{{ $status }}</h5>
        <div class="row g-4">
            @foreach($grouped[$status] as $conf)
            <div class="col-md-4">
                <div class="card card-conf h-100">
                    <div class="card-top bg-{{ $status === 'current' ? 'success' : ($status === 'upcoming' ? 'primary' : 'secondary') }}"></div>
                    <div class="card-body">
                        <span class="badge badge-{{ $status }} mb-2 text-capitalize">{{ $status }}</span>
                        <h5 class="card-title">{{ $conf->title }}</h5>
                        <p class="text-muted small">{{ $conf->start_date->format('d M Y') }} – {{ $conf->end_date->format('d M Y') }}</p>
                        <a href="{{ route('conferences.show', $conf) }}" class="btn btn-sm btn-outline-primary">View</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    @endforeach
</div>
@endsection