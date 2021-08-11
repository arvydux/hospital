<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'drug_name', 'symptoms', 'patient_id', 'doctor_id'
    ];

    /**
     * @param $prescription
     * @return bool
     */
    public function getHasOneHourPassedAttribute($prescription){
        $timeNow = Carbon::now();
        $timeDiff = $timeNow->diffInHours($this->created_at);
        return (bool) $timeDiff;
    }
}
