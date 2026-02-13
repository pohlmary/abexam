<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IeltsSection extends Model
{
    use HasFactory;

    protected $table = 'ielts_sections';

    protected $fillable = ['test_id', 'section_type', 'time_limit', 'order'];

    public function test()
    {
        return $this->belongsTo(IeltsTest::class, 'test_id');
    }

    public function questions()
    {
        return $this->hasMany(IeltsQuestion::class, 'section_id')->orderBy('order');
    }

    public function getTotalQuestions()
    {
        return $this->questions()->count();
    }
}
