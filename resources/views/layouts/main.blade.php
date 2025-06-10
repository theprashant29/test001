<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel Bootstrap') }}</title>

    <!-- Bootstrap CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @stack('styles') <!-- For additional styles -->
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    @php $user = Auth::user();
                      $role = $user->role ?? 'user';
                     @endphp

                    @if($role === 'admin')
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.create') }}">Create User</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard </a></li>

                     <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Categories</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ route('sub-categories.index') }}">Sub Categories</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ route('user.index') }}">Users</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ route('tasks.index') }}">Tasks</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('tasks.index') }}">Tasks</a></li>
                    @endif
                    <li class="nav-item">

                    <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link" style="display: inline; padding: 0; border: none; background: none;">
                        Logout
                        </button>
                    </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div> 
        @endif
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts') <!-- For additional scripts -->
</body>
</html>
