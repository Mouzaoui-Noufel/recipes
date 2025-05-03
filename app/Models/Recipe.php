<?php
// app/Models/Recipe.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'ingredients',
        'steps',
        'image',
        'category_id',
        'user_id'
    ];

    // Relation avec la catégorie
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Relation avec l'utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec les commentaires
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // Relation avec les notes
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    // Relation many-to-many avec les tags
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    // Scope pour les recettes populaires
    public function scopePopular($query)
    {
        return $query->withCount('ratings')
            ->orderByDesc('ratings_count');
    }

    // Scope pour la recherche
    public function scopeSearch($query, $term)
    {
        return $query->where('title', 'like', "%$term%")
            ->orWhere('description', 'like', "%$term%");
    }

    // Accessor pour la note moyenne
    public function getAverageRatingAttribute(): float
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    // Accessor pour l'URL de l'image
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}