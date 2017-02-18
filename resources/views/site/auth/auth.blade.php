@extends('layouts.master')
@section('title', 'Central Authentication Service')

@section('content')
 <div class="container">
 	<div class="row ">
 		<div class="col-md-5 auth">
 			<form method="post" action="{{route('login')}}" class="form-horizontal">
 			<input type="hidden" name="_token" value="{{ csrf_token() }}">
 			   <div class="panel panel-default auth">
 			       <div class="panel-heading">Login</div>
                    <div class="panel-body">
	                    @if(Session::has('login_failed'))
	                      <div class="alert alert-danger alert-dismissable">
	                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                         <p class="text-center"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;{{Session::get('login_failed')}}</p>
	                       </div>
	                    @endif
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                           <label class="control-label col-sm-3" for="email">Email:</label>
					       <div class="col-sm-8">
					        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{old('email')}}">
					        <span class="help-block">{{ $errors->first('email', ':message') }}</span>
					       </div>
                        </div>
					    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
					      <label class="control-label col-sm-3" for="pwd">Password:</label>
					      <div class="col-sm-8">          
					        <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password">
					        <span class="help-block">{{ $errors->first('password', ':message') }}</span>
					      </div>
					    </div>
                     </div>
                    <div class="panel-footer">
                       <div class="form-group">        
					      <div class="col-sm-offset-1 col-sm-10">
					        <button type="submit" class="btn btn-custom btn-block">Submit</button>
					      </div>
                       </div>
                    </div>
                </div>	
 			</form>
 		</div>
 		<div class="col-md-4 col-md-offset-1 register">
 		   <h3>Register for a new Account</h3>
 		   <hr/>
 		   <p>To create a User Account</p>
 		   <a href="{{route('regis')}}" class="btn btn-default btn-lg">Register</a>
 		</div>
 	</div>
 </div>
@stop