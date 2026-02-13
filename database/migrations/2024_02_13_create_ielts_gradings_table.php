<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ielts_gradings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('answer_id')->constrained('ielts_answers')->onDelete('cascade');
            $table->foreignId('graded_by')->constrained('users')->onDelete('cascade');
            $table->integer('task_achievement')->nullable();
            $table->integer('coherence')->nullable();
            $table->integer('lexical_resource')->nullable();
            $table->integer('grammar')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamp('graded_at')->nullable();
            $table->timestamps();
            
            $table->index('answer_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ielts_gradings');
    }
};
