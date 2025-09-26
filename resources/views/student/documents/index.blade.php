@extends('layouts.app')

@section('title','My Documents')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>My Documents</span>
    <a class="btn btn-primary btn-sm" href="{{ route('student.documents.create') }}">Upload</a>
  </div>
  <div class="card-body">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>Document Name</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Uploaded At</th>
            <th>File</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($documents as $doc)
            <tr>
              <td>{{ $doc->document_name }}</td>
              <td>{{ $doc->phone }}</td>
              <td>{{ $doc->gender }}</td>
              <td>{{ $doc->created_at->format('d M Y, h:i A') }}</td>
              <td><a class="btn btn-sm btn-outline-primary" href="{{ route('student.documents.show', $doc->id) }}">View</a></td>
              <td>
                  <div class="d-flex gap-2">
                    <a href="{{ route('student.documents.edit', $doc->id) }}" class="btn btn-sm btn-warning">
                      Edit
                    </a>
                    <form action="{{ route('student.documents.destroy', $doc->id) }}" method="POST" style="margin:0;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Delete this document?')">
                        Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
          @empty
            <tr><td colspan="6" class="text-center">No documents</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection
