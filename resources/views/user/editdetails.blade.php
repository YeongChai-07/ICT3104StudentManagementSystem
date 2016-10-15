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
<?php echo Form::open(array('url' => 'user/editdetails', 'method' => 'post')) ?>
 <div class="form-group">
            {!!Form::label('contact','Contact Number')!!}
            {!!Form::text('contact',$user->contact,array('class' => 'form-control','required' => 'required'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('address','Address')!!}
            {!!Form::textarea('address',$user->address,array('class' => 'form-control'))!!}
        </div>
       <a href="{{URL::asset('user/index')}}" class="btn btn-danger" style="float:right;">Back to Homepage</a>
        {!!Form::submit('Update', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
@stop