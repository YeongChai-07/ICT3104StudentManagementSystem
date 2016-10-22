@extends('layouts.layout')

@section('title','Edit Student')

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
    Edit Student
</div>
<?php echo Form::open(array('url' => 'admin/'.$student->studentid.'/editstudent', 'method' => 'post')) ?>
 <div class="form-group">
            {!!Form::label('name','Name')!!}
            {!!Form::text('name',$student->studentname,array('class' => 'form-control'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('email','Email')!!}
            {!!Form::text('email',$student->studentemail,array('class' => 'form-control', 'required' => 'required'))!!}
        </div>
		<div class="form-group">
            {!!Form::label('Contact Number','Contact Number')!!}
            {!!Form::text('contact',$student->contact,array('class' => 'form-control', 'required' => 'required'))!!}
        </div>
       <a href="{{URL::asset('admin/index')}}" class="btn btn-primary" style="float:right;">Back to Student list</a>
        {!!Form::submit('Update', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
@stop