<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    public function patients($id)
    {
        $appointments = Appointment::where('doctor_id', $id)->get();
        $patientsId = [];
        foreach ($appointments as $appointment){
            $patientsId[] = $appointment->patient_id;
        }
        $patients = Patient::whereIn('id', $patientsId)->get();
        return view('doctors.patients', compact('patients', 'doctor'));
    }
}
