@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            Dashboard
        </div>
        <div class="card-body">
           
           <form action="{{ route('categories.update', $cat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $cat->id }}">
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" value="{{ old('name', $cat->name) }}" name="name" required>
                </div>
               
                <button type="submit" class="btn btn-primary">Create Category</button>
            </form>

            <hr>

            
        </div>
    </div>
@endsection
