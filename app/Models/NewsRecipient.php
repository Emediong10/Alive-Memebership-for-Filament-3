<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Illuminate\Database\Eloquent\Model;

class NewsRecipient extends Model
{
    use HasFilamentComments;
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function news()
    {
        return $this->belongsTo(News::class,'news_id');
    }

    public function getNameAttribute()
    {
        if($this->is_group)
        {
            return MemberType::where('id',$this->member_types_id)->first()->type;
        }
        else
        {
            return User::where('id', $this->user_id)->first()->name;
        }
    }

}
