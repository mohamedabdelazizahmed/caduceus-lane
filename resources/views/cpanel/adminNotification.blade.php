@extends('layouts.master')

@section('title', 'Admin Notifications')

@section('content')

    @if(auth()->user()->role_id == 1)
@foreach (auth()->user()->notifications as $notification)
    {{$notification->data['Greeting']}}
    <br>
    {{$notification->data['body']}}
    <br>
    @if (strpos($notification->data['body'], 'refused') !== false)
        <a href="{{url('cpanel/sendNotification')}}"><button class="btn btn-success">Reschedule</button></a>
        <br>
    @endif

@endforeach
@endif

@stop
