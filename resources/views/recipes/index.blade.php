@extends('layouts.main')

@section('title', 'Recipes')

@section('content')
    <h1 class="mb-4">Recipes</h1>
    <a href="{{ route('recipes.create') }}" class="btn btn-primary mb-3">Add Recipe</a>
    @auth
        @if(auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3 ms-2">Admin Dashboard</a>
        @endif
    @endauth

    @if($recipes->count())
        <div class="list-group">
            @foreach($recipes as $recipe)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('recipes.show', $recipe) }}" class="flex-grow-1 text-decoration-none text-dark">
                        <h5>{{ $recipe->title }}</h5>
                        <p>Rating: {{ number_format($recipe->ratings_avg_rating, 1) }} / 5 ({{ $recipe->ratings_count }} votes)</p>
                        <p>{{ Str::limit($recipe->description, 100) }}</p>
                    </a>
                    @auth
                        @if($recipe->user_id === auth()->id())
                            <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm ms-3">Delete</button>
                            </form>
                        @endif
                    @endauth
                </div>
            @endforeach
        </div>

        {{ $recipes->links() }}
    @else
        <p>No recipes found.</p>
    @endif
@endsection
