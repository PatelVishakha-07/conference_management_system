@extends('layouts.app')
@section('title', 'Submit Paper')
@section('content')
<div class="container mt-4" style="max-width:700px;">
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h3 class="section-title">Author Registration & Paper Submission</h3>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('submissions.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Conference</label>
                <select name="conference_id" class="form-select" required>
                    @foreach($conferences as $c)
                        <option value="{{ $c->id }}">{{ $c->title }} ({{ $c->status }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3"><label class="form-label">Author Name</label><input type="text" name="author_name" class="form-control" required></div>
            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control"></div>
            </div>
            <div class="mb-3"><label class="form-label">Paper Title</label><input type="text" name="paper_title" class="form-control" required></div>
            <div class="mb-3">
                <label class="form-label d-block">Presentation Type</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="presentation_type" value="paper" checked><label class="form-check-label">Paper</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="presentation_type" value="poster"><label class="form-check-label">Poster</label>
                </div>
            </div>
            <div class="mb-3"><label class="form-label">Upload Paper (PDF)</label><input type="file" name="paper_file" class="form-control"></div>
            <button class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</div>
@endsection