<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goat extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_id',
        'tag_number',
        'gender',
        'type',
        'birth_date',
        'weight',
        'notes',
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function dailyChecks()
{
    return $this->belongsToMany(DailyCheck::class, 'daily_check_goat');
}

}
