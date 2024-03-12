<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'start_date',
        'end_date',
        'success_rate',
        'progress',
        'user_id',
        'corporate_id',
    ];

    // Define the inverse one-to-many relationship with Corporate
    public function corporate()
    {
        return $this->belongsTo(Corporate::class, 'corporate_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
