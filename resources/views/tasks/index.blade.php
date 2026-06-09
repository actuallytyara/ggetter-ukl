@extends('layout')

@section('title', 'Tasks & Scheduling')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h3">Tasks & Scheduling</h1>
      <p class="text-muted">Plan tasks, assign priorities, and keep your schedule on track.</p>
    </div>
    <a href="{{ route('tasks.create') }}" class="btn btn-success">New Task</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="table-responsive">
    <table class="table table-striped align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Task</th>
          <th>User</th>
          <th>Goal / Habit</th>
          <th>Due</th>
          <th>Priority</th>
          <th>Status</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($tasks as $task)
          <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->judul }}</td>
            <td>{{ $task->user->name ?? 'Guest' }}</td>
            <td>
              @if($task->goal)
                Goal: {{ $task->goal->title }}
              @elseif($task->habit)
                Habit: {{ $task->habit->nama }}
              @else
                —
              @endif
            </td>
            <td>{{ $task->tanggal ? \Illuminate\Support\Carbon::parse($task->tanggal)->format('M d, Y') : 'No date' }}</td>
            <td>{{ ucfirst($task->priority) }}</td>
            <td>{{ ucfirst($task->status) }}</td>
            <td class="text-end">
              <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
              <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this task?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center text-muted">No tasks yet. Create one to stay on schedule.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
