<?php

namespace App\Http\Controllers;

use App\Mail\PrescriptionMail;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class PrescriptionController extends Controller
{
    /**
     * @param $doctorId
     * @param $patientId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($doctorId, $patientId)
    {
        $doctor = Doctor::find($doctorId);
        $patient = Patient::find($patientId);
        $prescriptions = Patient::find($patientId)->prescriptions()->paginate(5);
        return view('prescriptions.index', compact('doctor','patient', 'prescriptions'));
    }

    /**
     * @param $doctorId
     * @param $patientId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create($doctorId, $patientId)
    {
        $patient = Patient::find($patientId);
        $doctor = Doctor::find($doctorId);
        return view('prescriptions.create', compact('patient','doctor'));;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * @param $doctorId
     * @param $patientId
     * @param $prescriptionId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($doctorId, $patientId, $prescriptionId)
    {
        $prescription = prescription::find($prescriptionId);
        $prescription->delete();
        return redirect(route('doctors.patients.prescriptions', [$doctorId, $patientId]))->with('success', 'Prescription deleted!');
    }

    /**
     * @param $prescription
     */
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
