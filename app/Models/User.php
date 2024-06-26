<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
        'password' => 'hashed',
    ];

    public function liveTracking(): HasOne
    {
        return $this->hasOne(LiveTracking::class,'user_id');
    }


    public function userExams(): HasMany
    {
        return $this->hasMany(UserExam::class,'user_id');
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function chapters()
    {
        return $this->belongsToMany(Chapter::class)
            ->withPivot('start_date as start_date', 'end_date as end_date');
    }

    public function elearnings()
    {
        return $this->belongsToMany(ELearning::class)
            ->withPivot('language_id as language_id', 'start_date as start_date', 'end_date as end_date', 'finished as finished');
    }
}
