@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Doctors list </h2>
                </div>

            </div>
        </div>


        <table class="table table-bordered">
            <tbody><tr>
                <th>Name</th>
                <th>Expertise</th>
                <th>Action</th>
            </tr>
            @foreach($doctors as $doctor)
            <tr>
                <td>{{$doctor->name}}</td>
                <td>{{$doctor->expertise}}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('doctor.register-patient', $doctor->id)}}">Register patient</a>
                    <a class="btn btn-info" href="{{ route('appointments.index', $doctor->id)}}">View appointments</a>
                    <a class="btn btn-info" href="{{ route('doctor.patients', $doctor->id)}}">View patients</a>

                </td>
            </tr>
            @endforeach
            </tbody></table>
    </div>
@endsection
