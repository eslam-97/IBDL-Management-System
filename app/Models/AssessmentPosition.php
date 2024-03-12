<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'assessment_company_id',
        'language_id',
    ];
    

    public function assessmentCompany()
    {
        return $this->belongsTo(AssessmentCompany::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
