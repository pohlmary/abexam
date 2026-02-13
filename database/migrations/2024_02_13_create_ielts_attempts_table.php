<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ielts_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('test_id')->constrained('ielts_tests')->onDelete('cascade');
            $table->timestamp('started_at');
            $table->timestamp('finished_at')->nullable();
            $table->enum('status', ['in_progress', 'submitted', 'graded'])->default('in_progress');
            $table->integer('time_spent')->default(0);
            $table->string('ip_address')->nullable();
            $table->integer('tab_switches')->default(0);
            $table->integer('listening_score')->default(0);
            $table->integer('reading_score')->default(0);
            $table->integer('writing_score')->default(0);
            $table->integer('speaking_score')->default(0);
            $table->integer('total_score')->default(0);
            $table->decimal('overall_band', 3, 1)->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'test_id']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ielts_attempts');
    }
};
