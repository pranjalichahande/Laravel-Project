@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">Document Details</h2>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">{{ $document->document_name }}</div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $document->name }}</p>
            <p><strong>Email:</strong> {{ $document->email }}</p>
            <p><strong>Phone:</strong> {{ $document->phone }}</p>
            <p><strong>Gender:</strong> {{ $document->gender }}</p>
            <p>
                <strong>File:</strong> 
                <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">
                    View 
                </a>
            </p>
        </div>
    </div>

    <!-- Back Button -->
    <!-- <a href="{{ route('student.documents.index') }}" class="btn btn-secondary">
        &larr; Back
    </a> -->
        <a href="{{ route('student.documents.index') }}" class="btn btn-secondary">Back</a>

</div>
@endsection
