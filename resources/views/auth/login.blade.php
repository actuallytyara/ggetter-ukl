@extends('layout')

@section('title','Login — GoalsGetter')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h3 class="mb-3">Welcome back</h3>
          <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
              @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Password</label>
              <div class="input-group">
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">Show</button>
                @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
              </div>
          
            </div>

            <div class="d-grid">
              <button class="btn btn-success">Login</button>
            </div>
          </form>

          <div class="text-center mt-3">Don't have an account? <a href="{{ route('register') }}">Register</a></div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  document.getElementById('togglePassword')?.addEventListener('click', ()=>{
    const pw = document.getElementById('password'); if(!pw) return; pw.type = pw.type === 'password' ? 'text' : 'password';
    document.getElementById('togglePassword').textContent = pw.type==='password' ? 'Show' : 'Hide';
  });
</script>
@endpush
