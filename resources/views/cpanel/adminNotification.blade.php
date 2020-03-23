@extends('layouts.master')

@section('title', 'Admin Notifications')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(auth()->user()->role_id == 1)
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Show All Result Notification For Admin') }}
                </div>

                <div class="card-body">
                    @foreach (auth()->user()->notifications as $notification)
                    @if (strpos($notification->data['body'], 'refused') !== false)
                        <div class="alert alert-danger" role="alert">
                            <span>{{$notification->data['Greeting']}} </span>
                            <p>
                                {{$notification->data['body']}}
                            </p>
                            <a href="{{url('cpanel/sendNotification')}}"><button class="btn btn-primary">Reschedule</button></a>
                        </div>  
                    @else
                    <div class="alert alert-success" role="alert">
                        <span>{{$notification->data['Greeting']}} </span>
                        <p>
                            {{$notification->data['body']}}
                        </p>
                    </div>    
                    @endif

                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@stop
