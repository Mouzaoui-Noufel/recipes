@extends('layouts.main')

@section('title', 'Register')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light px-4">
    <div class="card p-4" style="width: 100%; max-width: 400px;">
        <h2 class="card-title text-center mb-4">Register</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('user.register') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control" />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control" />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" required class="form-control" />
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control" />
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary">Register</button>
                <a href="{{ route('user.login') }}" class="btn btn-link">Login</a>
            </div>
        </form>
    </div>
</div>
@endsection
