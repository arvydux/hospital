<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index($id)
    {
        $doctor = Doctor::find($id);
        $appointments = $doctor->appointments;
        $patientsId = [];
        foreach ($appointments as $appointment){
            $patientsId[] = $appointment->patient_id;
        }
        $patients = Patient::whereIn('id', $patientsId)->paginate(3);
        return view('patients.index', compact('patients', 'doctor'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        return view('patients.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'email' => 'required|email',

        ]);

        $patient = new Patient([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);
        $patient->save();

        return redirect(route('home'))->with('success', 'Patient registered!');
    }
}
