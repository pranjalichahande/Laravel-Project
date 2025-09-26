<div class="d-flex flex-column flex-shrink-0 p-3 bg-light shadow-sm" style="width: 250px; min-height: 92vh;">
  <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
    <span class="fs-5 fw-bold">Menu</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : 'text-dark' }}">
        <i class="bi bi-house-door me-2"></i> Dashboard
      </a>
    </li>

    @if(auth()->user()->role === 'student')
      <li>
        <a href="{{ route('student.documents.create') }}" class="nav-link {{ request()->routeIs('student.documents.create') ? 'active' : 'text-dark' }}">
          <i class="bi bi-upload me-2"></i> Upload Document
        </a>
      </li>
      <li>
        <a href="{{ route('student.documents.index') }}" class="nav-link {{ request()->routeIs('student.documents.index') ? 'active' : 'text-dark' }}">
          <i class="bi bi-folder me-2"></i> My Documents
        </a>
      </li>
    @endif

    @if(auth()->user()->role === 'admin')
      <li>
        <a href="{{ route('admin.students.index') }}" class="nav-link {{ request()->routeIs('admin.students.index') ? 'active' : 'text-dark' }}">
          <i class="bi bi-people me-2"></i> Students
        </a>
      </li>
    @endif
  </ul>
  <hr>
  <div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="btn btn-danger w-100">Logout</button>
    </form>
  </div>
</div>
