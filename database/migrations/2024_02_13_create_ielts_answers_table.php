<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ielts_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attempt_id')->constrained('ielts_attempts')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('ielts_questions')->onDelete('cascade');
            $table->text('answer_text')->nullable();
            $table->foreignId('selected_option_id')->nullable()->constrained('ielts_options')->onDelete('set null');
            $table->integer('score')->default(0);
            $table->boolean('is_correct')->nullable();
            $table->timestamp('answered_at');
            $table->timestamps();
            
            $table->index(['attempt_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ielts_answers');
    }
};
