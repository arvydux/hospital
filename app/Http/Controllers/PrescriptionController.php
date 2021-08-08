<?php

namespace App\Http\Controllers;

use App\Mail\PrescriptionMail;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Prescription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Boolean;

class PrescriptionController extends Controller
{
    public function index($doctorId, $patientId)
    {
        $doctor = Doctor::find($doctorId);
        $patient = Patient::find($patientId);
        $prescriptions = Patient::find($patientId)->prescriptions()->paginate(3);
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

        if($prescription){
            $this->sendEmailNotification($prescription);
        } else {
            App::abort(500, 'Error');
        }

        return redirect(route('doctors.patients', $request->get('doctor-id')))
            ->with('success', 'Prescription created! Email notification was sent to patient.');

    }

    public function show($prescriptionId)
    {
        //$prescription = prescription::find($prescriptionId);
        //return view('prescriptions.create', compact('patient','doctor'))->with('success', 'Prescription deleted!');;;
    }

    public function destroy($doctorId, $patientId, $prescriptionId)
    {
        $prescription = prescription::find($prescriptionId);
        $prescription->delete();
        return redirect(route('doctors.patients.prescriptions', [$doctorId, $patientId]))->with('success', 'Prescription deleted!');
    }

    public function sendEmailNotification($prescription)
    {
        $patient = Patient::find($prescription->patient_id);
        $doctor = Doctor::find($prescription->doctor_id);
        $details = [
            'drug-name' => $prescription->drug_name,
            'doctor-name' => $doctor->name,
            'patient-name' => $patient->name,
        ];
        Mail::to($patient->email)->send(new PrescriptionMail($details));
    }
}
