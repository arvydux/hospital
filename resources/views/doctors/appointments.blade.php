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
                    <h2>Appointment list</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('appointments.create')}}"> Create new appointment</a>
                </div>
            </div>
        </div>


        <table class="table table-bordered">
            <tbody><tr>
                <th>Appointment date/time</th>
                <th>Doctor's name</th>
                <th>Patient's name</th>
            </tr>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{$appointment->time}}</td>
                    <td>{{$appointment->doctor->name}}</td>
                    <td>{{$appointment->patient->name}}</td>
                </tr>
            @endforeach
            </tbody></table>
    </div>
@endsection
