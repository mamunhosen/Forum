@extends('layouts.master')
@section('title', 'Home')

@section('content')
<div class="container">
    @if(isset($rows))
    @foreach($rows as $key => $row)
	<div class="row" style="margin-top:30px">
		<div class="col-md-4 col-md-offset-1">
			<img src="{{asset('public/images/'.$row['image'])}}" class="img-responsive" title="{{$row['title']}}" width="100%" >
		</div>
		<div class="col-md-7">
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
		
	</div>
	<div class="col-md-8 col-md-offset-2">
		<hr>
	</div>
	@endforeach
	@else
	<h3>There are no matching results</h3>
	@endif	

	<div class="col-md-4 col-md-offset-5">
		{{ $rows->links() }}
	</div>
</div>
@stop



