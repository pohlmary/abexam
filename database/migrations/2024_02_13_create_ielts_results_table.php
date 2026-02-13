<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ielts_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attempt_id')->constrained('ielts_attempts')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('test_id')->constrained('ielts_tests')->onDelete('cascade');
            $table->integer('listening_score')->default(0);
            $table->integer('reading_score')->default(0);
            $table->integer('writing_score')->default(0);
            $table->integer('speaking_score')->default(0);
            $table->integer('total_score')->default(0);
            $table->decimal('band_score', 3, 1)->nullable();
            $table->boolean('passed')->default(false);
            $table->text('examiner_feedback')->nullable();
            $table->foreignId('examiner_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('graded_at')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'test_id']);
            $table->index('passed');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ielts_results');
    }
};
