@extends('layouts.app')
@section('title', 'Past Conferences')
@section('content')
<div class="container mt-4">
    <h3 class="section-title">Archive — Past Conferences</h3>
    <div class="table-responsive bg-white rounded-3 shadow-sm p-3">
        <table class="table align-middle">
            <thead><tr><th>Title</th><th>Department</th><th>Dates</th><th></th></tr></thead>
            <tbody>
            @foreach($conferences as $conf)
                <tr>
                    <td>{{ $conf->title }}</td>
                    <td><span class="badge bg-secondary">{{ $conf->department->name }}</span></td>
                    <td>{{ $conf->start_date->format('d M Y') }} – {{ $conf->end_date->format('d M Y') }}</td>
                    <td><a href="{{ route('conferences.show', $conf) }}" class="btn btn-sm btn-outline-secondary">View Report</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection