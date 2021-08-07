<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
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
Route::get('/doctors/{id}/register/', [AppointmentController::class, 'create'])->name('doctor.register-patient');
Route::get('/doctors/{id}/patients/', [DoctorController::class, 'patients'])->name('doctor.patients');
Route::resource('/doctors/{doctorId}/patients/{patientId}/prescriptions', PrescriptionController::class);
Route::resource('appointments', AppointmentController::class);
Route::get('/patients/', [PatientController::class, 'index'])->name('patients.index');
Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store');
