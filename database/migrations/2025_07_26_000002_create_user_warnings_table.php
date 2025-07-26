<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_warnings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('review_report_id')->constrained('review_reports')->onDelete('cascade');
            $table->enum('warning_type', ['first_warning', 'second_warning', 'final_warning']);
            $table->text('reason');
            $table->foreignId('issued_by')->constrained('users')->onDelete('cascade'); // Admin
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Index untuk tracking warnings
            $table->index(['user_id', 'is_active']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_warnings');
    }
};
