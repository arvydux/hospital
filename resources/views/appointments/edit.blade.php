@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Change {{ $currentPatient->name }}'s appointment's time to {{ $doctor->name }}</h2>
                </div>
                <div class="pull-right mt-2">
                    <a class="btn btn-primary mb-4" href="{{ URL::previous() }}">Go Back</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('appointments.update', $currentAppointment->id) }}" method="POST">
            @csrf
            {{ method_field('PUT') }}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Patient</strong>
                        {{$currentPatient->name}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Doctor:</strong>
                        {{$doctor->name}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Appointment time:</strong>
                        {{Carbon\Carbon::parse($currentAppointment->time)->format('Y-m-d H:i')}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Doctor's appointment's duration time in minutes:</strong>
                        {{$doctor->duration}}
                    </div>
                    <div class="form-group">
                        <strong>Doctor's working days:</strong>
                        @foreach($doctor->workdays as $workday)
                            <div  class="form-group">{{$workday->date}}:
                                {{Carbon\Carbon::parse($workday->from)
                                ->format('H:i')}} -
                                {{Carbon\Carbon::parse($workday->to)
                                ->format('H:i')}}
                            </div>
                        @endforeach
                        @foreach($doctor->workdays as $workday)
                            <div class="form-group">
                                <strong>Available slots for : </strong>{{$workday->date}}
                                <div class="row">
                                    @foreach($doctor->timeSlots($workday->from, $workday->to) as $key => $timeSlot)
                                        @if((in_array(Carbon\Carbon::parse($workday->date.' '.$timeSlot)->format('Y-m-d H:i:s'), $busySlots)))
                                            <div class="col-lg-4">
                                                <label for="{{Carbon\Carbon::parse($timeSlot)->format('Y-m-d H:i:s')}}"><span
                                                        style="margin-left: 17px; text-decoration: line-through;">{{$timeSlot}}</span> </label>
                                            </div>
                                        @else
                                            <div class="col-lg-4">
                                                <input type="radio"  name="time" value="{{Carbon\Carbon::parse($workday->date.' '.$timeSlot)->format('Y-m-d H:i:s')}}"
                                                       checked>
                                                <label for="{{Carbon\Carbon::parse($timeSlot)->format('Y-m-d H:i:s')}}">{{$timeSlot}}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
