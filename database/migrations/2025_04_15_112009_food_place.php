<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the food_categories table
        Schema::create('food_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('food_places', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('min_price', 8, 2);
            $table->decimal('max_price', 8, 2);
            $table->string('location');
            $table->decimal('rating', 2, 1);
            $table->string('image')->nullable();
            $table->string('menu')->nullable();
            $table->timestamps();
            $table->foreignId('food_category_id')->references('id')->on('food_categories')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });

        // Create the food_items table
        Schema::create('food_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_place_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->timestamps();
        });
        // Create the food_reviews table
        Schema::create('food_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_place_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('review');
            $table->integer('rating');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //

    }
};
