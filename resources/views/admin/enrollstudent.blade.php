@extends('layouts.Layout')

@section('title','Student')

@section('content')
<style>
textarea { width:250px !important; height:100px !important; }
</style>

<div class="generalHeader">
    Student
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
        <table width="100%" cellpadding="5" cellspacing="5" id="studentslist" border="1"  class="table table-striped table-bordered dt-responsive" >
            <thead>

                <tr><th>S/N</th><th>Name</th><th>Email</th><th>Enroll</th>
                </tr>
            </thead>
            <tbody>
            <?php echo Form::open(array('url' => 'admin/'.$id.'/enrollstudent', 'method' => 'post')) ?>
                @foreach($students as $key=>$student)

                <tr>
                <td>{{   $student->studentid }}</td>
                <td>{{  $student->studentname }}</td>
                <td> {{ $student->studentemail }}</td>
                <td><input type="checkbox" name="chkid[]" value="{{ $student->studentid }}" /></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{URL::asset('admin/module')}}" class="btn btn-primary" style="float:right;">Back to Module list</a>
            {!!Form::submit('Enroll', array('class' => 'btn btn-success'))!!}
            {!! Form::close() !!}
    </div>
</div>   

</body>

@stop
