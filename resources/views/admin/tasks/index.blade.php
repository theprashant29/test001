@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h3>Tasks</h3>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">+ Add New Task</a>



    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>User</th>
                <th>Options</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->user->name ?? 'N/A' }}</td>
                    <td>{{ $task->option1 }}, {{ $task->option2 }}, {{ $task->option3 }}</td>
                    <td>
                        @if($task->image)
                            <img src="{{ asset('storage/' . $task->image) }}" width="80">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No tasks found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
