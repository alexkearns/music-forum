<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Service Foundation Teacher</title>

        <!-- Fonts -->
        <link rel="script" href="https://use.fontawesome.com/2732663828.js">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">

        <style>
            html, body {
                background-color: white;
                color: #464a4e;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 85vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 4em;
                color: black;
            }

            .btn-primary {
                color: #464a4e;
                background-color: white;
                border-color: #464a4e;
                margin:10px;
            }

            .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open>.dropdown-toggle.btn-primary {
                color: #464a4e;
                background-color: #e6e5e5;
                border-color:#adadad;
                box-shadow: 0 0 0 0.2rem #f8f9fa; 
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2" >
                <img src="/img/uea_logo.jpg" alt="UEA Logo">

                <div class="title">
                    {{ config('app.name') }}
                </div>

                <div class="sub-heading">
                    <h4>Post messages on the LCR forum.</h4>
                </div>

                @if (Route::has('login'))
                    <div>
                        @if (Auth::check())
                            <a class="btn btn-primary btn-lg" href="{{ url('/home') }}">Home</a>
                        @else
                            <a class="btn btn-primary btn-lg" href="{{ url('/login') }}">Login</a>
                            <a class="btn btn-primary btn-lg" href="{{ url('/register') }}">Register</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
