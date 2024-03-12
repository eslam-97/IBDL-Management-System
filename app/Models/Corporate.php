<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corporate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'country',
        'city',
        'phone',
        'filed',
        'corporate_type',
        'website',
        'contact_person',
        'contact_phone',
        'contact_email',
        'contact_title',
    ];

    // Define the one-to-many relationship with Batch
    public function batches()
    {
        return $this->hasMany(Batch::class, 'corporate_id', 'id');
    }
}





