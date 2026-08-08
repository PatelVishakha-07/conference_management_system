@extends('layouts.app')
@section('title', 'Manage Conferences')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="section-title mb-0">Manage Conferences</h3>
        <a href="{{ route('admin.conferences.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Conference
        </a>
    </div>

    <div class="table-responsive bg-white rounded-3 shadow-sm p-3">
        <table class="table align-middle">
            <thead>
                <tr><th>Title</th><th>Department</th><th>Dates</th><th>Status</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
            @forelse($conferences as $conf)
                <tr>
                    <td>{{ $conf->title }}</td>
                    <td><span class="badge bg-secondary">{{ $conf->department->name }}</span></td>
                    <td>{{ $conf->start_date->format('d M Y') }} – {{ $conf->end_date->format('d M Y') }}</td>
                    <td><span class="badge badge-{{ $conf->status }} text-capitalize">{{ $conf->status }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('conferences.show', $conf) }}" class="btn btn-sm btn-outline-secondary" target="_blank">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.conferences.edit', $conf) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.conferences.destroy', $conf) }}" class="d-inline"
                              onsubmit="return confirm('Delete this conference? This cannot be undone.');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No conferences yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection