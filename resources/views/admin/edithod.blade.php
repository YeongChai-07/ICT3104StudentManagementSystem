@extends('layouts.layout')

@section('title','Edit Hod')

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
    Edit Hod
</div>
<?php echo Form::open(array('url' => 'admin/'.$hod->hodid.'/edithod', 'method' => 'post')) ?>
 <div class="form-group">
            {!!Form::label('name','Name')!!}
            {!!Form::text('name',$hod->hodname,array('class' => 'form-control'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('metric','Metric')!!}
            {!!Form::text('metric',$hod->metric,array('class' => 'form-control', 'required' => 'required'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('email','Email')!!}
            {!!Form::text('email',$hod->hodemail,array('class' => 'form-control', 'required' => 'required'))!!}
        </div>
		<div class="form-group">
            {!!Form::label('Contact Number','Contact Number')!!}
            {!!Form::text('contact',$hod->contact,array('class' => 'form-control', 'required' => 'required'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('address','Address')!!}
            {!!Form::text('address',$hod->address,array('class' => 'form-control', 'required' => 'required'))!!}
        </div>
       <a href="{{URL::asset('admin/hod')}}" class="btn btn-primary" style="float:right;">Back to Hod list</a>
        {!!Form::submit('Update', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
@stop