@extends('layouts.app')

@section('title', 'Students List')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">All Students</h5>
        <form method="GET" action="{{ route('dashboard') }}" class="d-flex">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm me-2" placeholder="Search name/email">
            <button class="btn btn-sm btn-outline-light">Search</button>
        </form>
    </div>

    <div class="card-body">
        @if($students->count())
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Document Count</th>
                            <th>Document Names</th>
                            <th>Created At</th>
                            <th>Last Modified</th>
                            <th>Documents</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr class="align-middle">
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->documents->first()->phone ?? '-' }}</td>
                                <td>{{ $student->documents->first()->gender ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-info px-3 py-2">
                                        {{ $student->documents->count() }}
                                    </span>
                                </td>
                                <td class="text-start">
                                    @if($student->documents->count())
                                        {{ $student->documents->pluck('document_name')->join(', ') }}
                                    @else
                                        <span class="text-muted">No documents</span>
                                    @endif
                                </td>
                                <td class="text-start">
                                    @if($student->documents->count())
                                        <ul class="list-unstyled mb-0">
                                            @foreach($student->documents as $doc)
                                                <li>{{ $doc->created_at->format('d M Y') }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-start">
                                    @if($student->documents->count())
                                        <ul class="list-unstyled mb-0">
                                            @foreach($student->documents as $doc)
                                                <li>{{ $doc->updated_at->format('d M Y') }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($student->documents->count())
                                        <div class="d-flex flex-wrap justify-content-center gap-1">
                                            @foreach($student->documents as $doc)
                                                <a href="{{ asset('storage/'.$doc->file_path) }}"
                                                   target="_blank"
                                                   class="btn btn-sm btn-outline-primary mb-1">
                                                   View {{ $doc->document_name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        @else
            <p class="text-muted text-center">No students found.</p>
        @endif
    </div>
</div>
@endsection
