<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ELearning extends Model
{
    use HasFactory; 
    
    protected $fillable = [
        'name',
        'instruction',
        'logo',
        'language_id',
    ];


    public function user()
    {
        return $this->belongsToMany(User::class)
        ->withPivot('language_id as language_id', 'start_date as start_date', 'end_date as end_date', 'finished as finished');
    }
}
