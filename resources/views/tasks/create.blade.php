@extends('layout')

@section('title', 'Create Task')

@section('content')
  <h1 class="h3 mb-4">Create New Task</h1>

  <form action="{{ route('tasks.store') }}" method="POST" class="row g-3">
    @csrf

    <div class="col-md-6">
      <label class="form-label">Task title</label>
      <input type="text" name="judul" class="form-control" required placeholder="Complete daily review">
    </div>

    <div class="col-md-4">
      <label class="form-label">Goal</label>
      <select name="goal_id" class="form-select">
        <option value="">None</option>
        @foreach($goals as $goal)
          <option value="{{ $goal->id }}">{{ $goal->title }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-4">
      <label class="form-label">Habit</label>
      <select name="habit_id" class="form-select">
        <option value="">None</option>
        @foreach($habits as $habit)
          <option value="{{ $habit->id }}">{{ $habit->nama }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-4">
      <label class="form-label">Due date</label>
      <input type="date" name="tanggal" class="form-control">
    </div>

    <div class="col-md-4">
      <label class="form-label">Priority</label>
      <select name="priority" class="form-select" required>
        <option value="low">Low</option>
        <option value="medium" selected>Medium</option>
        <option value="high">High</option>
      </select>
    </div>

    <div class="col-md-4">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
      </select>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-success">Save Task</button>
      <a href="{{ route('tasks.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </div>
  </form>
@endsection
