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
        Schema::table('reviews', function (Blueprint $table) {
            $table->tinyInteger('taste_rating')->nullable()->after('rating');
            $table->tinyInteger('price_rating')->nullable()->after('taste_rating');
            $table->tinyInteger('service_rating')->nullable()->after('price_rating');
            $table->tinyInteger('ambiance_rating')->nullable()->after('service_rating');
            $table->json('tags')->nullable()->after('ambiance_rating');
            $table->json('photos')->nullable()->after('tags');
            $table->boolean('is_anonymous')->default(false)->after('photos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn(['taste_rating', 'price_rating', 'service_rating', 'ambiance_rating', 'tags', 'photos', 'is_anonymous']);
        });
    }
};
