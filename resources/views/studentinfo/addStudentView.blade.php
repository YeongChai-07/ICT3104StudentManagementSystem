@extends('layouts.layout')

@section('title','Add Student')

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
    Add Student
</div>
<?php echo Form::open(array('url' => 'studentinfo/addStudentView', 'method' => 'post')) ?>
 <!-- form --> 
 <div class="form-group">
    {!! Form::label('name', 'Student Name:', ['class' => 'control-label']) !!}
	{!!Form::text('name',null, array('class' => 'form-control','required' => 'required'))!!}
   
</div>

		
		
		
 <div class="form-group">
    {!! Form::label('title', 'Metric Number:', ['class' => 'control-label']) !!}
	{!!Form::text('metric', null, array('class' => 'form-control','required' => 'required'))!!}
	

   
</div>



<div class="form-group">
    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
	{!!Form::text('email',null, array('class' => 'form-control','required' => 'required'))!!}
   
</div>

<div class="form-group">
    {!! Form::label('contact', 'Contact Number:', ['class' => 'control-label']) !!}
	{!!Form::text('contact', null, array('class' => 'form-control','required' => 'required'))!!}
   
</div>

<div class="form-group">
    {!! Form::label('address', 'Address:', ['class' => 'control-label']) !!}
	{!!Form::text('address',null, array('class' => 'form-control','required' => 'required'))!!}
   
</div>
		
		
       <a href="{{URL::asset('studentinfo/viewAllStudents')}}" class="btn btn-primary" style="float:right;">Back to Student list</a>
        {!!Form::submit('Add', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
@stop