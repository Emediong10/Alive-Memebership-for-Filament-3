<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','content','slug','active'
    ];

    public function recipient()
    {
        return $this->hasMany(NewsRecipient::class);
    }

    public function group()
    {
        return $this->hasMany(NewsRecipient::class,'news_id');
    }
}


