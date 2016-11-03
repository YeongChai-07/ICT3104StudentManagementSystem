@extends('layouts.Layout')
@section('content')

<body>
  
    @if(Session::has('error_message'))
        <div class="alert alert-danger">{{ Session::get('error_message') }}</div>
        {{Session::forget('error_message')}}
    @endif
    <br/>
 <?php echo Form::open(array('url' => 'common/verifyuser', 'method' => 'post')) ?>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Enter login token</div>
                <div class="panel-body">
				
				<div class="form-group">
					{!! Form::label('title', 'Login Token:', ['class' => 'control-label']) !!}
					{{ Form::text('token','',array('id'=>'','class'=>'form-control span6','placeholder' => 'Enter code sent to email','required' => 'required')) }}
                        
				</div>

                    <br/>
                    <p>{{ Form::submit('Authenticate Me!', array('class'=>'btn btn-success')) }}</p>
					<div class="form-group">
    
						{!!Form::hidden('email', $email)!!}
						{!!Form::hidden('password', $password)!!}

					   
					</div>
                </div>
            </div>
        </div>
    </div>
</body>
 {{ Form::close() }}
@stop

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-85178535-1', 'auto');
  ga('send', 'pageview');

</script>