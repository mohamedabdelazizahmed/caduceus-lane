<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title> caduceus-lane - @yield('title')</title>
</head>
<body>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'DoctorsLane') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @if (Route::has('login'))
                    @auth

                        <li class="nav-item">
                            <a  class="nav-link" href="{{ url('/cpanel/profile') }}">Profile</a>                            
                        </li>
                        @if(auth()->user()->role_id!=1)
                        <li class="nav-item">
                            <a  class="nav-link" href="{{ url('/cpanel/notifications') }}">Notifications</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/cpanel/adminNotifications') }}">Notifications</a>
                        </li>    
                        @endif
                           @if(auth()->user()->role_id == 1)
                           <li class="nav-item">
                            <a class="nav-link" href="{{ url('/cpanel/addDoctor') }}">Add Doctor</a>
                           </li>
                           <li class="nav-item">
                            <a  class="nav-link" href="{{ url('/cpanel/sendNotification') }}">Make Appoitment</a>
                           </li>
                            @endif
                    @endauth        
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                @if (Route::has('login'))
                                    <div class="top-right links">
                                        @auth
                                            <a href="{{ url('/cpanel/profile') }}">ADD/Edit Profile</a>
                                        <br>
                                        @if(auth()->user()->role_id!=1)
                                            <a href="{{ url('/cpanel/notifications') }}">Notifications</a>
                                            @else
                                                <a href="{{ url('/cpanel/adminNotifications') }}">Notifications</a>
                                            @endif
                                            <br>
                                               @if(auth()->user()->role_id == 1)
                                                <a href="{{ url('/cpanel/addDoctor') }}">Add Doctor</a>
                                                   <br>
                                                <a href="{{ url('/cpanel/sendNotification') }}">Send Notification</a>
                                                @endif
                                        @else
                                            <a href="{{ route('login') }}">Login</a>

                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}">Register</a>
                                            @endif
                                        @endauth
                                    </div>
                                @endif

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<script src="{{asset('js/jquery-3.4.1.min.js')}}" ></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}" ></script>
</body>
</html>
