<!-- resources/views/recipes/create.blade.php -->
@extends('layouts.main')

@section('title', 'Add New Recipe')

@section('content')
    <h1 class="mb-4">Add New Recipe</h1>
    
    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label">Recipe Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredients</label>
            <textarea class="form-control" id="ingredients" name="ingredients" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="steps" class="form-label">Steps</label>
            <textarea class="form-control" id="steps" name="steps" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Recipe Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Save Recipe</button>
        <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection