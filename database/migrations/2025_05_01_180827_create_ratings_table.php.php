<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            
            // Clé étrangère pour l'utilisateur
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            
            // Clé étrangère pour la recette
            $table->foreignId('recipe_id')
                ->constrained()
                ->onDelete('cascade');
            
            // Note entre 1 et 5
            $table->unsignedTinyInteger('rating')
                ->default(1)
                ->comment('Rating value between 1 and 5');
            
            $table->timestamps();

            // Contrainte unique : 1 note par utilisateur par recette
            $table->unique(['user_id', 'recipe_id']);
        });

        // Contrainte de valeur pour la note (1-5)
        DB::statement('ALTER TABLE ratings ADD CONSTRAINT chk_rating_range CHECK (rating BETWEEN 1 AND 5)');
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};