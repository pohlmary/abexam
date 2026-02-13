<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ielts_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('ielts_sections')->onDelete('cascade');
            $table->text('question_text');
            $table->enum('question_type', ['multiple_choice', 'true_false_not_given', 'matching', 'fill_blank', 'short_answer', 'essay']);
            $table->string('audio_url')->nullable();
            $table->string('image_url')->nullable();
            $table->integer('marks')->default(1);
            $table->integer('order')->default(0);
            $table->text('explanation')->nullable();
            $table->timestamps();
            
            $table->index('section_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ielts_questions');
    }
};
