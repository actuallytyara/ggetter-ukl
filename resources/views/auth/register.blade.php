@extends('layout')

@section('title','Register — GoalsGetter')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h3 class="mb-3">Create your account</h3>
          <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf
            <div class="mb-3">
              <label class="form-label">Full name</label>
              <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
              @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
              @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
              @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Confirm password</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="d-grid">
              <button class="btn btn-success">Create account</button>
            </div>
          </form>

          <div class="text-center mt-3">Already have an account? <a href="{{ route('login') }}">Login</a></div>
        </div>
      </div>
    </div>
  </div>
@endsection
