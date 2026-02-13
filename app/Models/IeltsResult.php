<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IeltsResult extends Model
{
    use HasFactory;

    protected $table = 'ielts_results';

    protected $fillable = [
        'attempt_id', 'user_id', 'test_id', 'listening_score', 'reading_score',
        'writing_score', 'speaking_score', 'total_score', 'band_score', 'passed',
        'examiner_feedback', 'examiner_id', 'graded_at'
    ];

    protected $casts = [
        'passed' => 'boolean',
        'graded_at' => 'datetime',
    ];

    public function attempt()
    {
        return $this->belongsTo(IeltsAttempt::class, 'attempt_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function test()
    {
        return $this->belongsTo(IeltsTest::class, 'test_id');
    }

    public function examiner()
    {
        return $this->belongsTo(User::class, 'examiner_id');
    }

    public function calculateBandScore()
    {
        $average = ($this->listening_score + $this->reading_score + 
                   $this->writing_score + $this->speaking_score) / 4;
        
        if ($average >= 90) $this->band_score = 9.0;
        elseif ($average >= 85) $this->band_score = 8.5;
        elseif ($average >= 80) $this->band_score = 8.0;
        elseif ($average >= 75) $this->band_score = 7.5;
        elseif ($average >= 70) $this->band_score = 7.0;
        elseif ($average >= 65) $this->band_score = 6.5;
        elseif ($average >= 60) $this->band_score = 6.0;
        else $this->band_score = 5.5;

        return $this;
    }

    public function checkPassed()
    {
        $this->passed = $this->total_score >= 60;
        return $this;
    }

    public function isPassed()
    {
        return $this->passed;
    }

    public function getGrade()
    {
        if ($this->band_score >= 8.5) return 'A';
        if ($this->band_score >= 7.5) return 'B';
        if ($this->band_score >= 6.5) return 'C';
        if ($this->band_score >= 5.5) return 'D';
        return 'F';
    }
}
