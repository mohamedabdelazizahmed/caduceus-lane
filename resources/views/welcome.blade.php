@extends('layouts.master')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if(auth()->user()->role_id == 1)
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Rules of Admin Panel ') }}</div>
                <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">ADD Profile For Admin</h5>
                                <p class="card-text">Can ADD And Edit Profile.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ADD New Doctors</h5>
                            <p class="card-text">Can ADD New Docotr With specilaty.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Show Notification</h5>
                            <p class="card-text"> Show All Notification.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Make Appoiment for doctor and patient</h5>
                            <p class="card-text"> assigned patient to doctor and make appointment and send notification  .</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        </div>
                    </div>
                    </div>









                </div>
            </div>
        </div>
        @endif
        @if(auth()->user()->role_id == 3)
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Make Appointment For Paitent') }}</div>

                <div class="card-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        {{Session::get('success')}}
                    </div>
                @endif
                <form method="post" action="{{route('MakeAppointment',$currentUser->id)}}">
                @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Your Pain Please To Make Appointment</label>
                        <select name="pain_id" class="form-control" >
                            <option disabled selected>Select any pain for paitent</option>
                            @foreach ($pains as $pain)
                                <option  value="{{$pain->id}}">{{$pain->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('Make Appointment')}}</button>
                </form>
            
            
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@stop

