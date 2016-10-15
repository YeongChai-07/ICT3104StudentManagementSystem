@extends('layouts.Layout')

@section('title','View My Details')

@section('content')
<style>
textarea { width:250px !important; height:100px !important; }
</style>

<div class="generalHeader">
  View My Details
</div>
<body>
   
    
    <br/>
 <div class="row">
    <div class="col-md-12 col-sm-12">
        <br><br>
        <table width="100%" cellpadding="5" cellspacing="5" id="hi" border="1"  class="table table-striped table-bordered dt-responsive" >
            <thead>

                <tr><th>ID</th><th>Name</th><th>Email</th><th>Contact</th><th>Address</th></tr>
            </thead>
          <tbody>
               
                <tr>
                <td>{{   $hod->hodid }}</td>
                <td>{{   $hod->hodname }}</td>
                <td>{{   $hod->hodemail }}</td>
                <td>{{   $hod->contact }}</td>
                <td>{{   $hod->address }}</td>
                
                
                </tr>  
               
            </tbody>
      
        </table>
      
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