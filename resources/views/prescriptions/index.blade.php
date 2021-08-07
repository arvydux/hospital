@extends('layouts.app')

@section('content')

    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Patient {{$patient->name}} prescriptions</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('prescriptions.create', [$patient->doctor_id, $patient->id])}}"> Create new prescription</a>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <tbody><tr>
                <th>Prescription id</th>
                <th>Drug name</th>
                <th>Symptoms</th>
            </tr>
            @foreach($patient->prescriptions  as $prescription)
                <tr>
                    <td>{{$prescription->id}}</td>
                    <td>{{$prescription->drug_name}}</td>
                    <td>{{$prescription->symptoms}}</td>
                </tr>
            @endforeach
            </tbody></table>
    </div>
@endsection
