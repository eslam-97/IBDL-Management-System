<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'name',
        'category_code',
        'detail',
        'score',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function assessmentAdvices()
    {
        return $this->hasMany(AssessmentAdvice::class);
    }

}