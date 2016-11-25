@extends('layouts.Layout')

@section('title','View Recommendation')

@section('content')
<style>
textarea { width:250px !important; height:100px !important; }
</style>

<div class="generalHeader">
    View Recommendation for {{$module->modulename}}
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
        <table width="100%" cellpadding="5" cellspacing="5" id="recommendationsList" border="1"  class="table table-striped table-bordered dt-responsive" >
            <thead>

                <tr><th>S/N</th><th>Student Name</th><th>Current Marks</th><th>Recommendation Details</th><th>Recommendation marks</th><th width="40%">Action</th></tr>
            </thead>
            <tbody>
                @foreach($recommendations as $key=>$recommendation)
                <tr>
                <td>{{   $recommendation->id }}</td>
                <td>{{  $recommendation->studentname }}</td>
                <td>{{  decrypt($recommendation->marks) }}</td>
                <td> {{ $recommendation->recommendation }}</td>
                <td>{{ $recommendation->moderation }}</td>
                <td>
                <a class="btn btn-info" href="{{  $recommendation->id }}/approveRec">Approve Recommendation</a>
                <a class="btn btn-primary" href="{{  $recommendation->id }}/rejectRec">Reject Recommendation</a>
                </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {!! $recommendations->render() !!}
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
  
  $('#recommendationsList').DataTable( {
  aaSorting : [[1, 'asc']],
    responsive: true,
  'paging':false,
  "bStateSave": true,
  "iCookieDuration": 365*60*60*24
});
  
  });
</script>