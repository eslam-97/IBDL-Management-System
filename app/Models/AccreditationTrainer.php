<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccreditationTrainer extends Model
{
    use HasFactory;
    protected $connection = 'mysql_second';

    protected $fillable = [
        'name',
        'email',
        'country',
        'city',
        'birth_date',
        'gender',
        'image',
        'phone',
        'title',
        'type_accreditation_trainer',
        'company',
        'cv',
        'training_hours',
        'training_field',
        'brief',
        'accreditation_center_id',
    ];

    public function accreditationCenter(): BelongsTo
    {
        return $this->belongsTo(AccreditationCenter::class);
    }
}
