<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @if($conference) @method('PUT') @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $conference->title ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Department</label>
        <select name="department_id" class="form-select" required>
            <option value="">Select department</option>
            @foreach($departments as $d)
                <option value="{{ $d->id }}" {{ old('department_id', $conference->department_id ?? '') == $d->id ? 'selected' : '' }}>
                    {{ $d->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control"
                   value="{{ old('start_date', $conference?->start_date?->format('Y-m-d')) }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control"
                   value="{{ old('end_date', $conference?->end_date?->format('Y-m-d')) }}" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Registration Deadline</label>
        <input type="date" name="registration_deadline" class="form-control"
               value="{{ old('registration_deadline', $conference?->registration_deadline?->format('Y-m-d')) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $conference->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Call for Papers</label>
        <textarea name="call_for_papers" class="form-control" rows="2">{{ old('call_for_papers', $conference->call_for_papers ?? '') }}</textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Brochure (PDF)</label>
            <input type="file" name="brochure" class="form-control">
            @if($conference && $conference->materials->where('type','brochure')->first())
                <small class="text-muted">Current file will be replaced if you upload a new one.</small>
            @endif
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Flyer (PDF/Image)</label>
            <input type="file" name="flyer" class="form-control">
            @if($conference && $conference->materials->where('type','flyer')->first())
                <small class="text-muted">Current file will be replaced if you upload a new one.</small>
            @endif
        </div>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" name="featured" value="1" class="form-check-input" id="featured"
               {{ old('featured', $conference->featured ?? false) ? 'checked' : '' }}>
        <label class="form-check-label" for="featured">Feature on homepage</label>
    </div>

    <button class="btn btn-primary">{{ $conference ? 'Update Conference' : 'Create Conference' }}</button>
    <a href="{{ route('admin.conferences.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form>