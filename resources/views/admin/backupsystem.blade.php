@extends('layouts.Layout')

@section('title', 'Backup application and Database')

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
    Backup System
</div>
<?php echo Form::open(array('url' => 'admin/backupsystem', 'method' => 'post')) ?>
 <div class="form-group">
            {!!Form::label('file','Enter Directory to save backup')!!}
            {!!Form::text('file',null,array('class' => 'form-control', 'required' => 'required'))!!}
            <!-- {!!Form::file('file')!!} -->

        </div>
     
        {!!Form::submit('Perform Backup', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
@stop
