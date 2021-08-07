<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index($doctorId, $patientId)
    {
        $patient = Doctor::find($doctorId)->patients->find($patientId);
        return view('prescriptions.index', compact('patient'));
    }

    public function create($doctorId, $patientId)
    {
        return view('prescriptions.create', compact('doctorId', 'patientId'));;
    }

    public function store(Request $request)
    {
        $request->validate([
            'drug-name'=>'required|string',
            'symptoms' => 'string',
            'patient-id' => 'required|exists:patients,id',
            'doctor-id' => 'required|exists:doctors,id',
        ]);

        $prescription = new Prescription([
            'drug_name' => $request->get('drug-name'),
            'symptoms' => $request->get('symptoms'),
            'patient_id' => $request->get('patient-id'),
            'doctor_id' => $request->get('doctor-id')
        ]);
        $prescription->save();

        $patient = Doctor::find($request->get('doctor-id'))->patients->find($request->get('patient-id'));
        return redirect(route('prescriptions.index', [$request->get('doctor-id'), $request->get('patient-id')]))->with('patient', $patient)->with('success', 'Prescription created!');
    }

    public function show()
    {
        echo 235;
    }
}
