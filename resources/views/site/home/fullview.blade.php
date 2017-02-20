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
				<div class="col-md-8 col-md-offset-2 alignment ">
					<div class="thumbnail">
						<img src="{{asset('public/images/'.$post->image)}}" class="img-responsive" alt="{{$post->title}}" width="100%">
						<div class="caption">
							<p>{{$post->content}}</p>
						</div>
					</div>
					<h3><span class="glyphicon glyphicon-thumbs-up" id="like" url="{{route('like')}}" value="{{encrypt($post->id)}}">&nbsp;{{count($post->likes)}}</span>&nbsp;
						&nbsp; &nbsp; <span class="glyphicon glyphicon-comment" id="total-comments">&nbsp;<commmentCount>{{count($post->comments)}}</commmentCount> comments</span> &nbsp;
						&nbsp;&nbsp;<span class="glyphicon glyphicon-time"></span>&nbsp; {{$post->updated_at}}
					</h3>
				</div>
				<div class="comments-box">
				@if(isset($comments))
				@foreach($comments as $key=>$comment)
				<?php 
					$encrypted_id=encrypt($comment->id);
				?>
				<div class="col-md-8 col-md-offset-2 clear comment_row" comment-id="{{$comment->id}}">
					<div class="for-edit"></div>
					<div class="for-view">
						<div class="pull-left">
							<p><strong>{{$comment->user->name}}</strong> <comment-section>{{$comment->content}}</comment-section></p>
						</div>
						<div class="pull-right actionDiv">
                          @if(Auth::check() && $comment->user->id==Auth::user()->id)
                          <p class="action" action-comment-id="{{$comment->id}}" onmouseleave="actionMenuHide()" onmouseenter="actionMenuShow(this)" token="{{ csrf_token() }}" 
							url="{{url('comment/'.$encrypted_id)}}"
							>....</p>
                          @endif
						</div>
					</div>
				</div>
				@endforeach
				
				</div>
				@endif
				@if(Auth::check())
				<form method="post" id="comment" action="{{url('comment')}}" onsubmit="return false;">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="post_id" value="{{$post->id}}">
					<div class="col-md-8 col-md-offset-2 form-group" id="comment-input-div">      
						<input type="text" class="form-control input-lg" id="comment-input" name="comment" placeholder="Write a comment here.. " value="{{ old('comment') }}">
					</div>
				</form>
				@else
				<div class="col-md-8 col-md-offset-2 form-group">      
					<input type="text" class="form-control input-lg" id="name" name="comment" placeholder="Write a comment here.. " disabled="true">
				</div>
				@endif
			</form>
		</div>
	</div>
	@stop


	

