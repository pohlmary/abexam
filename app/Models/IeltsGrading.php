<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IeltsGrading extends Model
{
    use HasFactory;

    protected $table = 'ielts_gradings';

    protected $fillable = [
        'answer_id', 'graded_by', 'task_achievement', 'coherence',
        'lexical_resource', 'grammar', 'feedback', 'graded_at'
    ];

    protected $casts = [
        'graded_at' => 'datetime',
    ];

    public function answer()
    {
        return $this->belongsTo(IeltsAnswer::class, 'answer_id');
    }

    public function grader()
    {
        return $this->belongsTo(User::class, 'graded_by');
    }

    public function getAverageScore()
    {
        $scores = [
            $this->task_achievement,
            $this->coherence,
            $this->lexical_resource,
            $this->grammar,
        ];

        $validScores = array_filter($scores, fn($s) => $s !== null);
        return count($validScores) > 0 ? array_sum($validScores) / count($validScores) : 0;
    }
}
