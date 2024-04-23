<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventApplicants extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'event_id',
        'user_id',
        'transaction_reference',
        'amount_paid',
        'payment_method',
        'approval_status',
        'confirm_attendance',
        'attendance_confirmed',
        'comments',	
        'payment_evidence',
        'supplementary_payments'
    ];

    protected $casts = [
        'supplementary_payments'=>'array'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
