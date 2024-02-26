<?php

namespace App\Models;

use App\Models\Chapter;
use App\Models\MemberType;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\HasName;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable

{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'dob',
        'phone',
        'gender',
        'member_type_id',
        'chapter_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute()
    {
        return $this->firstname.' '.$this->middlename. ' '.$this->lastname;
    }

    // public function hasRole($role)
    // {
    //     return $this->role === $role;
    // }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
   
    public function member_type()
    {
        return $this->belongsTo(MemberType::class);
    }

    public function missions()
    {
    return $this->belongsToMany(Mission::class);
    }
    
    public function area_interests()
    {
    return $this->belongsToMany(AreaInterest::class);
    }

    public function skills()
    {
    return $this->belongsToMany(Skill::class);
    }
    public function spiritual_gifts()
    {
    return $this->belongsToMany(SpiritualGift::class);
    }

    
}
