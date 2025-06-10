@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h3>Add New Task</h3>

  

    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

         <div class="mb-3">
            <label class="form-label"> Select Sub Categories</label>
            <select name="sub_id" class="form-select">
                <option value="">-- Select Sub Categories --</option>
                @foreach ($subcategories as $subcategorie)
                    <option value="{{ $subcategorie->id }}" {{ old('sub_id') == $subcategorie->id ? 'selected' : '' }}>
                        {{ $subcategorie->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">User</label>
            <select name="user_id" class="form-select">
                <option value="">-- Select User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Options</label>
            <input type="text" name="option1" placeholder="Option 1" class="form-control mb-1" value="{{ old('option1') }}">
            <input type="text" name="option2" placeholder="Option 2" class="form-control mb-1" value="{{ old('option2') }}">
            <input type="text" name="option3" placeholder="Option 3" class="form-control mb-1" value="{{ old('option3') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-success">Create Task</button>
    </form>
</div>
@endsection
