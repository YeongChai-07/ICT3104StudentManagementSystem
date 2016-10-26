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
                <div class="panel-heading">Admin Login</div>
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-85178535-1', 'auto');
  ga('send', 'pageview');

</script>