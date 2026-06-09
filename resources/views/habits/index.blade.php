@extends('layout')

@section('title', 'Habit Tracker')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h3">Habit Tracker</h1>
      <p class="text-muted">Track your daily, weekly, and monthly habits in one place.</p>
    </div>
    <a href="{{ route('habits.create') }}" class="btn btn-success">Add Habit</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="table-responsive">
    <table class="table table-striped align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Habit</th>
          <th>User</th>
          <th>Frequency</th>
          <th>Status</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($habits as $habit)
          <tr>
            <td>{{ $habit->id }}</td>
            <td>{{ $habit->nama }}</td>
            <td>{{ $habit->user->name ?? 'Guest' }}</td>
            <td>{{ ucfirst($habit->frekuensi) }}</td>
            <td>{{ ucfirst($habit->status) }}</td>
            <td class="text-end">
              <a href="{{ route('habits.edit', $habit->id) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
              <form action="{{ route('habits.destroy', $habit->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this habit?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center text-muted">No habits yet. Start by creating one.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
