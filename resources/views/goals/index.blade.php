@extends('layout')

@section('title', 'Goals')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="h3">Goal Management</h1>
        <p class="text-muted">Create, organize, and monitor the progress of your goals.</p>
      </div>
      <a href="{{ route('goals.create') }}" class="btn btn-success">Create New Goal</a>
    </div>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Progress</th>
                <th>Description</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($goals as $goal)
            <tr>
                <td>{{ $goal->id }}</td>
                <td>{{ $goal->title }}</td>
                <td>{{ $goal->category }}</td>
                <td>{{ $goal->progress }}%</td>
                <td>{{ Str::limit($goal->description, 60) }}</td>
                <td class="text-end">
                    <a href="{{ route('goals.edit', $goal->id) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                    <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this goal?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">No goals added yet.</td>
            </tr>
            @endforelse
        </tbody>
      </table>
    </div>
@endsection

