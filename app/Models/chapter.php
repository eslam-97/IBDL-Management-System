<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory; 


    protected $fillable = [
        'name',
        'e_learning_id',
        'content'
    ];


    public function user()
    {
        return $this->belongsToMany(User::class)
        ->withPivot( 'start_date as start_date', 'end_date as end_date');
    }
}
