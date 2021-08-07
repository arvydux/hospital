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
        $prescriptions = Prescription::where('doctor_id', $doctorId)->where('patient_id', $patientId)->get();
        $doctor = Doctor::find($doctorId);
        $patient = Patient::find($patientId);
        return view('prescriptions.index', compact('doctor','patient', 'prescriptions'));
    }

    public function create($doctorId, $patientId)
    {
        $patient = Patient::find($patientId);
        $doctor = Doctor::find($doctorId);
        return view('prescriptions.create', compact('patient','doctor'));;
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

        return redirect(route('doctors.patients', $request->get('doctor-id')))->with('success', 'Prescription created!');

    }

    public function show($prescriptionId)
    {
        //$prescription = prescription::find($prescriptionId);
        //return view('prescriptions.create', compact('patient','doctor'))->with('success', 'Prescription deleted!');;;
    }

    public function destroy($doctorId, $patientId, $prescriptionId)
    {
        //$patient = Patient::find($patientId);
        //$doctor = Doctor::find($doctorId);
        $prescription = prescription::find($prescriptionId);
        $prescription->delete();
        //return view('prescriptions.index', compact('patient','doctor'))->with('success', 'Prescription deleted!');;
        return redirect(route('doctors.patients.prescriptions', [$doctorId, $patientId]))->with('success', 'Prescription deleted!');
    }
}
