<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IeltsCertificate extends Model
{
    use HasFactory;

    protected $table = 'ielts_certificates';

    protected $fillable = [
        'result_id', 'certificate_number', 'file_path', 'issued_at', 'expires_at'
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function result()
    {
        return $this->belongsTo(IeltsResult::class, 'result_id');
    }

    public function isExpired()
    {
        return $this->expires_at && now()->isAfter($this->expires_at);
    }

    public function isValid()
    {
        return !$this->isExpired();
    }
}
