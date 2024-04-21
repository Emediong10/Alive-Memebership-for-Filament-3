<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type_id',
        'name',
        'start_date',
        'end_date',	
        'venue',	
        'is_paid_event',
        'event_fees',	
        'event_fees_currency',
        'description',
        'event_flyer',
        'active'
    ] ;

    public function applicants()
    {
        return $this->hasMany(EventApplicants::class);
    }

    public function event_type()
    {
        return $this->belongsTo(EventType::class);
    }
}
