@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Doc. {{$doctor->name}}'s  pacient list </h2>
                </div>

            </div>
        </div>

        <table class="table table-bordered">
            <tbody><tr>
                <th>Patient's name</th>
                <th>Patient's email</th>
                <th>Prescriptions</th>
            </tr>
            @foreach($patients as $patient)
                <tr>
                    <td>{{$patient->name}}</td>
                    <td>{{$patient->email}}</td>
                    <td><a class="btn btn-info" href="{{ route('prescriptions.index', [$doctor->id, $patient->id])}}">View prescriptions</a></td>
                </tr>
            @endforeach
            </tbody></table>
    </div>
@endsection
