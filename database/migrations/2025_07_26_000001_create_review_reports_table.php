<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('review_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->constrained('reviews')->onDelete('cascade');
            $table->foreignId('reporter_id')->constrained('users')->onDelete('cascade'); // Pengusaha yang melaporkan
            $table->foreignId('food_place_id')->constrained('food_places')->onDelete('cascade');
            $table->enum('reason', [
                'spam',
                'inappropriate_content',
                'fake_review',
                'harassment',
                'off_topic',
                'other'
            ]);
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null'); // Admin yang review
            $table->text('admin_notes')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();

            // Index untuk performa
            $table->index(['status', 'created_at']);
            $table->index(['food_place_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('review_reports');
    }
};
