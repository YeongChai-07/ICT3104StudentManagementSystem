@extends('layouts.Layout')

@section('title','View Module')

@section('content')
<style>
textarea { width:250px !important; height:100px !important; }
</style>

<div class="generalHeader">
    View Module
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
        <a class="btn btn-info" href="addmodule">Add new Module</a>
        <table width="100%" cellpadding="5" cellspacing="5" id="modulesList" border="1"  class="table table-striped table-bordered dt-responsive" >
            <thead>

                <tr><th>S/N</th><th>Module Name</th><th>Module Description</th><th>Lecturer Incharge</th><th>Hod Incharge</th><th>Edit Date</th><th>Freeze Date</th><th width="40%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modules as $key=>$module)
                <tr>
                <td>{{   $module->id }}</td>
                <td>{{  $module->modulename }}</td>
                <td> {{ $module->description }}</td>
                <td> {{ $module->lecturername }}</td>
                <td> {{ $module->hodname }}</td>
                <td> {{ $module->editdate }}</td>
                <td> {{ $module->freezedate }}</td>
                <td>

                <a class="btn btn-info" href="{{  $module->id }}/editmodule">Edit module</a>
                <a class="btn btn-info" href="{{  $module->id }}/enrollstudent">Enroll Student</a>
                <a class="btn btn-danger" onclick="checkDelete()" href="{{  $module->id }}/deletemodule">Delete module</a>
                </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {!! $modules->render() !!}
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
  
  $('#modulesList').DataTable( {
  aaSorting : [[1, 'asc']],
    responsive: true,
  'paging':false,
  "bStateSave": true,
  "iCookieDuration": 365*60*60*24
});
  
  });
</script>