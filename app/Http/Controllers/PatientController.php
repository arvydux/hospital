<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('doctor')->get();
        return view('patients.index', compact('patients'));
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

        $patients = Patient::with('doctor')->get();
        return redirect(route('patients.index'))->with('patients', $patients)->with('success', 'Patient registered!');
    }
}
