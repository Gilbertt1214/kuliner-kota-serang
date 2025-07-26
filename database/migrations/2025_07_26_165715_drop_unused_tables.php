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
        // Drop food_items table if it exists
        Schema::dropIfExists('food_items');
        
        // Drop food_reviews table if it exists  
        Schema::dropIfExists('food_reviews');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Note: We're not recreating these tables in down() method
        // since they're unused and we want to permanently remove them.
        // If you need to restore them, you'll need to create new migrations
        // with the original table structure.
    }
};
