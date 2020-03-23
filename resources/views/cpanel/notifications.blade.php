@extends('layouts.master')

@section('title', 'Notifications')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(auth()->user()->role_id != 1)
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if(optional(auth()->user())->role_id == 2)
                    {{ __('Show All Notification For Doctor') }}
                    @else
                    {{ __('Show All Notification For Patient') }}
                    @endif
                </div>

                <div class="card-body">
                    @if(count(optional(auth()->user())->notifications) > 0)
                    @foreach(optional(auth()->user())->notifications as $notification)
                        <form method="post" action="{{route('cpanel.NotificationsPost')}}">
                            @csrf
                        @if($notification->unread())
                            <span> {{$notification->data['Greeting']}} </span>  
                            <p> {{$notification->data['body']}}</p>
                            <input type="hidden"  name="notification_id" value="{{$notification->id}}">
                            <button type="submit" name="submit" value="yes" class="btn btn-success">yes</button>
                            <button type="submit" name="submit" value="no" class="btn btn-danger">No</button>
                            @endif
                        </form>
                    @endforeach
                    @else
                    <p> {{__('No Notification Found')}}</p>
                    @endif

                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@stop
