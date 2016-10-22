@extends('layouts.Layout')

@section('title','View Lecturer')

@section('content')
<style>
textarea { width:250px !important; height:100px !important; }
</style>

<div class="generalHeader">
    View Lecturer
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
        <a class="btn btn-info" href="addlecturer">Add new Lecturer</a>

        <table width="100%" cellpadding="5" cellspacing="5" id="LecturersList" border="1"  class="table table-striped table-bordered dt-responsive" >
            <thead>
                <tr><th>S/N</th><th>Name</th><th>Email</th><th>Contact Number</th><th width="40%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lecturers as $key=>$lecturer)
                <tr>
                <td>{{   $lecturer->lecturerid }}</td>
                <td>{{  $lecturer->lecturername }}</td>
                <td class="td-limit">{{  $lecturer->lectureremail }}</td>
				<td>{{  $lecturer->contact }}</td>
                <td>

                 <a class="btn btn-info" href="{{  $lecturer->lecturerid }}/editlecturer">Edit</a>
                <a class="btn btn-danger" onclick="checkDelete()" href="{{  $lecturer->lecturerid }}/deletelecturer">Delete</a>

                </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {!! $lecturers->render() !!}
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
  
  $('#LecturersList').DataTable( {
  aaSorting : [[1, 'asc']],
    responsive: true,
  'paging':false,
  "bStateSave": true,
  "iCookieDuration": 365*60*60*24
});
  
  });
</script>