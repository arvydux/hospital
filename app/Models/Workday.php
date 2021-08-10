<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workday extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'from', 'to', 'doctor_id'
    ];

    public function getFromAttribute($from)
    {
        return Carbon::parse($from)->format('H:i');
    }

    public function getToAttribute($to)
    {
        return Carbon::parse($to)->format('H:i');
    }
}
