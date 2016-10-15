@extends('layouts.layout')
@section('title', 'Change Password')
@section('content')
<div class="row">

    <div class="col-md-4 col-md-offset-4">
    
        <h3>Change Password</h3>

    
@if(Session::has('error_message'))
 <div class="alert alert-danger">{{ Session::get('error_message') }}</div>
 {{Session::forget('error_message')}}
@endif
 @if(Session::has('success_message'))
  <div class="alert alert-success">{{ Session::get('success_message') }}</div>
 {{Session::forget('success_message')}}
 @endif
    

        {!! Form::open() !!}
        <div class="form-group">
            {!!Form::label('old-password','Old Password')!!}
            {!!Form::password('old-password',array('class' => 'form-control', 'required' => 'required'))!!}
        </div>
         <div class="form-group">
            {!!Form::label('password','New Password')!!}
            {!!Form::password('password',array('class' => 'form-control', 'required' => 'required'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('password_confirmation','Re enter Password')!!}
            {!!Form::password('password_confirmation', array('class' => 'form-control', 'required' => 'required'))!!}
        </div>
       
        {!!Form::submit('Change Password', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
    </div>
</div>
@stop