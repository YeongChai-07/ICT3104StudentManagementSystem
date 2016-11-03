@extends('layouts.layout')

@section('title','Add Module')

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
    Add Module
</div>
<?php echo Form::open(array('url' => 'admin/addmodule', 'method' => 'post')) ?>
 <div class="form-group">
            {!!Form::label('name','Module Name')!!}
             {!!Form::text('name',null,array('class' => 'form-control', 'required' => 'required'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('description','Description')!!}
            {!!Form::text('description',null,array('class' => 'form-control'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('credit','Credit')!!}
            {!!Form::text('credit',null,array('class' => 'form-control'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('lecturer','Lecturer Incharge')!!}
              <select class="form-control" name="lecturer">
                @foreach($lecturers as $lecturer)
                  <option value="{{$lecturer->lecturerid}}">{{$lecturer->lecturername}}</option>
                @endforeach
              </select>

        </div>

        <div class="form-group">
            {!!Form::label('hod','Hod Incharge')!!}
              <select class="form-control" name="hod">
                @foreach($hods as $hod)
                  <option value="{{$hod->hodid}}">{{$hod->hodname}}</option>
                @endforeach
              </select>

        </div>
        <div class="form-group">
        
            {!!Form::label('editdate','Edit Date')!!}
             {!! Form::text('editdate', null, ['required','readonly' ,'class' => 'form-control datepicker']) !!}
        </div> 
        <div class="form-group">
        
            {!!Form::label('freezedate','freeze Date')!!}
             {!! Form::text('freezedate', null, ['required','readonly' ,'class' => 'form-control datepicker']) !!}
        </div> 

       
       

       <a href="{{URL::asset('admin/module')}}" class="btn btn-primary" style="float:right;">Back to Module list</a>
        {!!Form::submit('Add', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
@stop

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

<script>
  $(function($) {
    $( ".datepicker" ).datepicker({ 
        dateFormat: 'y-m-d',
        minDate: new Date(),
           onSelect : function(selected_date){
        var selectedDate = new Date(selected_date);
        var msecsInADay = 86400000;
        var endDate = new Date(selectedDate.getTime() /*+ msecsInADay*/);
        var minDate = selected_date;
         $(".selectEndDate").datepicker( "option", "minDate", endDate, {dateFormat: 'y-m-d'} );
      } 
    });
    $('.selectEndDate').datepicker({dateFormat: 'y-m-d', minDate: new Date() });
});
</script>
