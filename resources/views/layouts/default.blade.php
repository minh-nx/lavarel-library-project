<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title> @yield('title') </title>
        
        @section('meta')
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @show

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" />
    </head>

    <body>
        {{-- Menu bar --}}
        @guest
            <a href="{{ route('home') }}">
                Home Page
            </a>
            <br>

            <a href="{{ route('login') }}">
                Login
            </a>
            <br>
            
            <a href="{{ route('register') }}">
                Register
            </a>
            <br>
        @endguest
            
        @auth
            @can('access admin pages')
                <a href="{{ route('admin.dashboard') }}">
                    Admin Page
                </a>
                <br>
            @endcan

            <a href="{{ route('dashboard') }}">
                Home Page
            </a>
            <br>

            <a href="{{ route('logout') }}">
                Logout
            </a>
            <br>
        @endauth
    
        <a href="{{ route('about-us') }}">
            About Us
        </a>
        <hr>

        {{-- Heading --}}
        @yield('heading')

        <hr>
        {{-- Main content --}}
        @yield('content')
    </body>
</html>