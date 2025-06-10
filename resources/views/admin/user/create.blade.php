@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            Dashboard
        </div>
        <div class="card-body">
           
           <form action="{{ route('user.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="name" class="form-label"> Name</label>
                    <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name" required>
                </div>

                  <div class="mb-3">
                    <label for="name" class="form-label"> Email</label>
                    <input type="text" class="form-control" id="name" value="{{ old('email') }}" name="email" required>
                </div>
               

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">   
                </div>

              
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select">
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Create </button>
            </form>

            <hr>

            
        </div>
    </div>
@endsection
