@extends('layouts.layout')

@section('title','Edit Admin')

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
    Edit Admin
</div>
<?php echo Form::open(array('url' => 'admin/'.$admin->adminid.'/editadmin', 'method' => 'post')) ?>
 <div class="form-group">
            {!!Form::label('name','Name')!!}
            {!!Form::text('name',$admin->adminname,array('class' => 'form-control'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('email','Email')!!}
            {!!Form::text('email',$admin->adminemail,array('class' => 'form-control', 'required' => 'required'))!!}
        </div>		
		<div class="form-group">
            {!!Form::label('Contact Number','Contact Number')!!}
            {!!Form::text('contact',$admin->contact,array('class' => 'form-control', 'required' => 'required'))!!}
        </div>
		
       <a href="{{URL::asset('admin/admin')}}" class="btn btn-primary" style="float:right;">Back to Admin list</a>
        {!!Form::submit('Update', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
@stop