<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IeltsOption extends Model
{
    use HasFactory;

    protected $table = 'ielts_options';

    protected $fillable = ['question_id', 'option_text', 'is_correct', 'order'];

    protected $casts = ['is_correct' => 'boolean'];

    public function question()
    {
        return $this->belongsTo(IeltsQuestion::class, 'question_id');
    }

    public function answers()
    {
        return $this->hasMany(IeltsAnswer::class, 'selected_option_id');
    }
}
