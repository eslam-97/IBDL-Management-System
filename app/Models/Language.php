<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Language extends Model
{
    use HasFactory;
    protected $fillable = ['name'];


    public function e_learning(): HasMany
    {
        return $this->hasMany(ELearning::class,'language_id');
    }

    public function exam(): HasMany
    {
        return $this->hasMany(Exam::class,'language_id');
    }

    public function userExam(): HasOne
    {
        return $this->hasOne(UserExam::class,'language_id');
    }

}

