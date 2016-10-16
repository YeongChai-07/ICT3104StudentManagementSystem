@extends('layouts.Layout')

@section('title', 'Backup application and Database')

@section('content')
	<form action="processsystembackup" method="GET">
		<input type="submit" value="Perform Backup" />
	</form>
@stop
