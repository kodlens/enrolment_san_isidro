<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/img/tcnhs_logo.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{--    <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>


        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .bg-image {
            /* The image used */
            background-image: url('/img/bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;

            /* Add the blur effect */
            filter: blur(8px);
            -webkit-filter: blur(8px);

            /* Full height */
            height: 100vh;

            /* Center and scale the image nicely */
            background-position: center;
        }


        /* Position text in the middle of the page/image */
        .bg-text {
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
            color: white;
            font-weight: bold;
            border: 3px solid #f1f1f1;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            width: 80%;
            padding: 20px;
            text-align: center;
        }


    </style>
</head>

<body>
    
    <div id="app">
        
        <b-navbar>
            <template #brand>
                <b-navbar-item>
                    <img src="/img/tudela_logo.png" />
                    ENROLMENT SYSTEM
                </b-navbar-item>
            </template>
    
            <template #start>
               
    
            </template>
    
            <template #end>
                <b-navbar-item href="/">
                        Home
                </b-navbar-item>
                @auth()
                    <b-navbar-item tag="div">
                        <div class="buttons">
                            <b-button label="LOGOUT" icon-left="logout" onclick="document.getElementById('logout').submit()">
                            </b-button>
                        </div>
                    </b-navbar-item>
                @else
                    <!-- <b-navbar-item href="/registration">
                        Register
                    </b-navbar-item> -->
                    
                    <b-navbar-item tag="div">
                        <div class="buttons">
                            <a class="button is-primary is-outlined" href="/login">
                                <strong>Login</strong>
                            </a>
                        </div>
                    </b-navbar-item>
                @endauth
                
            </template>
        </b-navbar>

        <form id="logout" action="/logout" method="post"> @csrf </form>

        <div>
            @yield('content')
        </div>
        
    </div>


</body>

</html>
