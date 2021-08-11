<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(appointment::class,'doctor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workdays()
    {
        return $this->hasMany(workday::class,'doctor_id')->orderBy('date');
    }

    /**
     * @param $start
     * @param $end
     * @return array
     */
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
