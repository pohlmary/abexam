<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ielts_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('ielts_questions')->onDelete('cascade');
            $table->text('option_text');
            $table->boolean('is_correct')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->index('question_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ielts_options');
    }
};
