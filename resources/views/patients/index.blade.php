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
                    <h2>Patient list</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('patients.create')}}"> Create new patient</a>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <tbody><tr>
                <th>Patient's name</th>
                <th>Patient's email</th>
            </tr>
            @foreach($patients as $patient)
                <tr>
                    <td>{{$patient->name}}</td>
                    <td>{{$patient->email}}</td>
                </tr>
            @endforeach
            </tbody></table>
    </div>
@endsection
