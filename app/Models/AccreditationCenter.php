<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccreditationCenter extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';

    protected $fillable = [
        'name',
        'email',
        'country',
        'city',
        'phone',
        'field',
        'type_accreditation_center',
        'website',
        'tex_trg',
        'comm_req',
        'license',
        'quality_manual',
        'accreditation',
        'approve',
        'contact_person',
        'contact_phone',
        'contact_email',
        'contact_title',
    ];

    public function trainers(): HasMany
    {
        return $this->hasMany(AccreditationTrainer::class);
    }

}
