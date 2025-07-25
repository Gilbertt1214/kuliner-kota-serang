<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('food_place_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_place_id')->constrained()->onDelete('cascade');
            $table->string('image_path');
            $table->enum('type', ['business', 'menu'])->default('business');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('food_place_images');
    }
};
