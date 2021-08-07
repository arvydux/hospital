<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;


class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    public function create($id)
    {
        $doctor = doctor::find($id);
        $patients = patient::all();
        return view('appointments.create', compact('busySlots', 'doctor', 'patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'time'=>'required',
            'doctor-id' => 'required|exists:doctors,id',
            'patient-id' => 'required|exists:patients,id',
        ]);

        $appointment = new Appointment([
            'time' => $request->get('time'),
            'doctor_id' => $request->get('doctor-id'),
            'patient_id' => $request->get('patient-id')
        ]);
        $appointment->save();

        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
        //$patient = Doctor::find($request->get('doctor-id'))->patients->find($request->get('patient-id'));
        //return redirect(route('prescriptions.index', [$request->get('doctor-id'), $request->get('patient-id')]))->with('patient', $patient)->with('success', 'Prescription created!');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->back()->with('success','Appointment was deleted');
    }
}
