<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AutocompleteSearchDBController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\WorkdayController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('doctors', DoctorController::class);
Route::get('/doctors/{id}/workdays/create', [WorkdayController::class, 'create'])->name('doctors.workdays.create');
Route::post('/doctors/workdays/store', [WorkdayController::class, 'store'])->name('doctors.workdays.store');
Route::get('/doctors/{id}/appointments/', [DoctorController::class, 'appointments'])->name('doctors.appointments');
Route::get('/doctors/{id}/appointments/create', [AppointmentController::class, 'create'])->name('doctors.appointments.create');
Route::get('/doctors/appointments/{appointmentsId}/edit', [AppointmentController::class, 'edit'])
    ->name('doctors.appointments.edit');
Route::put('/doctors/appointments/{appointmentsId}/update', [AppointmentController::class, 'update'])
    ->name('doctors.appointments.update');
Route::get('/doctors/{id}/patients/', [DoctorController::class, 'patients'])->name('doctors.patients');
Route::get('/doctors/{doctorId}/patients/{patientId}/prescriptions', [PrescriptionController::class, 'index'])->name('doctors.patients.prescriptions');
Route::get('/doctors/{doctorId}/patients/{patientId}/prescriptions/create', [PrescriptionController::class, 'create'])->name('doctors.patients.prescriptions.create');
Route::post('/doctors/{doctorId}/patients/{patientId}/prescriptions/store',
    [PrescriptionController::class, 'store'])->name('doctors.patients.prescriptions.store');
Route::post('/doctors/{doctorId}/patients/{patientId}/prescriptions/show',
    [PrescriptionController::class, 'show'])->name('doctors.patients.prescriptions.show');
Route::delete('/doctors/{doctorId}/patients/{patientId}/prescriptions/{prescriptionId}/destroy',
    [PrescriptionController::class, 'destroy'])->name('doctors.patients.prescriptions.destroy');
//Route::resource('/doctors/{doctorId}/patients/{patientId}/prescriptions', PrescriptionController::class);
Route::resource('appointments', AppointmentController::class);
Route::get('/patients/', [PatientController::class, 'index'])->name('patients.index');
Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store');
Route::get('/autocomplete-search-query', [AutocompleteSearchDBController::class, 'searchDB'])->name('autocomplete.search.query');
