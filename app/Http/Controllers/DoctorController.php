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

    public function appointments($id)
    {
        $doctor = Doctor::find($id);
        $appointments = $doctor->appointments;
        return view('doctors.appointments', compact('appointments', 'doctor'));
    }

    public function patients($id)
    {
        $doctor = Doctor::find($id);
        $appointments = $doctor->appointments;
        $patientsId = [];
        foreach ($appointments as $appointment){
            $patientsId[] = $appointment->patient_id;
        }
        $patients = Patient::whereIn('id', $patientsId)->paginate(2);
        return view('doctors.patients', compact('patients', 'doctor'));
    }
}
