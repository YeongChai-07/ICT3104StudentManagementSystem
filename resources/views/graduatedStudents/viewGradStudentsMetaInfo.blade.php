@extends('layouts.Layout')

@section('title','Modules Enrolled')

@section('content')
<style>
textarea { width:250px !important; height:100px !important; }
</style>

<div class="generalHeader">
   Modules Enrolled
</div>
<body>
   
    @if(Session::has('error_message'))
        <div class="alert alert-danger">{{ Session::get('error_message') }}</div>
        {{Session::forget('error_message')}}
    @endif
    <br/>
 <div class="row">
    <div class="col-md-12 col-sm-12">
        <br><br>
        
        <table width="100%" cellpadding="5" cellspacing="5" id="modulesList" border="1"  class="table table-striped table-bordered dt-responsive" >
            <thead>

                <tr><th>S/N</th><th>Module Name</th><th>Module Description</th><th>GPA</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modules as $key=>$module)
                <tr>
                <td>{{  $module->id }}</td>
                <td>{{  $module->modulename }}</td>
                <td> {{ $module->description }}</td>
                <td> {{ $module->grade }}</td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        <h3 align="right">Your CGPA is {{ decrypt($student->cgpa)}}</h3>
		<a class="btn btn-primary" style="float:right" href="{{URL::asset('graduatedStudents/viewAllGradStudents')}}">Back</a>
    </div>
</div>   

</body>

@stop


<script type="text/javascript">
    //Pop up
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@include('layouts.datatables')
<script type="text/javascript">
  $(function($) {
  
  $('#modulesList').DataTable( {
  aaSorting : [[1, 'asc']],
    responsive: true,
  'paging':false,
  "bStateSave": true,
  "iCookieDuration": 365*60*60*24
});
  
  });
</script>