<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Styles -->
    <link href="{{url('css/app.css')}}" rel="stylesheet" type="text/css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    @yield('styles')
</head>

<body>
@auth
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                @can('manage-users')
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('manage-users') }}">Manage Users</a>
                    </li>
                @endcan
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">{{ \Auth::user()->name }}</a>

                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ route('profile', \Auth::user()->id) }}">Profile</a>
                        <div class="dropdown-divider"></div>
                        <form id="logout" action="{{ route('logout') }}" method="POST">
                            {{ csrf_field() }}
                            <a class="dropdown-item" href="#" onclick="document.getElementById('logout').submit();">Logout</a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
@endauth

<main role="main" class="container">
    <div class="row">
        <div class="col-12">
            @include('flash::message')
            @yield('content')
        </div>
    </div>
</main>

<!-- Scripts -->
<script src="{{url('js/app.js')}}"></script>
</body>
</html>
