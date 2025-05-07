@extends('layouts.main')

@section('title', 'Recipes')

@section('content')
    <h1 class="mb-4">Recipes</h1>
    <a href="{{ route('recipes.create') }}" class="btn btn-primary mb-3">Add Recipe</a>
    @auth
        @if(auth()->user()->is_admin)
            {{-- Removed admin dashboard button --}}
        @endif
    @endauth

    @if($recipes->count())
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($recipes as $recipe)
                <div class="col">
                    <div class="card h-100">
                        @if($recipe->image_url)
                            <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" class="card-img-top" style="object-fit: cover; height: 200px;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $recipe->title }}</h5>
                            <p class="card-text">Rating: {{ number_format($recipe->ratings_avg_rating, 1) }} / 5 ({{ $recipe->ratings_count }} votes)</p>
                            <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                            <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary mt-auto">View Recipe</a>
                        </div>
                        
@auth
    @if($recipe->user_id === auth()->id())
        <div class="card-footer d-flex flex-column gap-2">
            <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm w-100">Delete</button>
            </form>
            <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning btn-sm w-100">Edit</a>
        </div>
    @endif
@endauth
                        
                    </div>
                </div>
            @endforeach
        </div>

        {{ $recipes->links() }}
    @else
        <p>No recipes found.</p>
    @endif
@endsection
