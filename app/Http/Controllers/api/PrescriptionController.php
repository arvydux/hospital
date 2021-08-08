<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PrescriptionsResource;
use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::all();
        return PrescriptionsResource::collection($prescriptions);
    }

    public function patientById($id)
    {
        $prescriptions = Prescription::where('patient_id', $id)->get();
        return PrescriptionsResource::collection($prescriptions);
    }

}
