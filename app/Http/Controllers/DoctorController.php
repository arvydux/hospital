<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    public function prescriptions($doctorId)
    {
        $prescriptions = Prescription::where('doctor_id', $doctorId)->paginate(5);
        $doctor = Doctor::find($doctorId);
        return view('doctors.prescriptions', compact('prescriptions', 'doctor'));
    }
}
