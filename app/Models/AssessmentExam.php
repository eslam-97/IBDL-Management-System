<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'statement_one_id',
        'statement_two_id',
    ];

    public function statementOne()
    {
        return $this->belongsTo(AssessmentStatement::class, 'statement_one_id');
    }

    public function statementTwo()
    {
        return $this->belongsTo(AssessmentStatement::class, 'statement_two_id');
    }
}