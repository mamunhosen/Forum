@extends('layouts.master')
@section('title', 'Edit Blog')

@section('content')
<div class="container">
	<div class="row">
		<form class="form-horizontal" method="post" action="{{route('post.update')}}" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="post_id" value="{{$row->id}}">
			<div class="col-md-7 col-md-offset-3">
				<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
					<label class="control-label col-sm-2" for="title">Title:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="title" name="title"  value="{{ old('title',  $row->title ? $row->title : null) }}">
						<span class="help-block">{{ $errors->first('title', ':message') }}</span>
					</div>
				</div>
			</div>
			<div class="col-md-7 col-md-offset-3">
				<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
					<label class="control-label col-sm-2" for="category">Category:</label>
					<div class="col-sm-8">
						<select class="form-control" id="category" name="category_id">
							<option value="-1">Select Category</option>
							@if(isset($category))
							@foreach($category as $key=>$catg)
							<option value="{{$catg->id}}" {{old('category_id',$catg->id==$row->category_id?"selected":"" )}}>{{$catg->name}}</option>
							@endforeach
							@endif
						</select>
						<span class="help-block">{{ $errors->first('category_id', ':message') }}</span>
					</div>
				</div>
			</div>
			<div class="col-md-7 col-md-offset-3" style="margin-top:10px">
				<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
					<label class="control-label col-sm-2" for="content">Description:</label>
					<div class="col-sm-8">
						<textarea class="form-control" id="content" rows="5" name="content" placeholder="Write here..">{{old('content',$row->content?$row->content:'')}}</textarea>
						<span class="help-block">{{ $errors->first('content', ':message') }}</span>
					</div>
				</div>
			</div>
			<div class="col-md-7 col-md-offset-3">
				<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
					<label class="control-label col-sm-2" for="image">Image:</label>
					<div class="col-sm-4">
						<input type="file" name="image" id="image">
						<span class="help-block">{{ $errors->first('image', ':message') }}</span>
					</div>
                    <div class="col-sm-6">
                    	<img src="{{asset('public/images/'.$row->image)}}" class="img-responsive" title="{{$row->title}}" width="100%">
                    </div>
				</div>
			</div>
			<div class="col-md-3 col-md-offset-5" style="margin-top:10px">
				<button type="submit" class="btn btn-custom btn-block">Update</button>
			</div>
		</form>
	</div>
</div>
@stop



