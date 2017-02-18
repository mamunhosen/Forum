@extends('layouts.master')
@section('title', 'Full View')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
				&nbsp;{{$post->category->name}}</h3>
			</div>
			<div class="col-md-8 col-md-offset-2">
				<hr>
				<h5>{{$post->title}}</h5>
				<h6><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
					&nbsp;{{$post->user->name}}</h6>
				</div>
				<div class="col-md-8 col-md-offset-2">
					<div class="thumbnail">
						<img src="{{asset('public/images/'.$post->image)}}" class="img-responsive" alt="{{$post->title}}" width="100%">
						<div class="caption">
							<p>{{$post->content}}</p>
						</div>
					</div>
					<h3><span class="glyphicon glyphicon-thumbs-up" id="like" value="{{$post->id}}">&nbsp;{{count($post->likes)}}</span>&nbsp;
						&nbsp; &nbsp; <span class="glyphicon glyphicon-comment" id="total-comments">&nbsp;{{count($post->comments)}} comments</span> &nbsp;
						&nbsp;&nbsp;<span class="glyphicon glyphicon-time"></span>&nbsp; {{$post->updated_at}}
					</h3>
				</div>
				@if(isset($comments))
				@foreach($comments as $key=>$comment)
				<div class="col-md-8 col-md-offset-2">
					<p><strong>{{$comment->user->name}}</strong> {{$comment->content}}</p>
				</div>
				@endforeach
				<div class="col-md-8 col-md-offset-2 comment-box">
				</div>
				@endif
				@if(Auth::check())
				<form method="post" id="comment" action="{{url('comment')}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="post_id" value="{{$post->id}}">
					<div class="col-md-8 col-md-offset-2 form-group" id="comment-input-div">      
						<input type="text" class="form-control input-lg" id="comment-input" name="comment" placeholder="Write comment here.. " value="{{ old('comment') }}">
					</div>
				</form>
				@else
				<div class="col-md-8 col-md-offset-2 form-group">      
					<input type="text" class="form-control input-lg" id="name" name="comment" placeholder="Write comment here.. " disabled="true">
				</div>
				@endif
			</form>
		</div>
	</div>
	@stop

	

