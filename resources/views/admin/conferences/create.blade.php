@extends('layouts.app')
@section('title', 'Add Conference')
@section('content')
<div class="container mt-4" style="max-width:750px;">
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h3 class="section-title">Add Conference</h3>
        @include('admin.conferences._form', ['conference' => null, 'action' => route('admin.conferences.store')])
    </div>
</div>
@endsection