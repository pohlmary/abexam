<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ielts_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('ielts_tests')->onDelete('cascade');
            $table->enum('section_type', ['listening', 'reading', 'writing', 'speaking']);
            $table->integer('time_limit')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->unique(['test_id', 'section_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ielts_sections');
    }
};
