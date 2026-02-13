<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IeltsTest extends Model
{
    use HasFactory;

    protected $table = 'ielts_tests';

    protected $fillable = [
        'title', 'description', 'type', 'status', 'total_time', 'created_by', 'is_published', 'price'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function sections()
    {
        return $this->hasMany(IeltsSection::class, 'test_id');
    }

    public function attempts()
    {
        return $this->hasMany(IeltsAttempt::class, 'test_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getListeningSection()
    {
        return $this->sections()->where('section_type', 'listening')->first();
    }

    public function getReadingSection()
    {
        return $this->sections()->where('section_type', 'reading')->first();
    }

    public function getWritingSection()
    {
        return $this->sections()->where('section_type', 'writing')->first();
    }

    public function getSpeakingSection()
    {
        return $this->sections()->where('section_type', 'speaking')->first();
    }
}
