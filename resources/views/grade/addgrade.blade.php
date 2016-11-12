@extends('layouts.layout')

@section('title','Add Grade')

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
    Add Grade
</div>
<?php echo Form::open(array('url' => 'grade/'.$moduleid.'/'.$gradeid.'/addgrade', 'method' => 'post')) ?>
 <div class="form-group">
            {!!Form::label('grade','Marks')!!}
            {!!Form::text('grade',null,array('class' => 'form-control', 'required' => 'required'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('recommendation','Recommendation')!!}
            {!!Form::textarea('recommendation',null,array('class' => 'form-control'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('Moderation','Select Moderation')!!}
            <select id="moderation" name="moderation">
            <option value="0.0" selected="true">Select If applicable</option>                      
            <option value="1">1.0</option>
            <option value="2">2.0</option>
            <option value="3">3.0</option>
            <option value="4">4.0</option>
            <option value="5">5.0</option>
            </select>
        </div>
       <a href="{{URL::asset('grade/index')}}" class="btn btn-danger" style="float:right;">Back to Grades list</a>
        {!!Form::submit('Add Grade', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
@stop