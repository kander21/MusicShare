@extends('layouts.app')

@section('content')
    <h1>Music</h1>
    <div class="row">
        {!! Form::open(['action' => 'SearchController@search', 'method' => 'POST']) !!}
        <div class="form-group col-md-11 col-sm-11">
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Search'])}}
        </div>
        <div class="form-group col-md-1 col-sm-1">
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        </div>
        {!! Form::close() !!}
    </div>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well" style="padding: 0px">
                <div class="row">
                    <div class="col-md-1 col-sm-1" style="padding-top:15px; padding-left:50px">
                        <img style="width:60px; height:60px" src="/storage/all_files/img.jpg">
                    </div>
                    <div class="col-md-7 col-sm-7" style="padding-left: 50px">
                        <h3><a href="/music/{{$post->id}}">{{$post->title}}</a></h3>
                        <p>Uploaded on {{$post->created_at}} by {{$post->user->name}}</p>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <audio controls>
                            <source src="public/all_files/{{$post->cover_image}}" ype="audio/mp3">
                            <source src="public/all_files/{{$post->cover_image}}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </div>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No music found</p>
    @endif
@endsection