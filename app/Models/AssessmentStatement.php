<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentStatement extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'statement',
        'assessment_category_id',
        'value',
    ];

    public function assessmentExams()
    {
        return $this->hasMany(AssessmentExam::class);
    }

    public function assessmentCategory()
    {
        return $this->belongsTo(AssessmentCategory::class);
    }

}
