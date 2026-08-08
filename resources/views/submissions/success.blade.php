@extends('layouts.app')
@section('title', 'Submission Successful')
@section('content')
<div class="container mt-5" style="max-width:600px;">
    <div class="bg-white rounded-4 shadow-sm p-4 text-center">
        <i class="bi bi-check-circle-fill text-success" style="font-size:3rem;"></i>
        <h3 class="mt-3">Submission Received!</h3>
        <p class="text-muted">Your Abstract ID is:</p>
        <h4 class="text-primary fw-bold">{{ $submission->abstract_id }}</h4>
        <p class="mt-3">Paper: <strong>{{ $submission->paper_title }}</strong></p>
        <p>Status: <span class="badge bg-secondary text-capitalize">{{ $submission->status }}</span> &nbsp;
           Payment: <span class="badge bg-{{ $submission->payment_status === 'paid' ? 'success' : 'warning' }} text-capitalize">{{ $submission->payment_status }}</span></p>

        @if($submission->payment_status === 'pending')
        <form method="POST" action="{{ route('submissions.pay', $submission) }}" class="mt-3">
            @csrf
            <button class="btn btn-success">Pay Registration Fee</button>
        </form>
        @endif

        <a href="{{ route('conferences.index') }}" class="btn btn-outline-secondary mt-3">Back to Conferences</a>
    </div>
</div>
@endsection