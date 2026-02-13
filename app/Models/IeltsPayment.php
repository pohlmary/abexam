<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IeltsPayment extends Model
{
    use HasFactory;

    protected $table = 'ielts_payments';

    protected $fillable = [
        'user_id', 'test_id', 'amount', 'currency', 'payment_method',
        'transaction_id', 'status', 'response_data', 'paid_at'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'response_data' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function test()
    {
        return $this->belongsTo(IeltsTest::class, 'test_id');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
            'paid_at' => now(),
        ]);
    }

    public function markAsFailed()
    {
        $this->update(['status' => 'failed']);
    }
}
