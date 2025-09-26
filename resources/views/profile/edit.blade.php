@extends('layouts.app')

@section('title','My Profile')

@section('content')
<div class="card shadow-sm">
  <div class="card-header">My Profile</div>
  <div class="card-body">

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Profile Update Form --}}
    <form method="POST" action="{{ route('profile.update') }}">
      @csrf
      @method('PATCH')

      <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name',$user->name) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email',$user->email) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">New Password (optional)</label>
        <input type="password" name="password" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

    <hr>

    {{-- Account Delete Form --}}
    <form method="POST" action="{{ route('profile.destroy') }}" 
          onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Delete Account</button>
    </form>

  </div>
</div>
@endsection
