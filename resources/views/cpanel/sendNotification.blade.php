@extends('layouts.master')

@section('title', 'Send Notification')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Assigned Patient To  Docotor And SEND Notification') }}</div>

                <div class="card-body">
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        {{Session::get('success')}}
                    </div>
                @endif
                <form method="post" action="{{route('cpanel.SendNotificationPost')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Patient</label>

                        <select name="patient_id" class="form-control" >
                            <option disabled selected>Select Patient Name  -  Pain Paitent</option>
                            @foreach ($patients as $patient)
                                <option  value="{{$patient->id}}">{{$patient->username.' -  '.optional($patient->pain)->name}}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Doctor</label>
                        <select name="doctor_id" class="form-control" >
                            <option disabled selected>Select Doctor Name - Specialty Name</option>
                            @foreach ($doctors as $doctor)
                                <option  value="{{$doctor->id}}">{{$doctor->username.' - '.optional($doctor->specialty)->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Date</label>
                        <input name="date" value="{{old('date')}}" type="datetime-local" class="form-control"  placeholder="date">
                    </div>
            
                    <button type="submit" class="btn btn-primary">{{__('Send Notification')}}</button>
                </form>
            
                </div>
            </div>
        </div>
    </div>
</div>

@stop
