@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    {{ __('You are logged in!') }}
                </div>
                <div class="card-body">
                    <a class="btn btn-info" href="{{route('doctors.index')}}">Doctor's list</a>
                    <a class="btn btn-info" href="{{route('patients.index')}}">Patient's list</a>
                    <a class="btn btn-info" href="{{route('appointments.index')}}">Appointment's list</a>
                    <a class="btn btn-info" href="{{route('appointments.index')}}">Appointment's list</a>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
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
