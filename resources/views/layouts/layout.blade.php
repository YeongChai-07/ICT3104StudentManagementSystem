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
                      
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ auth()->guard('student')->user()->studentname }} <span class="glyphicon glyphicon-cog"></span></a>
								<ul class="dropdown-menu">
									<li><a href="{{URL::asset('common/editdetails')}}">Edit Details</a></li>
									<li><a href="{{URL::asset('common/showdetails')}}">View Details</a></li><!--// added-->
									<li><a href="{{URL::asset('common/change')}}">Change Password</a></li>
									<li><a href="{{URL::asset('common/logout')}}">Log Out</a></li>
									 
								</ul>
							</li>
                        <!-- Admin -->
                         @elseif(auth()->guard('admin')->check())
                            <li><a href="{{URL::asset('admin/index')}}">View Student</a></li>
                            <li><a href="{{URL::asset('admin/hod')}}">View HOD</a></li>
                            <li><a href="{{URL::asset('admin/lecturer')}}">View Lecturer</a></li>
							<li><a href="{{URL::asset('admin/admin')}}">View Admin</a></li>
                            <li><a href="{{URL::asset('admin/module')}}">View Module</a></li>
							<li><a href="{{URL::asset('admin/backupsystem')}}">Backup System</a></li>
							<li><a href="{{URL::asset('studentinfo/viewAllStudents')}}">Students</a></li>
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ auth()->guard('admin')->user()->name }} <span class="glyphicon glyphicon-cog"></span></a>
								<ul class="dropdown-menu">
									<li><a href="{{URL::asset('common/editdetails')}}">Edit Details</a></li>
									<li><a href="{{URL::asset('common/showdetails')}}">View Details</a></li><!--// added-->
									<li><a href="{{URL::asset('common/change')}}">Change Password</a></li>
									<li><a href="{{URL::asset('common/logout')}}">Log Out</a></li>
									<!-- <li><a href="{{URL::asset('pretest/change')}}">Change Password</a></li> -->
								</ul>
							</li>
							
                        <!-- HOD -->
                         @elseif(auth()->guard('hod')->check())						 
							<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ auth()->guard('hod')->user()->hodname }} <span class="glyphicon glyphicon-cog"></span></a>
								<ul class="dropdown-menu">
									<li><a href="{{URL::asset('common/editdetails')}}">Edit Details</a></li>
									<li><a href="{{URL::asset('common/showdetails')}}">View Details</a></li><!--// added-->
									<li><a href="{{URL::asset('common/change')}}">Change Password</a></li>
									<li><a href="{{URL::asset('common/logout')}}">Log Out</a></li>
									<!-- <li><a href="{{URL::asset('pretest/change')}}">Change Password</a></li> -->
								</ul> 
							</li>
                        <!-- Lecturer-->
                         @elseif(auth()->guard('lecturer')->check())
							<li><a href="{{URL::asset('studentinfo/viewAllStudents')}}">Students</a></li>
							<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ auth()->guard('lecturer')->user()->lecturername }} <span class="glyphicon glyphicon-cog"></span></a>
								<ul class="dropdown-menu">
									<li><a href="{{URL::asset('common/editdetails')}}">Edit Details</a></li>
									<li><a href="{{URL::asset('common/showdetails')}}">View Details</a></li><!--// added-->
									<li><a href="{{URL::asset('common/change')}}">Change Password</a></li>
									<li><a href="{{URL::asset('common/logout')}}">Log Out</a></li>
									<!-- <li><a href="{{URL::asset('pretest/change')}}">Change Password</a></li> -->
								</ul> 
							</li>
						
						@else 
								
						
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