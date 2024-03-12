<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LiveTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer',
        'exam_id',
        'question_id',
        'user_id',
    ];


    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class,'exam_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
