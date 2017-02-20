@extends('layouts.master')
@section('title', 'Home')

@section('content')
<div class="container">
	<div class="row" style="margin-top:30px">
		<div class="col-md-8">
			@if(isset($rows))
			@foreach($rows as $key => $row)
			<div class="col-md-4" style="margin-top:14px">
				<img src="{{asset('public/images/'.$row['image'])}}" class="img-responsive" alt="{{$row['title']}}" width="100%" >
			</div>
			<div class="col-md-8 ">
				<h4><a href="{{url('fullview/'.encrypt($row->id))}}">{{$row->title}}</a></h4>
				<p><strong><span class="glyphicon glyphicon-user"></span>&nbsp;{{$row->user->name}}
					&nbsp; <span class="glyphicon glyphicon-time"></span> {{$row->updated_at}}
					&nbsp; <span class="glyphicon glyphicon-comment"></span> {{count($row->comments)}} comments
					&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span> {{count($row->likes)}}
				</strong></p>
				<p>
					{{substr($row->content,0,100)}}
				</p>
				<a href="{{url('fullview/'.encrypt($row->id))}}" class="btn btn-custom">Read More</a>
			</div>
			<hr>
			@endforeach
			@endif
			<div class="col-md-5 col-md-offset-7">
				{{ $rows->links() }}
			</div>
		</div>
		<div class="col-md-4">
			<h4><strong>Popular Post</strong></h4>
			<strong><hr/></strong>
			<div class="col-md-4 col-xs-6" style="margin-top:14px">
				<img src="http://www.meuanphun-land.com/images/meuanphun/home-slide-01.jpg" class="img-responsive">
			</div>
			<div class="col-md-8 col-xs-6">
				<h5>Beautiful Eye Structure with rainbow colors in cool new reform </h5>
			</div>
		</div>	
	</div>
</div>
@stop



