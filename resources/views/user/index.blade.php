@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Welcome, {{ Auth::user()->name }}!</h2>
        
    </div>

    <h4 class="mt-4">Your Tasks</h4>

    @if($tasks->isEmpty())
        <div class="alert alert-info mt-3">
            No tasks assigned yet.
        </div>
    @else
        <ul class="list-group mt-3">
            @foreach($tasks as $task)
                <li class="list-group-item">
                    <strong>{{ $task->title ?? 'Untitled Task' }}</strong><br>
                    Description: {{ $task->description ?? 'N/A' }}<br>
                    <small class="text-muted">Task ID: {{ $task->id }}</small>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
