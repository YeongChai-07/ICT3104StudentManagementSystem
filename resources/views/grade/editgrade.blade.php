@extends('layouts.layout')

@section('title','Edit Grade')

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
    Edit Grade
</div>
<?php echo Form::open(array('url' => 'grade/'.$moduleid.'/'.$gradeid.'/editgrade', 'method' => 'post')) ?>
 <div class="form-group">
            {!!Form::label('grade','Marks')!!}
            {!!Form::text('grade',decrypt($grades->marks),array('class' => 'form-control', 'required' => 'required'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('recommendation','Recommendation')!!}
            @if(!isset($recommendations->recommendation))
           
             {!!Form::textarea('recommendation',null,array('class' => 'form-control'))!!}
            @else
     
             {!!Form::textarea('recommendation',$recommendations->recommendation,array('class' => 'form-control'))!!} 
            @endif
        </div>
        <div class="form-group">
            {!!Form::label('recomended Marks','Recommended Marks')!!}
            {!!Form::text('moderation',$recommendations->moderation,array('class' => 'form-control'))!!}
        </div>
       <a href="{{URL::asset('grade/index')}}" class="btn btn-danger" style="float:right;">Back to Grades list</a>
        {!!Form::submit('Edit Grade', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
@stop