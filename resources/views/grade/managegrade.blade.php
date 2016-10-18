@extends('layouts.Layout')

@section('title','Manage Grade')

@section('content')
<style>
textarea { width:250px !important; height:100px !important; }
</style>

<div class="generalHeader">
    Manage Grade for {{$module->modulename}}
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
        <br><br>
        <table width="100%" cellpadding="5" cellspacing="5" id="gradesList" border="1"  class="table table-striped table-bordered dt-responsive" >
            <thead>

                <tr><th>S/N</th><th>Student Name</th><th>Grade</th><th width="40%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $key=>$grade)
                <tr>
                <td>{{   $grade->id }}</td>
                <td>{{  $grade->studentname }}</td>
                <td> 
                @if(isset($grade->grade))
                {{ $grade->grade }}
                @else
                Grade Not Set
                @endif
                </td>
                <td>
                @if(isset($grade->grade))
                 <a class="btn btn-info" href="{{  $grade->id }}/editgrade">Edit Grade</a>
                 @else
                 <a class="btn btn-Primary" href="{{  $grade->id }}/addgrade">Add Grade</a>
                 @endif
                </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {!! $grades->render() !!}
                <a href="{{URL::asset('grade/index')}}" class="btn btn-danger" style="float:right;">Back to Module list</a>
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