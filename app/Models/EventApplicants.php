<?php

namespace App\Models;

use App\Models\User;
use App\Models\Event;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventApplicants extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $fillable = [
    //     'event_id',
    //     'user_id',
    //     'event_id',
    //     'user_id',
    //     'transaction_reference',
    //     'amount_paid',
    //     'payment_method',
    //     'approval_status',
    //     'confirm_attendance',
    //     'attendance_confirmed',
    //     'comments',	
    //     'payment_evidence',
    //     'supplementary_payments'
    // ];

    protected $casts = [
        'supplementary_payments'=>'array'
    ];


    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
