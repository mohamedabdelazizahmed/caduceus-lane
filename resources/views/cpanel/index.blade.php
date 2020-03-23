@extends('layouts.master')

@section('title', 'Control Panel')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">        
                    @if($currentUser->role_id == 3)
                    {{ __('ADD Profile Patient') }}
                    @elseif($currentUser->role_id == 2)
                    {{ __('ADD Profile Doctor') }}
                    @else
                    {{ __('ADD Profile Admin') }}
                    @endif
                </div>

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
                    <form method="post" action="{{route('cpanel.PersonalData',$currentUser->id)}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">First Name</label>
                            <input name="first_name" value="{{old('first_name',$currentUser->first_name)}}" type="text" class="form-control"  placeholder="first name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Last Name</label>
                            <input name="last_name" value="{{old('last_name',$currentUser->last_name)}}" type="text" class="form-control"  placeholder="last name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Occupation</label>
                            <input name="occupation" value="{{old('occupation',$currentUser->occupation)}}" type="text" class="form-control"  placeholder="occupation">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mobile</label>
                            <input name="mobile" value="{{old('mobile',$currentUser->mobile)}}" type="number" class="form-control"  placeholder="mobile">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" value="{{old('email',$currentUser->email)}}" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Birth Date</label>
                            <input name="birth_date" value="{{old('birth_date',$currentUser->birth_date)}}" type="date" class="form-control"  placeholder="birthdate">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Gender</label>
                            <select name="gender_id" class="form-control" >
                                <option disabled="disabled">Select</option>
                                @foreach ($genders as $gender)
                                    <option @if($gender->id==$currentUser->gender_id) selected @endif value="{{$gender->id}}">{{$gender->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Country</label>
                            <select name="country_id" class="form-control" >
                                <option disabled="disabled">Select</option>
                                @foreach ($countries as $country)
                                    <option @if($country->id==$currentUser->country_id) selected @endif value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{--@if($currentUser->role_id == 3 )--}}
                
                        {{--<div class="form-group">--}}
                            {{--<label for="exampleFormControlSelect1">Pain</label>--}}
                            {{--<select name="pain_id" class="form-control" >--}}
                                {{--<option disabled="disabled">Select</option>--}}
                                {{--@foreach ($pains as $pain)--}}
                                    {{--<option @if($pain->id==$currentUser->pain_id) selected @endif value="{{$pain->id}}">{{$pain->name}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        @if($currentUser->role_id == 2)
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">specialty</label>
                            <select name="specialty_id" class="form-control" >
                                <option disabled="disabled">Select</option>
                                @foreach ($specialties as $specialty)
                                    <option @if($specialty->id==$currentUser->specialty_id) selected @endif value="{{$specialty->id}}">{{$specialty->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                            <button type="submit" class=" col-md-12 btn btn-primary">Submit</button>
                    </form>
                        @if($currentUser->role_id == 3)
                        <a href="{{route('index')}}"><button class="mt-3 col-md-12 btn btn-info">Next To Select Your Pain</button></a>
                        @endif



                </div>
            </div>
        </div>
    </div>
</div>

























@stop
