@extends('layouts.main')

@section('title', 'Admin Dashboard')

@section('content')
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="list-group">
        <a href="{{ route('recipes.index') }}" class="list-group-item list-group-item-action">
            Manage Recipes
        </a>
        <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action">
            Manage Users
        </a>
        <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action">
            Manage Categories
        </a>
    </div>
@endsection
