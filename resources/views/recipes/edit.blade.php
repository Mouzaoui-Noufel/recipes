<!-- resources/views/recipes/edit.blade.php -->
@extends('layouts.main')

@section('title', 'Edit Recipe')

@section('content')
    <h1 class="mb-4">Edit Recipe</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Recipe Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $recipe->title }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $recipe->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $recipe->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredients</label>
            <textarea class="form-control" id="ingredients" name="ingredients" rows="5" required>{{ $recipe->ingredients }}</textarea>
        </div>

        <div class="mb-3">
            <label for="steps" class="form-label">Steps</label>
            <textarea class="form-control" id="steps" name="steps" rows="5" required>{{ $recipe->steps }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Recipe Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($recipe->image)
                <div class="mt-2">
                    <small>Current Image:</small><br>
                    <img src="{{ asset('storage/'.$recipe->image) }}" class="img-thumbnail" style="max-height: 100px">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Recipe</button>
        <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection