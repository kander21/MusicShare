@extends('layouts.app')

@section('content')
    <a href="/music" class="btn btn-default">Go Back</a> 
    <h2>{{$post->title}}</h2>
    <img class="img-thumbnail" style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
    <hr>
    <div>
        {!!$post->body!!} <!-- !! parsing html tags -->
    </div>
    <br>
    <small>Uploaded on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/music/{{$post->id}}/edit" class="btn btn-default">Edit</a>

            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
        <br>
        <br>
        <h5>Comments</h5>
        @if(count($post->comments) > 0)
            @foreach($post->comments as $value)
                <div class="well" style="padding: 0px">
                    <div class="row">
                        <div class="col-md-2 col-sm-2" style="padding-left: 50px">
                            <p>{{$value->user->name}}</p>
                        </div>
                        <div class="col-md-10 col-sm-10">
                           <p>{!!$value->info!!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No comments found</p>
        @endif





{{--<pre>{{$post->comments[0]->user->name}}</pre>--}}                

























        
        <br>
        <br>
        <h5>Add Comment</h5>
        {!! Form::open(['action' => 'CommentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
            </div>        
            {!! Form::hidden('music_id', $post->id, ['class' => 'form-control']) !!}
            
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    @endif
@endsection