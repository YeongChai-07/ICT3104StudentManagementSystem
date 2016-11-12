@extends('layouts.Layout')

@section('title', 'Backup Settings')

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
    Backup Settings
</div>
<?php echo Form::open(array('url' => 'admin/backupsettings', 'method' => 'post')) ?>
        <div class="form-group">
		{!!Form::label('duration','Choose Daily or Monthly Backup')!!}<br>
     	{{ Form::radio('settings', 0,true) }} Daily<br>
		{{ Form::radio('settings', 1) }} Monthly
		</div>
        {!!Form::submit('Update Preference', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
@stop
