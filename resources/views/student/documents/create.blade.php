@extends('layouts.app')

@section('title','Upload Documents')

@section('content')
<div class="card shadow-sm">
  <div class="card-header">Upload Documents</div>
  <div class="card-body">

    <form action="{{ route('student.documents.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Full name</label>
          <input name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control" required>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Gender</label>
          <select name="gender" class="form-select" required>
            <option value="">Select</option>
            <option value="Male" {{ old('gender')=='Male'?'selected':'' }}>Male</option>
            <option value="Female" {{ old('gender')=='Female'?'selected':'' }}>Female</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Phone</label>
          <input  type="tel"  pattern="^[6-9]\d{9}$" name="phone" value="{{ old('phone') }}" class="form-control" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Document Name</label>
        <input name="document_name" value="{{ old('document_name') }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Select files (multiple)</label>
        <input type="file" name="files[]" class="form-control" multiple required>
      </div>

      <button class="btn btn-success">Upload</button>
      <a href="{{ route('student.documents.index') }}" class="btn btn-secondary">Back</a>
    </form>

  </div>
</div>
@endsection
