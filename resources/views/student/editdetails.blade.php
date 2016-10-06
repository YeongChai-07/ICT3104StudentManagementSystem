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
<?php echo Form::open(array('url' => 'student/editdetails', 'method' => 'post')) ?>
 <div class="form-group">
            {!!Form::label('contact','Contact Number')!!}
            {!!Form::text('contact',$student->contact,array('class' => 'form-control','required' => 'required'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('address','Address')!!}
            {!!Form::textarea('address',$student->address,array('class' => 'form-control'))!!}
        </div>
       <a href="{{URL::asset('student/index')}}" class="btn btn-danger" style="float:right;">Back to Grades list</a>
        {!!Form::submit('Update', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
@stop