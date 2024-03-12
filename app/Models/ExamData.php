<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamData extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'exam_id',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function exam(): BelongsTo
    {
        return $this->belongsTo(exam::class, 'exam_id');
    }

}