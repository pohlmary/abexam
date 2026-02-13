<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IeltsAnswer extends Model
{
    use HasFactory;

    protected $table = 'ielts_answers';

    protected $fillable = [
        'attempt_id', 'question_id', 'answer_text', 'selected_option_id', 'score', 'is_correct', 'answered_at'
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'answered_at' => 'datetime',
    ];

    public function attempt()
    {
        return $this->belongsTo(IeltsAttempt::class, 'attempt_id');
    }

    public function question()
    {
        return $this->belongsTo(IeltsQuestion::class, 'question_id');
    }

    public function selectedOption()
    {
        return $this->belongsTo(IeltsOption::class, 'selected_option_id');
    }
}
