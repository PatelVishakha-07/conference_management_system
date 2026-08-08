@extends('layouts.app')
@section('title', 'Edit Conference')
@section('content')
<div class="container mt-4" style="max-width:750px;">
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h3 class="section-title">Edit Conference</h3>
        @include('admin.conferences._form', ['conference' => $conference, 'action' => route('admin.conferences.update', $conference)])
    </div>
</div>
@endsection