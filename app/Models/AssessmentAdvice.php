<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentAdvice extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_category_id',
        'language_id',
        'range_value',
        'advice',
        'advice_if_high_candidate',
        'advice_if_low_candidate',
        'advice_if_high_boss',
        'advice_if_low_boss',
    ];

    public function assessmentCategory()
    {
        return $this->belongsTo(AssessmentCategory::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
