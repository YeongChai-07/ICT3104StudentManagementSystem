@extends('layouts.Layout')

@section('title','Moderate Grades')

@section('content')
<style>
textarea { width:250px !important; height:100px !important; }
</style>

<div class="generalHeader">
   Moderate Grades for {{$module->modulename}}
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
        <?php echo Form::open(array('url' => 'grade/'.$module->id.'/moderation', 'method' => 'post')) ?>
        <div class="form-group">
            {!!Form::label('moderate','Moderate in %.')!!}
              <select class="form-control" name="moderate">
                  <option value="-20">-20%</option>
                  <option value="-15">-15%</option>
                  <option value="-10">-10%</option>
                  <option value="-5">-5%</option>              
                  <option value="5" selected>5%</option>
                  <option value="10">10%</option>
                  <option value="15">15%</option>
                  <option value="20">20%</option>
                  <option value="25">25%</option>
                  <option value="30">30%</option>
                  <option value="35">35%</option>
                  <option value="40">40%</option>
                  <option value="45">45%</option>
                  <option value="50">50%</option>
              </select>
        </div>
        {!!Form::submit('Moderate Grades', array('class' => 'btn btn-success'))!!}
        {!! Form::close() !!}
        <table width="100%" cellpadding="5" cellspacing="5" id="gradesList" border="1"  class="table table-striped table-bordered dt-responsive" >
            <thead>

                <tr><th>S/N</th><th>Student Name</th><th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $key=>$grade)
                <tr>
                <td>{{   $grade->id }}</td>
                <td>{{  $grade->studentname }}</td>
                <td> 
                @if(isset($grade->marks))
                {{ decrypt($grade->marks) }}
                @else
                Grade Not Set
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