@extends('layouts.Layout')
@section('content')

<body>
    {{ Form::open() }}
    @if(Session::has('error_message'))
        <div class="alert alert-danger">{{ Session::get('error_message') }}</div>
        {{Session::forget('error_message')}}
    @endif
    <br/>
    
    <div class="row">
        <div class="col-md-6 col-sm-12 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Student Login</div>
                <div class="panel-body">
                    <div class="controls">
                        <p><strong>Email</strong></p>
                        {{ Form::text('email','',array('id'=>'','class'=>'form-control span6','placeholder' => 'Please Enter your Email','required' => 'required')) }}
                        <p class="errors">{{$errors->first('email')}}</p>
                    </div>
                    <div class="controls">
                        <p><strong>Password</strong></p>
                        {{ Form::password('password',array('class'=>'form-control span6', 'placeholder' => 'Please Enter your Password','required' => 'required')) }}
                        <p class="errors">{{$errors->first('password')}}</p>
                    </div>
                    <br/>
                    <p>{{ Form::submit('Login', array('class'=>'btn btn-success')) }}</p>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</body>

@stop