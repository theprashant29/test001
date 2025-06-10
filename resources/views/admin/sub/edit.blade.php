@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            Dashboard
        </div>
        <div class="card-body">
           
          

<form action="{{ route('sub-categories.update', $subcategory->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Subcategory Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Subcategory Name</label>
        <input type="text" name="name" class="form-control" id="name"
               value="{{ old('name', $subcategory->name) }}">
    </div>

    <!-- Parent Category Select -->
    <div class="mb-3">
        <label for="category_id" class="form-label">Parent Category</label>
        <select name="category_id" id="category_id" class="form-select">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Update</button>
</form>


            <hr>

            
        </div>
    </div>
@endsection
