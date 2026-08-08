@extends('layouts.app')
@section('title', $conference->title)
@section('content')
<div class="container mt-4">
    <div class="bg-white rounded-4 shadow-sm p-4">
        <span class="badge badge-{{ $conference->status }} mb-2 text-capitalize">{{ $conference->status }}</span>
        <h2>{{ $conference->title }}</h2>
        <p class="text-muted"><i class="bi bi-diagram-3"></i> {{ $conference->department->name }} &nbsp; | &nbsp;
           <i class="bi bi-calendar-event"></i> {{ $conference->start_date->format('d M Y') }} – {{ $conference->end_date->format('d M Y') }}</p>
        <p>{{ $conference->description }}</p>

        @if($conference->registration_deadline)
        <p><strong>Registration Deadline:</strong> {{ $conference->registration_deadline->format('d M Y') }}</p>
        @endif

        <div class="mt-3">
            @foreach($conference->materials as $m)
                <a href="{{ Storage::url($m->file_path) }}" target="_blank" class="btn btn-outline-primary me-2 mb-2">
                    <i class="bi bi-download"></i> {{ ucfirst($m->type) }}
                </a>
            @endforeach
        </div>

        <a href="{{ route('submissions.create') }}?conference={{ $conference->id }}" class="btn btn-success mt-3">
            <i class="bi bi-send"></i> Submit a Paper for this Conference
        </a>
    </div>
</div>
@endsection