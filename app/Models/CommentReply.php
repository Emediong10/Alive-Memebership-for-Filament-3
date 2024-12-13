<?php

namespace App\Models;
use App\Models\User;
use App\Models\NewsRecipient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;

    protected $fillable = ['comment_id', 'user_id', 'reply'];

    public function comment()
    {
        return $this->belongsTo(\Parallax\FilamentComments\Models\FilamentComment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipient()
    {
        return $this->hasMany(NewsRecipient::class);
    }
}
