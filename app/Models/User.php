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
//use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail

{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Notifiable;

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
        'course_of_study',
        'degree',
        'occupation',
        'professional_abilities',
        'mission_id',
        'area_interest_id',
        'spiritual_gift_id',
        'skill_id',
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
        'spiritual_gift_id' => 'array',
       ' skill_id'  => 'array',
        'area_of_interest_id'  => 'array',
       ' mission_id'  => 'array',
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

   
    

    

// class User extends Authenticatable implements FilamentUser
// {
//     // ...

    // public function canAccessPanel(Panel $panel): bool
   
    // {
    //   // Assuming you have a column 'role' in your 'users' table
    //     // to differentiate between administrators and regular users
    //     if($this->is_admin) {
    //         // Admins can access the panel
    //         return true;
    //     }

    //     // Regular users can only access the panel for regular users
    //     return $panel->getName() === 'users';
    // }

// }

}
