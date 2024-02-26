<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $casts=[
        'answers'=>'array',
        
    ];

    public function chapter()
    {
       return $this->belongsTo(Chapter::class);
    }

    public function member_type()
    {
        return $this->belongsTo(MemberType::class);
    }

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function news_recipient()
    {
    return $this->belongsTo(NewsRecipient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
