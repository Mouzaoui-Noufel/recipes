<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Recipe App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('recipes.index') }}">Recipes</a>
            <form class="d-flex" method="GET" action="{{ route('recipes.index') }}">
                <input class="form-control me-2" type="search" name="search" placeholder="Search...">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            @auth
                @if(auth()->user()->is_admin)
                    {{-- Removed admin dashboard button --}}
                @endif
                <form method="POST" action="{{ route('user.logout') }}" class="d-inline ms-3">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary ms-3">Login</a>
                <a href="{{ route('signin') }}" class="btn btn-outline-secondary ms-2">Sign Up</a>
            @endguest
        </div>
    </nav>
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
