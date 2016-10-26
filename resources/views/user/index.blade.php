@extends('layouts.Layout')

@section('title','View Students')

@section('content')
<style>
textarea { width:250px !important; height:100px !important; }
</style>

<div class="generalHeader">
    View Students
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

       <!--  <a class="btn btn-info" href="addstudent">Add new Student</a> -->

        <table width="100%" cellpadding="5" cellspacing="5" id="studentsList" border="1"  class="table table-striped table-bordered dt-responsive" >
            <thead>
                <tr><th>S/N</th><th>Name</th><th>Email</th><th width="40%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $key=>$student)
                <tr>
                <td>{{   $student->studentid }}</td>
                <td>{{  $student->studentname }}</td>
                <td class="td-limit">{{  $student->studentemail }}</td>
                <td>

<!--                  <a class="btn btn-info" href="{{  $student->studentid }}/editstudent">Edit</a>
                <a class="btn btn-danger" onclick="checkDelete()" href="{{  $student->studentid }}/deletestudent">Delete --></a>

                </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {!! $students->render() !!}
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
  
  $('#studentsList').DataTable( {
  aaSorting : [[1, 'asc']],
    responsive: true,
  'paging':false,
  "bStateSave": true,
  "iCookieDuration": 365*60*60*24
});
  
  });
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-85178535-1', 'auto');
  ga('send', 'pageview');

</script>