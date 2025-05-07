<?php
namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Notifications\NewRecipeNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RecipeController extends Controller
{
public function index()
{
    $search = request()->get('search', '');
    $page = request()->get('page', 1);

    $cacheKey = 'recipes_page_' . $page . '_search_' . md5($search);

    $recipes = Cache::remember($cacheKey, 60, function () use ($search) {
        $query = Recipe::with('category', 'user')
            ->withCount('ratings')
            ->withAvg('ratings', 'rating');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        return $query->paginate(6);
    });

    return view('recipes.index', compact('recipes'));
}

    public function create()
    {
        $categories = Category::all();
        return view('recipes.create', compact('categories'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'ingredients' => 'required|string',
        'steps' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'category_id' => 'nullable|exists:categories,id',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('recipes', 'public');
    }

    $validated['user_id'] = auth()->id();

    $recipe = Recipe::create($validated);

    $users = User::where('id', '!=', auth()->id())->get();
    Notification::send($users, new NewRecipeNotification($recipe));

    // Clear all cache to ensure new recipe shows up immediately
    Cache::flush();

    return redirect()->route('recipes.index')->with('success', 'Recipe created!');
}
    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        return view('recipes.edit', compact('recipe', 'categories'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'required|string',
            'steps' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            if ($recipe->image) Storage::disk('public')->delete($recipe->image);
            $validated['image'] = $request->file('image')->store('recipes', 'public');
        }

        $recipe->update($validated);

        \Illuminate\Support\Facades\Cache::forget('recipes');

        return redirect()->route('recipes.index')->with('success', 'Recipe updated!');
    }

    public function destroy(Recipe $recipe)
{
    // Delete image if it exists
    if ($recipe->image) {
        Storage::disk('public')->delete($recipe->image);
    }

    // Delete the recipe
    $recipe->forceDelete();


    // Grab search and page params from request
    $search = request()->get('search', '');
    $page = (int) request()->get('page', 1);

    // Define pagination limit
    $perPage = 5;

    // Get total recipe count *after* deletion
    $totalRecipes = Recipe::count();

    // Calculate the new last page
    $lastPage = max(1, (int) ceil($totalRecipes / $perPage));

    // Adjust page number if current page is out of bounds
    if ($page > $lastPage) {
        $page = $lastPage;
    }

    // Build query parameters array for redirection
    $queryParams = [];
    if ($page > 1) {
        $queryParams['page'] = $page;
    }
    if (!empty($search)) {
        $queryParams['search'] = $search;
    }

    // Clear the specific cached page
    Cache::forget('recipes_page_' . $page . '_search_' . md5($search));

    // Redirect to updated list with message
    return redirect()->route('recipes.index', $queryParams)
                     ->with('success', 'Recipe deleted successfully.');
}

    public function rate(Request $request, Recipe $recipe)
{
    $request->validate(['rating' => 'required|integer|between:1,5']);
    
    $recipe->ratings()->updateOrCreate(
        ['user_id' => auth()->id()],
        ['rating' => $request->rating]
    );
    
    return back()->with('success', 'Merci pour votre notation !');
}

public function comment(Request $request, Recipe $recipe)
{
    $request->validate(['content' => 'required|string|max:500']);
    
    $recipe->comments()->create([
        'user_id' => auth()->id(),
        'content' => $request->content
    ]);
    
    return back()->with('success', 'Commentaire ajouté !');
}
}