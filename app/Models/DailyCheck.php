<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'check_date',
        'any_sick_goat',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
