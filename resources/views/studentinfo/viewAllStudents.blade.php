@extends('layouts.Layout')

@section('title','View All Students')

@section('content')
<style>
textarea { width:250px !important; height:100px !important; }
</style>

<div class="generalHeader">
    View All Students
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
 <div class="row">
    <div class="col-md-12 col-sm-12">
		<br>
		<a class="btn btn-info" href="addStudentView">Add student</a>
		<!-- do if else to check if there are students to archive -->
		@if($ifGraduating == 'yes')
			<a class="btn btn-warning" href="{{action('StudentInfoController@archiveStudent', ['archive' => 'yes'])}}">Archive Students</a>
		@else 
			<a class="btn btn-warning disabled" href="#">All Archived</a>
		@endif
        <br><br>
		
        <table width="100%" cellpadding="5" cellspacing="5" id="gradesList" border="1"  class="table table-striped table-bordered dt-responsive" >
            <thead>

                <tr><th>Student Name</th><th>Metric Num</th><th>Email</th><th>H/P No.</th>
                @if(auth()->guard('lecturer')->check())
                <th>CGPA</th> 
                @endif
                <th width="40%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allStudentInfo as $student)
                <tr>   
                <td>{{  $student->studentname }}</td>
				        <td>{{  $student->metric }}</td>
                <td>{{  $student->studentemail }}</td>
                <td>{{  $student->contact }}</td>
                @if(auth()->guard('lecturer')->check())
                <td>{{decrypt($student->cgpa)}}</td> 
                @endif
				        
                <td>
                 <a class="btn btn-primary" href="{{  $student->studentid }}/editStudentInfoView">Edit Info</a>
               
                 <a class="btn btn-success" href="{{  $student->studentid }}/resetpwd">Reset Password</a>

                </td>

                </tr>  
                @endforeach
            </tbody>
        </table>
        {!! $allStudentInfo->render() !!}

		
    </div>

</div>   

</body>

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