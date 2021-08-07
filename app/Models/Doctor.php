<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    public function shifts()
    {
        return $this->hasMany(DoctorShift::class,'doctor_id');
    }

    public function timeSlots($start, $end)
    {
        $data = [];
        $intervals = CarbonPeriod::since($start)->minutes('20')->until($end)->toArray();
        foreach ($intervals as $interval) {
            $to = next($intervals);
            if ($to !== false) {
                array_push($data, $interval->toTimeString('minute') . '-' . $to->toTimeString('minute'));
            }
        }
        return $data;
    }
}
