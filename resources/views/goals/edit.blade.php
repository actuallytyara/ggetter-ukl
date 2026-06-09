@extends('layout')

@section('title', 'Edit Goal')

@section('content')
    <h1>Edit Goal</h1>
    
    <form action="{{ route('goals.update', $goal->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label for="title">Goal title</label>
            <input type="text" name="title" id="title" value="{{ $goal->title }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="category">Category</label>
            <select name="category" id="category" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->nama }}" {{ $goal->category === $category->nama ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ $goal->description }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="progress">Progress (%)</label>
            <input type="number" name="progress" id="progress" min="0" max="100" value="{{ $goal->progress }}" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('goals.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
@endsection

