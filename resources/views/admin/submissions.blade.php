@extends('layouts.app')
@section('title', 'Submissions')
@section('content')
<div class="container mt-4">
    <h3 class="section-title">All Submissions</h3>

    <form method="GET" class="mb-3" style="max-width:400px;">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by author or Abstract ID">
    </form>

    <div class="table-responsive bg-white rounded-3 shadow-sm p-3">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Abstract ID</th><th>Author</th><th>Paper Title</th><th>Conference</th>
                    <th>Type</th><th>Payment</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($submissions as $s)
                <tr>
                    <td><code>{{ $s->abstract_id }}</code></td>
                    <td>{{ $s->author_name }}<br><span class="text-muted small">{{ $s->email }}</span></td>
                    <td>{{ $s->paper_title }}</td>
                    <td>{{ $s->conference->title }}</td>
                    <td class="text-capitalize">{{ $s->presentation_type }}</td>
                    <td><span class="badge bg-{{ $s->payment_status === 'paid' ? 'success' : 'warning' }} text-capitalize">{{ $s->payment_status }}</span></td>
                    <td>
                        <form method="POST" action="{{ route('admin.submissions.status', $s) }}" class="d-flex gap-1">
                            @csrf
                            <select name="status" class="form-select form-select-sm">
                                @foreach(['submitted','under_review','accepted','rejected'] as $st)
                                    <option value="{{ $st }}" {{ $s->status === $st ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$st)) }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-sm btn-outline-primary">Save</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection