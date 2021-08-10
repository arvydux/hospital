@extends('layouts.app')

@section('content')
@if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    {{ __('You are logged in!') }}
                   @if(!auth()->user()->hasRole('Receptionist'))
                        @foreach($doctors as $doctor)
                            @if($doctor->name == auth()->user()->name)
                                <table class="table table-bordered mt-3">
                                    <tbody><tr>
                                        <th>Name</th>
                                        <th>Expertise</th>
                                        <th>Action</th>
                                          </tr>
                                        <tr>
                                            <td>{{$doctor->name}}</td>
                                            <td>{{$doctor->expertise}}</td>
                                            <td>
                                                <a class="btn btn-info" href="{{ route('doctors.patients', $doctor->id)}}">View patients</a>
                                                <a class="btn btn-info" href="{{ route('doctors.prescriptions', $doctor->id)}}">View prescriptions</a>
                                                <a class="btn btn-success" href="{{ route('doctors.workdays.create', $doctor->id)}}">Add workday</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <strong>{{$doctor->name}} work schedule</strong>
                                <table class="table table-bordered mt-3">
                                    <tbody><tr>
                                        <th>Day</th>
                                        <th>Time</th>
                                    </tr>
                                    @foreach($doctor->workdays as $workday)
                                    <tr>
                                        <td>{{$workday->date}}</td>
                                        <td>{{$workday->from}} -
                                            {{$workday->to}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    </div>
                                </div>
                                </tbody>
                                </table>
                                @endif
                            @endforeach
                    @endif
                    @if(auth()->user()->hasRole('Receptionist'))
                <div class="card-body">
                    <a class="btn btn-success" href="{{route('patients.create')}}">Register new patient</a>
                </div>
                        <div class="card-body">
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
                                            <a class="btn btn-info" href="{{ route('doctors.appointments', $doctor->id)}}">View appointments</a>
                                            <a class="btn btn-success" href="{{ route('doctors.workdays.create', $doctor->id)}}">Add workday</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                <div class="card-body">
                    <h1>{{ $chart1->options['chart_title'] }}</h1>
                    {!! $chart1->renderHtml() !!}

                </div>
            </div>
        </div>
    </div>
</div>
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
@endsection
