@extends('layouts.layout')

@section('title','Edit Lecturer')

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
    Edit Lecturer
</div>
<?php echo Form::open(array('url' => 'user/'.$lecturer->lecturerid.'/editlecturer', 'method' => 'post')) ?>
 <div class="form-group">
            {!!Form::label('name','Name')!!}
            {!!Form::text('name',$lecturer->lecturername,array('class' => 'form-control'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('email','Email')!!}
            {!!Form::text('email',$lecturer->lectureremail,array('class' => 'form-control', 'required' => 'required'))!!}
        </div>
       <a href="{{URL::asset('user/lecturer')}}" class="btn btn-danger" style="float:right;">Back to Lecturer list</a>
        {!!Form::submit('Update', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
@stop