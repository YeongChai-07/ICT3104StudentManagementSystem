@extends('layouts.Layout')

@section('title','Edit Student Info')

@section('content')
<style>
textarea { width:250px !important; height:100px !important; }
</style>

<div class="generalHeader">
    Edit {{$student->studentname}}'s Particulars
</div>

<body>
   
    @if(Session::has('error_message'))
        <div class="alert alert-danger">{{ Session::get('error_message') }}</div>
        {{Session::forget('error_message')}}
    @endif
    @if(Session::has('success_message'))
    <div class="alert alert-success">{{ Session::get('success_message') }}</div>
    {{Session::forget('success_message')}}
    @endif
    <br/>

<?php echo Form::open(array('url' => 'studentinfo/'.$student->studentid.'/editStudentInfoView', 'method' => 'post')) ?>
<!-- form --> 
 <div class="form-group">
    {!! Form::label('title', 'Metric Number:', ['class' => 'control-label']) !!}
	{!!Form::text('metric', $student->metric, array('class' => 'form-control'))!!}
	

   
</div>

 <div class="form-group">
    {!! Form::label('name', 'Student Name:', ['class' => 'control-label']) !!}
	{!!Form::text('name',$student->studentname, array('class' => 'form-control'))!!}
   
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
	{!!Form::text('email',$student->studentemail, array('class' => 'form-control'))!!}
   
</div>

<div class="form-group">
    {!! Form::label('contact', 'Contact Number:', ['class' => 'control-label']) !!}
	{!!Form::text('contact', $student->contact, array('class' => 'form-control'))!!}
   
</div>

<div class="form-group">
    {!! Form::label('address', 'Address:', ['class' => 'control-label']) !!}
	{!!Form::text('address',$student->address, array('class' => 'form-control'))!!}
   
</div>
 <div class="form-group">
    
	{!!Form::hidden('studentid', $student->studentid)!!}

   
</div>


<!-- ./form -->
 <a href="{{URL::asset('studentinfo/viewAllStudents')}}" class="btn btn-danger" style="float:right;">Back to Student list</a>


 
<!-- button -->
{!! Form::submit('Update Task', ['class' => 'btn btn-primary']) !!}


{!! Form::close() !!}


@stop


<script type="text/javascript">
    //Pop up
function checkDelete(){
    return confirm('Are you sure?');
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@include('layouts.datatables')
<script type="text/javascript">
  $(function($) {
  
  $('#gradesList').DataTable( {
  aaSorting : [[1, 'asc']],
    responsive: true,
  'paging':false,
  "bStateSave": true,
  "iCookieDuration": 365*60*60*24
});
  
  });
</script>