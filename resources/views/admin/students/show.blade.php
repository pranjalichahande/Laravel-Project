<!-- @extends('layouts.app')

@section('title', 'Student Profile')

@section('content')
<div class="row">
  Profile Card 
  <div class="col-lg-4 mb-3">
    <div class="card shadow-sm border-0 text-center">
      <div class="card-body">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&background=0D8ABC&color=fff&size=100" 
             class="rounded-circle shadow mb-3" alt="profile">
        <h4 class="mb-1">{{ $student->name }}</h4>
        <p class="text-muted mb-1">{{ $student->email }}</p>
        <p class="mb-1"><strong>Phone:</strong> {{ $student->documents->first()->phone ?? '-' }}</p>
        <p class="mb-1"><strong>Gender:</strong> {{ $student->documents->first()->gender ?? '-' }}</p>
        <p><strong>Total Documents:</strong> {{ $student->documents->count() }}</p>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary mt-2 w-100">⬅ Back to Dashboard</a>
      </div>
    </div>
  </div>

  Documents Table
  <div class="col-lg-8 mb-3">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Uploaded Documents</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered align-middle">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Document Name</th>
                <th>File</th>
                <th>Uploaded At</th>
              </tr>
            </thead>
            <tbody>
              @forelse($student->documents as $index => $doc)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $doc->document_name }}</td>
                  <td>
                    <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" 
                       class="btn btn-sm btn-outline-primary">View</a>
                  </td>
                  <td>{{ $doc->created_at->format('d M Y, h:i A') }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center text-muted">No documents uploaded</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
 -->