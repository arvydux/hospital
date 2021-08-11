<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;


class AppointmentController extends Controller
{
    public function index($id)
    {
        $doctor = Doctor::find($id);
        $appointments = $doctor->appointments;
        return view('appointments.index', compact('appointments', 'doctor'));
    }

    public function create($id)
    {
        $busySlots = [];
        $appointments = Appointment::where('doctor_id', $id)->get();
        foreach ($appointments as $appointment){
            $busySlots[] = $appointment->time;
        }

        $doctor = doctor::with(['workdays' => function ($q){
            $q->orderBy('date');
        }])->find($id);
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
        return redirect(route('doctors.appointments', $request->get('doctor-id')))->with('success', 'Appointment was created');
    }

    public function edit($doctorId, $appointmentId)
    {
        $currentAppointment = Appointment::find($appointmentId);
        $currentPatient = patient::find($currentAppointment->patient_id);
        $appointments = Appointment::where('doctor_id', $currentAppointment->doctor_id)->get();
        $busySlots = [];
        foreach ($appointments as $appointment){
            $busySlots[] = $appointment->time;
        }

        $doctor = doctor::with(['workdays' => function ($q){
            $q->orderBy('date');
        }])->find($currentAppointment->doctor_id);
        return view('appointments.edit', compact('currentAppointment','busySlots', 'doctor', 'currentPatient'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'time'=>'required',
        ]);
        $appointment = Appointment::find($id);
        $appointment->time = $request->get('time');
        $appointment->save();
        return redirect(route('doctors.appointments', $appointment->doctor_id))->with('success', 'Appointment time was updated');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->back()->with('success','Appointment was deleted');
    }
}
