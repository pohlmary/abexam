<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IeltsQuestion extends Model
{
    use HasFactory;

    protected $table = 'ielts_questions';

    protected $fillable = [
        'section_id', 'question_text', 'question_type', 'audio_url', 'image_url', 'marks', 'order', 'explanation'
    ];

    public function section()
    {
        return $this->belongsTo(IeltsSection::class, 'section_id');
    }

    public function options()
    {
        return $this->hasMany(IeltsOption::class, 'question_id')->orderBy('order');
    }

    public function answers()
    {
        return $this->hasMany(IeltsAnswer::class, 'question_id');
    }

    public function getCorrectOption()
    {
        return $this->options()->where('is_correct', true)->first();
    }
}
