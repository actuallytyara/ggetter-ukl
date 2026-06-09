@extends('layout')

@section('title', 'Create Goal')

@section('content')
    <h1>Create New Goal</h1>
    
    <form action="{{ route('goals.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="title">Goal title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="category">Category</label>
            <select name="category" id="category" class="form-select" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->nama }}">{{ $category->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="progress">Progress (%)</label>
            <input type="number" name="progress" id="progress" min="0" max="100" value="0" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('goals.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
@endsection

