@extends('layout')

@section('title', 'Edit Task')

@section('content')
  <h1 class="h3 mb-4">Edit Task</h1>

  <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="row g-3">
    @csrf
    @method('PUT')

    <div class="col-md-6">
      <label class="form-label">User</label>
      <select name="user_id" class="form-select" required>
        @foreach($users as $user)
          <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label">Task title</label>
      <input type="text" name="judul" class="form-control" value="{{ $task->judul }}" required>
    </div>

    <div class="col-md-4">
      <label class="form-label">Goal</label>
      <select name="goal_id" class="form-select">
        <option value="">None</option>
        @foreach($goals as $goal)
          <option value="{{ $goal->id }}" {{ $task->goal_id == $goal->id ? 'selected' : '' }}>{{ $goal->title }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-4">
      <label class="form-label">Habit</label>
      <select name="habit_id" class="form-select">
        <option value="">None</option>
        @foreach($habits as $habit)
          <option value="{{ $habit->id }}" {{ $task->habit_id == $habit->id ? 'selected' : '' }}>{{ $habit->nama }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-4">
      <label class="form-label">Due date</label>
      <input type="date" name="tanggal" class="form-control" value="{{ $task->tanggal }}">
    </div>

    <div class="col-md-4">
      <label class="form-label">Priority</label>
      <select name="priority" class="form-select" required>
        <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
        <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
        <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
      </select>
    </div>

    <div class="col-md-4">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
      </select>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-success">Update Task</button>
      <a href="{{ route('tasks.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </div>
  </form>
@endsection
