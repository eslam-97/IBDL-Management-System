<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'result',
        'exam_id',
        'language_id',
        'user_id',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class,'exam_id');
    }
    
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class,'language_id');
    }


}
