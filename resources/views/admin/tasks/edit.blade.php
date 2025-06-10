@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h3>Edit Task</h3>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Select Sub Category</label>
            <select name="sub_id" class="form-select">
                <option value="">-- Select Sub Category --</option>
                @foreach ($subcategories as $subcategorie)
                    <option value="{{ $subcategorie->id }}" {{ old('sub_id', $task->sub_id) == $subcategorie->id ? 'selected' : '' }}>
                        {{ $subcategorie->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $task->title) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">User</label>
            <select name="user_id" class="form-select">
                <option value="">-- Select User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $task->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Options</label>
            <input type="text" name="option1" class="form-control mb-1" placeholder="Option 1" value="{{ old('option1', $task->option1) }}">
            <input type="text" name="option2" class="form-control mb-1" placeholder="Option 2" value="{{ old('option2', $task->option2) }}">
            <input type="text" name="option3" class="form-control mb-1" placeholder="Option 3" value="{{ old('option3', $task->option3) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label><br>
            @if ($task->image)
                <img src="{{ asset('storage/' . $task->image) }}" alt="Task Image" width="100" class="mb-2"><br>
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</div>
@endsection
