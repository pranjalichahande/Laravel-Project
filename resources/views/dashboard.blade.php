@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="row mb-4">
  <div class="col-12">
    <div class="card shadow-sm border-0">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h4 class="mb-1">Welcome, {{ auth()->user()->name }}</h4>
          <p class="mb-0 text-muted">
            <strong>Email:</strong> {{ auth()->user()->email }} <br>
            <strong>Role:</strong> {{ ucfirst(auth()->user()->role) }}
          </p>
        </div>
        <div>
          <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D8ABC&color=fff&size=60" 
               alt="profile" class="rounded-circle shadow">
        </div>
      </div>
    </div>
  </div>
</div>

{{-- STUDENT PANEL --}}
@if(auth()->user()->role === 'student')
  <div class="row">
    <div class="col-lg-4 mb-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Upload Documents</h5>
          <p class="card-text">Add documents along with your details.</p>
          <a href="{{ route('student.documents.create') }}" class="btn btn-primary w-100 mb-2">Upload</a>
          <a href="{{ route('student.documents.index') }}" class="btn btn-outline-secondary w-100">My Documents</a>
        </div>
      </div>
    </div>

    <div class="col-lg-8 mb-3">
      <div class="card shadow-sm">
        <div class="card-header">Recent Documents</div>
        <div class="card-body">
          @php $docs = auth()->user()->documents()->latest()->limit(5)->get(); @endphp
          @if($docs->count())
            <ul class="list-group">
              @foreach($docs as $d)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div>
                    <strong>{{ $d->document_name }}</strong><br>
                    <small class="text-muted">{{ $d->created_at->format('d M Y, h:i A') }}</small>
                  </div>
                  <a href="{{ asset('storage/'.$d->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
                </li>
              @endforeach
            </ul>
          @else
            <p class="text-muted">No documents yet. Upload from the left panel.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
@endif

{{-- ADMIN PANEL --}}
@if(auth()->user()->role === 'admin')
  <div class="row mb-3">
    <div class="col-12">
      <div class="alert alert-info text-center">
        Total students who have uploaded at least one document: <strong>{{ $totalWithDocuments }}</strong>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            Students & Documents
            <form method="GET" action="{{ route('dashboard') }}" class="d-flex">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm me-2" placeholder="Search name/email">
                <button class="btn btn-sm btn-outline-light">Search</button>
            </form>
        </div>

        <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Document Count</th>
                    <th>Document Names</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($students as $student)
                    <tr>
                      <td>{{ $student->name }}</td>
                      <td>{{ $student->email }}</td>
                      <td>
                        <span class="badge bg-info">{{ $student->documents->count() }}</span>
                      </td>
                      <td>
                        @if($student->documents->count())
                          {{ $student->documents->pluck('document_name')->join(', ') }}
                        @else
                          <span class="text-muted">No documents</span>
                        @endif
                      </td>
                    </tr>
                  @empty
                    <tr><td colspan="4" class="text-center">No students found</td></tr>
                  @endforelse
                </tbody>
              </table>

              {{-- Pagination --}}
              <div class="d-flex justify-content-center mt-3">
                {{ $students->links('pagination::bootstrap-5') }}
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif





@endsection
