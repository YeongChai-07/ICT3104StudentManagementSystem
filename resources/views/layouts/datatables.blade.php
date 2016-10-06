<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/dataTables.bootstrap.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/responsive.bootstrap.min.css') }}"/>
	
<script src="{{ URL::asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/datatables/responsive.bootstrap.min.js') }}"></script>
  
 <style>
 table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after {
    color: #337ab7;
	opacity: 1;
}

	 table.dataTable tbody .td-limit{
    max-width: 300px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
</style> 