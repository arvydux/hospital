@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Create new appointment to {{$doctor->name}}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{route('appointments.index')}}"> Back</a>
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

        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Patient</strong>
                        <select name="patient-id" class="form-control">
                            <option value="" selected disabled>Select a patient</option>
                            @foreach($patients as $patient)
                                <option  value="{{ $patient->id  }}">{{ $patient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Doctor:</strong>
                        {{$doctor->name}}
                        <input type="hidden" name="doctor-id" class="form-control" value="{{$doctor->id}}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Doctor's appointment's duration time in minutes:</strong>
                        {{$doctor->duration}}
                    </div>
                    <div class="form-group">
                        <strong>Doctor's working days:</strong>
                        @foreach($doctor->shifts as $shift)
                            <div  class="form-group">{{$shift->day}}:
                                {{Carbon\Carbon::parse($shift->from)
                                ->format('H:i')}} -
                                {{Carbon\Carbon::parse($shift->to)
                                ->format('H:i')}}
                            </div>
                        @endforeach
                        @foreach($doctor->shifts as $shift)
                            <div class="form-group">
                                <strong>Aavailable slots for day: </strong>{{$shift->day}}
                                <div class="row">
                                @foreach($doctor->timeSlots($shift->from, $shift->to) as $key => $timeSlot)
                                        @if((in_array(Carbon\Carbon::parse($shift->day.' '.$timeSlot)->format('Y-m-d H:i:s'), $busySlots)))
                                            <div class="col-lg-4">
                                                <label for="{{Carbon\Carbon::parse($timeSlot)->format('Y-m-d H:i:s')}}"><span
                                                        style="margin-left: 17px; text-decoration: line-through;">{{$timeSlot}}</span> </label>
                                            </div>
                                        @else
                                            <div class="col-lg-4">
                                                <input type="radio"  name="time" value="{{Carbon\Carbon::parse($shift->day.' '.$timeSlot)->format('Y-m-d H:i:s')}}"
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
