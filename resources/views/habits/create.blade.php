@extends('layout')

@section('title', 'Create Habit')

@section('content')
  <h1 class="h3 mb-4">Create New Habit</h1>

  <form action="{{ route('habits.store') }}" method="POST" class="row g-3">
    @csrf

    <div class="col-md-6">
      <label class="form-label">Habit name</label>
      <input type="text" name="nama" class="form-control" required placeholder="Example: Morning journaling">
    </div>

    <div class="col-md-6">
      <label class="form-label">Frequency</label>
      <select name="frekuensi" class="form-select" required>
        <option value="daily">Daily</option>
        <option value="weekly">Weekly</option>
        <option value="monthly">Monthly</option>
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
      </select>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-success">Save Habit</button>
      <a href="{{ route('habits.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </div>
  </form>
@endsection
