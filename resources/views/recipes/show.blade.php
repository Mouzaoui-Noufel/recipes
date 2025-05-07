@extends('layouts.main')

@section('title', $recipe->title)

@section('content')
    <h1 class="mb-4">{{ $recipe->title }}</h1>

    <div class="row">
        <div class="col-md-4">
            @if($recipe->image_url)
                <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" class="img-fluid rounded mb-3">
            @endif
            <p><strong>Category:</strong> {{ $recipe->category ? $recipe->category->name : 'Uncategorized' }}</p>
            <h3>Average Rating: {{ number_format($recipe->average_rating, 1) }} / 5</h3>
        </div>
        <div class="col-md-8">
            <p><strong>Description:</strong> {{ $recipe->description }}</p>

            <h3>Ingredients</h3>
            <p>{!! nl2br(e($recipe->ingredients)) !!}</p>

            <h3>Steps</h3>
            <p>{!! nl2br(e($recipe->steps)) !!}</p>

            <h3>Rate this recipe</h3>
            @auth
                <form action="{{ route('recipes.rate', $recipe) }}" method="POST" class="mb-3">
                    @csrf
                    <select name="rating" class="form-select w-auto d-inline-block" required>
                        <option value="">Select rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} star{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            @else
                <p><a href="{{ route('login') }}">Log in</a> to rate this recipe.</p>
            @endauth

            <h3>Comments</h3>
            @foreach($recipe->comments as $comment)
                <div class="mb-2">
                    <strong>{{ $comment->user->name }}</strong> said:<br>
                    {{ $comment->content }}
                </div>
            @endforeach

            @auth
                <form action="{{ route('recipes.comment', $recipe) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="content" class="form-label">Add a comment</label>
                        <textarea name="content" id="content" rows="3" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
            @else
                <p><a href="{{ route('login') }}">Log in</a> to comment on this recipe.</p>
            @endauth
        </div>
    </div>
@endsection
