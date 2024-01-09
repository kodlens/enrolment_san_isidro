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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Manrope:wght@200;300;400;700&family=Roboto+Condensed:wght@300;400;500;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        html body{
            font-family: 'Josefin Sans', sans-serif;
            font-family: 'Manrope', sans-serif;
            font-family: 'Roboto', sans-serif;
            font-family: 'Roboto Condensed', sans-serif;
        }

        input[type='text'], input[type='password'], select, button{
            font-family: 'Josefin Sans', sans-serif;
            font-family: 'Manrope', sans-serif;
            font-family: 'Roboto', sans-serif;
            font-family: 'Roboto Condensed', sans-serif;
        }
    </style>
</head>

<body>
    
    <div id="app">
        
        <b-navbar>
            <template #brand>
                <b-navbar-item>
                    <img src="/img/tudela_logo.png" />
                    @auth()
                        {{ Auth::user()->role }}
                    @else
                        ENSYS
                    @endauth
                </b-navbar-item>
            </template>
    
            <template #start>

            </template>
    
            <template #end>
                
                <b-navbar-item href="/admin-dashboard">
                    Home
                </b-navbar-item>

                <b-navbar-dropdown label="Manage">

                    <b-navbar-item href="/academic-years">
                        Academic Years
                    </b-navbar-item>

                    <b-navbar-item href="/subjects">
                        Subjects
                    </b-navbar-item>                                                                                                                                    

                    <b-navbar-item href="/tracks">
                        Tracks
                    </b-navbar-item>

                    <b-navbar-item href="/strands">
                        Strands
                    </b-navbar-item>    
                    
                    <b-navbar-item href="/teachers">
                        Teachers
                    </b-navbar-item>

                </b-navbar-dropdown>

                <b-navbar-dropdown label="Curriculum">

                    <b-navbar-item href="/manage-curriculums">
                        Manage Curriculum
                    </b-navbar-item>

                    <b-navbar-item href="/grade-levels">
                        Grade Level
                    </b-navbar-item>

                    
                    <b-navbar-item href="/grade-level-subjects">
                        Setup Grade Level Subjects
                    </b-navbar-item>

                    <b-navbar-item href="/sections">
                        Sections
                    </b-navbar-item>

                </b-navbar-dropdown>


               

                <b-navbar-dropdown label="Enrollment">

                    <b-navbar-item href="/manage-learners">
                        Learners
                    </b-navbar-item>
                    <b-navbar-item href="/enrollment">
                        Admission
                    </b-navbar-item>
                   
                    <b-navbar-item href="/enrollee">
                        Enrollee
                    </b-navbar-item>

                    <b-navbar-item href="/assign-teacher">
                        Assign Teacher
                    </b-navbar-item>
                    
                </b-navbar-dropdown>


                <b-navbar-dropdown label="Cashier">

                    <b-navbar-item href="/other-fees">
                        Other Fees
                    </b-navbar-item>


                    <b-navbar-item href="/billing-subjects">
                        Billing Subject
                    </b-navbar-item>

                    <b-navbar-item href="/billing-payment">
                        Payment
                    </b-navbar-item>

                </b-navbar-dropdown>
                

                <b-navbar-dropdown label="Records">

                    {{-- <b-navbar-item href="/enrollee-grades">
                        Learner Grades
                    </b-navbar-item> --}}

                    <b-navbar-item href="/enrollee-credentials">
                        Credentials
                    </b-navbar-item>

                    <b-navbar-item href="/enrollee-credential-list">
                        Credential List
                    </b-navbar-item>

                </b-navbar-dropdown>

                <b-navbar-dropdown label="Report">
                    <b-navbar-item href="/report-class-list">
                        Class List
                    </b-navbar-item>
                    <b-navbar-item href="/report-enrolment-list">
                        Enrolment List
                    </b-navbar-item>
                </b-navbar-dropdown>

                <b-navbar-item href="/users">
                    Users
                </b-navbar-item>
                <b-navbar-item tag="div">
                    @auth()
                        <div class="buttons">
                            <b-button label="LOGOUT" 
                                type="is-danger"
                                icon-left="logout" 
                                onclick="document.getElementById('logout').submit()">
                            </b-button>
                        </div>
                    @else
                        <div class="buttons">
                            <a class="button is-primary is-outlined" href="/login">
                                <strong>Login</strong>
                            </a>
                        </div>
                    @endauth
                </b-navbar-item>
                
            </template>
        </b-navbar>

        <form id="logout" action="/logout" method="post"> @csrf </form>

        @yield('content')
        
    </div>

    <script>
        
    </script>

</body>

</html>
