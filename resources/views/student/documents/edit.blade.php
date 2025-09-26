@extends('layouts.app')

@section('title','Edit Document')

@section('content')
<div class="card shadow-sm">
  <div class="card-header">Edit Document</div>
  <div class="card-body">

    <form action="{{ route('student.documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Document Name</label>
        <input name="document_name" value="{{ old('document_name', $document->document_name) }}" class="form-control" required>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Gender</label>
          <select name="gender" class="form-select" required>
            <option value="Male" {{ $document->gender=='Male'?'selected':'' }}>Male</option>
            <option value="Female" {{ $document->gender=='Female'?'selected':'' }}>Female</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Phone</label>
          <input type="tel"  pattern="^[6-9]\d{9}$" name="phone" value="{{ old('phone', $document->phone) }}" class="form-control" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Replace File (optional)</label><br>
        <small class="text-muted">Current File: <a href="{{ asset('storage/'.$document->file_path) }}" target="_blank">View</a></small>
        <input type="file" name="file" class="form-control mt-2">
      </div>

      <button class="btn btn-success">Update</button>
      <a href="{{ route('student.documents.index') }}" class="btn btn-secondary">Back</a>
    </form>

  </div>
</div>
@endsection
