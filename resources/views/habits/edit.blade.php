@extends('layout')

@section('title', 'Edit Habit')

@section('content')
  <h1 class="h3 mb-4">Edit Habit</h1>

  <form action="{{ route('habits.update', $habit->id) }}" method="POST" class="row g-3">
    @csrf
    @method('PUT')

    <div class="col-md-6">
      <label class="form-label">User</label>
      <select name="user_id" class="form-select" required>
        @foreach($users as $user)
          <option value="{{ $user->id }}" {{ $habit->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label">Habit name</label>
      <input type="text" name="nama" class="form-control" value="{{ $habit->nama }}" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Frequency</label>
      <select name="frekuensi" class="form-select" required>
        <option value="daily" {{ $habit->frekuensi == 'daily' ? 'selected' : '' }}>Daily</option>
        <option value="weekly" {{ $habit->frekuensi == 'weekly' ? 'selected' : '' }}>Weekly</option>
        <option value="monthly" {{ $habit->frekuensi == 'monthly' ? 'selected' : '' }}>Monthly</option>
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="active" {{ $habit->status == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ $habit->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
      </select>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-success">Update Habit</button>
      <a href="{{ route('habits.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </div>
  </form>
@endsection
