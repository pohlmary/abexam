<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IeltsAttempt extends Model
{
    use HasFactory;

    protected $table = 'ielts_attempts';

    protected $fillable = [
        'user_id', 'test_id', 'started_at', 'finished_at', 'overall_band',
        'listening_score', 'reading_score', 'writing_score', 'speaking_score',
        'total_score', 'status', 'time_spent', 'ip_address', 'tab_switches'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function test()
    {
        return $this->belongsTo(IeltsTest::class, 'test_id');
    }

    public function answers()
    {
        return $this->hasMany(IeltsAnswer::class, 'attempt_id');
    }

    public function result()
    {
        return $this->hasOne(IeltsResult::class, 'attempt_id');
    }

    public function getRemainingTime()
    {
        $elapsed = now()->diffInSeconds($this->started_at);
        $total = $this->test->total_time * 60;
        return max(0, $total - $elapsed);
    }

    public function isTimeExpired()
    {
        return $this->getRemainingTime() <= 0;
    }

    public function getProgress()
    {
        $total = $this->test->sections()->sum(fn($s) => $s->questions()->count());
        $answered = $this->answers()->count();
        return $total > 0 ? ($answered / $total) * 100 : 0;
    }
}
