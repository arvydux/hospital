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
                    <h2>{{$doctor->name}} appointment list </h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success mt-3 mb-3" href="{{ route('doctors.appointments.create', $doctor->id)}}">Book appointment</a>
                    <a class="btn btn-primary mt-3 mb-3" href="{{ route('home')}}">Go back</a>
                </div>
            </div>
        </div>


        <table class="table table-bordered">
            <tbody><tr>
                <th>Appointment date/time</th>
                <th>Doctor's name</th>
                <th>Patient's name</th>
                <th width="280px">Appointment actions</th>
            </tr>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{$appointment->time}}</td>
                    <td>{{$appointment->doctor->name}}</td>
                    <td>{{$appointment->patient->name}}</td>
                    <td>
                        <form action="{{route('appointments.destroy', $appointment->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-primary" href="{{route('doctors.appointments.edit', [$doctor->id, $appointment->id])}}">Edit</a>
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody></table>
    </div>
@endsection
