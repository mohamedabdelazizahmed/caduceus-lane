@extends('layouts.master')

@section('title', 'Add Doctor')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD Doctor') }}</div>

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
                <form method="post" action="{{route('cpanel.CreateDoctor')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">username</label>
                        <input name="username" value="{{old('username')}}" type="text" class="form-control"  placeholder="username">
                    </div>
                    <div class="form-group">
                        <label >password</label>
                        <input name="password" type="password" class="form-control"  placeholder="password">
                    </div>
                    <div class="form-group">
                        <label >Confirm Password</label>
                        <input name="password_confirmation"  type="password" class="form-control"  placeholder="confirm password">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">specialty</label>
                        <select name="specialty" class="form-control" >
                            <option disabled="disabled">Select</option>
                            @foreach ($specialties as $specialty)
                                <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


                </div>
            </div>
        </div>
    </div>
</div>

@stop
