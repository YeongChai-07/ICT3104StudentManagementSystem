@extends('layouts.layout')

@section('title','Edit Details')

@section('content')

@if(Session::has('error_message'))
 <div class="alert alert-danger">{{ Session::get('error_message') }}</div>
 {{Session::forget('error_message')}}
@endif
 @if(Session::has('success_message'))
  <div class="alert alert-success">{{ Session::get('success_message') }}</div>
 {{Session::forget('success_message')}}
 @endif

<div class="generalHeader">
    Edit Details
</div>
<?php echo Form::open(array('url' => 'common/editdetails', 'method' => 'post')) ?>
<div class="form-group">
            {!!Form::label('name','Name:')!!}
            {!!Form::label('name2',$name)!!}
        </div>
		<div class="form-group">
            {!!Form::label('contact','Contact Number')!!}
            {!!Form::text('contact',$contact ,array('class' => 'form-control'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('address','Address')!!}
            {!!Form::text('address',$address, array('class' => 'form-control'))!!}
        </div>
		
		@if (auth()->guard('admin')->check())
			<a href="{{URL::asset('admin/index')}}" class="btn btn-primary" style="float:right;">Home</a>
		
		@elseif (auth()->guard('lecturer')->check())
			<a href="{{URL::asset('lecturer/index')}}" class="btn btn-primary" style="float:right;">Home</a>
		
		@elseif (auth()->guard('hod')->check())
			<a href="{{URL::asset('hod/index')}}" class="btn btn-primary" style="float:right;">Home</a>
		
		@else 
			<a href="{{URL::asset('student/index')}}" class="btn btn-primary" style="float:right;">Home</a>
		@endif
       
	   
	   
	   
        {!!Form::submit('Update', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
@stop