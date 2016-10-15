<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- CSS Styling -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/stylesheet.css') }}">
    <link href="{{ URL::asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Everything of section 'title' will be in <title> -->
    <title>@yield('title')</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a style="font-size:1.7em; font-weight:bold; text-decoration:none;" href="">
                        <img src="{{ URL::asset('assets/images/sit-logo.png') }}" style="margin:10px;" width="100" alt="IntePlayer" >
                    </a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Login Buttons (If not logged in) -->
                        <!-- Student -->
                        @if(auth()->guard('student')->check())
                            <li><a href="{{URL::asset('student/grade')}}">View Grade</a></li><!--// added-->
                            <li><a href="{{URL::asset('student/module')}}">View All Module</a></li> <!--// added-->


                            <li><a href="{{URL::asset('student/recommendation')}}">View Recommendation</a></li>
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ auth()->guard('student')->user()->studentname }} <span class="glyphicon glyphicon-cog"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{URL::asset('student/editdetails')}}">Edit Details</a></li>

                                        <li><a href="{{URL::asset('student/showdetails')}}">View Details</a></li><!--// added-->
                                        <li><a href="{{URL::asset('student/change')}}">Change Password</a></li>
                                        <li><a href="{{URL::asset('student/logout')}}">Log Out</a></li>
                                         
                                    </ul>
                        <!-- Admin -->
                         @elseif(auth()->guard('web')->check())
                            <li><a href="{{URL::asset('user/index')}}">View Student</a></li>
                            <li><a href="{{URL::asset('user/hod')}}">View HOD</a></li>
                            <li><a href="{{URL::asset('user/lecturer')}}">View Lecturer</a></li>
                            <li><a href="{{URL::asset('user/module')}}">View Module</a></li>
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ auth()->guard('web')->user()->name }} <span class="glyphicon glyphicon-cog"></span></a>
                                    <ul class="dropdown-menu">
                                    <li><a href="{{URL::asset('user/editdetails')}}">Edit Details</a></li>
                                     <li><a href="{{URL::asset('user/showdetails')}}">View Details</a></li><!--// added-->
                                    <li><a href="{{URL::asset('user/change')}}">Change Password</a></li>
                                        <li><a href="{{URL::asset('user/logout')}}">Log Out</a></li>
                                        <!-- <li><a href="{{URL::asset('pretest/change')}}">Change Password</a></li> -->
                                    </ul>

                        <!-- HOD -->
                         @elseif(auth()->guard('hod')->check())
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ auth()->guard('hod')->user()->hodname }} <span class="glyphicon glyphicon-cog"></span></a>
                                    <ul class="dropdown-menu">
                                    <li><a href="{{URL::asset('hod/editdetails')}}">Edit Details</a></li>
                                     <li><a href="{{URL::asset('hod/showdetails')}}">View Details</a></li><!--// added-->
                                    <li><a href="{{URL::asset('hod/change')}}">Change Password</a></li>
                                        <li><a href="{{URL::asset('hod/logout')}}">Log Out</a></li>
                                        <!-- <li><a href="{{URL::asset('pretest/change')}}">Change Password</a></li> -->
                                    </ul> 

                        <!-- Lecturer                         -->
                         @elseif(auth()->guard('lecturer')->check())
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ auth()->guard('lecturer')->user()->lecturername }} <span class="glyphicon glyphicon-cog"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{URL::asset('lecturer/editdetails')}}">Edit Details</a></li>
                                         <li><a href="{{URL::asset('lecturer/showdetails')}}">View Details</a></li><!--// added-->
                                         <li><a href="{{URL::asset('lecturer/change')}}">Change Password</a></li>
                                        <li><a href="{{URL::asset('lecturer/logout')}}">Log Out</a></li>
                                        <!-- <li><a href="{{URL::asset('pretest/change')}}">Change Password</a></li> -->
                                    </ul> 
                            @else                   
                            <li><a class="studentlink orange" href="{{URL::asset('student/login')}}">Student Login</a></li>
                            <li><a class="studentlink btn-primary" href="{{URL::asset('user/login')}}">Admin Login</a></li> 
                            <li><a class="studentlink btn-danger" href="{{URL::asset('hod/login')}}">Hod Login</a></li>   
                            <li><a class="studentlink btn-info" href="{{URL::asset('lecturer/login')}}">Lecturer Login</a></li>
                            @endif                                         
                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-5 col-md-offset-0">
                                @yield('breadcrumb')
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div classr="content">
                            @yield('content')
                        </div>
                    </div>
                    <script type="text/javascript" src="{{asset('assets/js/jquery-1.12.4.min.js')}}"></script>
                    <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
            </body>
            </html>