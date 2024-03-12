<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'instructions',
        'exam_duration',
        'language_id',
        'e_learning_id',
    ];

    public function e_learning(): BelongsTo
    {
        return $this->belongsTo(ELearning::class, 'e_learning_id');
    }

    public function examData(): HasOne
    {
        return $this->hasOne(ExamData::class, 'exam_id');
    }

    public function liveTrackings(): HasMany
    {
        return $this->hasMany(LiveTracking::class, 'exam_id');
    }

    public function userExams(): HasMany
    {
        return $this->hasMany(UserExam::class, 'exam_id');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

}