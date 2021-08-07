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
                    <a class="btn btn-info" href="{{ route('doctors.patients.register', $doctor->id)}}">Register appointment</a>
                    <a class="btn btn-info" href="{{ route('doctors.appointments', $doctor->id)}}">View appointments</a>
                    <a class="btn btn-info" href="{{ route('doctors.patients', $doctor->id)}}">View patients</a>
                    <a class="btn btn-info" href="{{ route('doctors.workdays.create', $doctor->id)}}">Add workday</a>
                </td>
            </tr>
            @endforeach
            </tbody></table>
    </div>
@endsection
