@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            Dashboard
        </div>
        <div class="card-body">
           
           <form action="{{ route('sub-categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="category_id" class="form-label">Select Category</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Create Category</button>
            </form>

            <hr>

            
        </div>
    </div>
@endsection
