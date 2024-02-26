<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    use HasFactory;

    protected $casts = [
        'past_mission' => 'array',
        'area_of_interest' => 'array',
        'spiritual_gift' => 'array',
        'skills' => 'array',
    ];

    protected $fillable = [
        'user_id',
        'course_of_study',
        'degree',
        'occupation',
        'professional_abilities',
        'past_mission',
        'area_of_interest',
        'spiritual_gift',
        'skills',
        'photo',
        'is_approved',
        'approver_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
