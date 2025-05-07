@extends('layouts.main')

@section('title', 'Login')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4" style="width: 100%; max-width: 400px;">
        <h2 class="card-title text-center mb-4">Login to Your Account</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('user.login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control" />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" required class="form-control" />
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="{{ route('user.register') }}" class="btn btn-link">Register</a>
            </div>
        </form>
    </div>
</div>
@endsection
