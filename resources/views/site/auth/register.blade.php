@extends('layouts.master')
@section('title', 'Registartion')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form class="form-horizontal" method="post" action="{{route('regis_post')}}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="panel panel-default auth">
					<div class="panel-heading">Register</div>
					<div class="panel-body">
						<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
							<label class="control-label col-sm-3" for="name">Name:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ old('name') }}">
								<span class="help-block">{{ $errors->first('name', ':message') }}</span>
							</div>
						</div>
						<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							<label class="control-label col-sm-3" for="email">Email:</label>
							<div class="col-sm-8">
								<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
								<span class="help-block">{{ $errors->first('email', ':message') }}</span>
							</div>
						</div>
						<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
							<label class="control-label col-sm-3" for="password">Password:</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
								<span class="help-block">{{ $errors->first('password', ':message') }}</span>
							</div>
						</div>
						<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
							<label class="control-label col-sm-3" for="password_confirmation">Confirm Password:</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Confirm Password">
								<span class="help-block">{{ $errors->first('password_confirmation', ':message') }}</span>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="form-group">        
							<div class="col-sm-offset-1 col-sm-10">
								<button type="submit" class="btn btn-custom btn-block">Registration</button>
							</div>
						</div>
					</div>
				</div>	
			</form>
		</div>
	</div>
</div>
@stop
