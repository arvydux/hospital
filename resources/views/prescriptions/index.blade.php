@extends('layouts.app')

@section('content')

    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->get('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Patient {{$patient->name}} prescriptions</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{route('doctors.patients', $doctor->id)}}"> Back</a>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <tbody><tr>
                <th>Prescription id</th>
                <th>Drug name</th>
                <th>Symptoms</th>
                <th>Assigned at</th>
                <th>Prescription actions</th>
            </tr>
            @foreach($patient->prescriptions  as $prescription)
                <tr>
                    <td>{{$prescription->id}}</td>
                    <td>{{$prescription->drug_name}}</td>
                    <td>{{$prescription->symptoms}}</td>
                    <td>{{$prescription->created_at}}</td>
                    <td>
                        @if($prescription->hasOneHourPassed)
                        <form action="{{route('doctors.patients.prescriptions.destroy', [$doctor->id, $patient->id, $prescription->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                        @else
                            Prescription can't be deleted! ! 1 Hour have already passed.
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody></table>
    </div>
@endsection
