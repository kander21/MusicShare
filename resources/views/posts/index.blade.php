@extends('layouts.app')

@section('content')
    <h1>Music</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well" style="padding: 0px">
                <div class="row">
                    <div class="col-md-1 col-sm-1" style="padding-top:15px; padding-left:50px">
                        <img style="width:60px; height:60px" src="/storage/all_files/img.jpg">
                    </div>
                    <div class="col-md-11 col-sm-11" style="padding-left: 50px">
                        <h3><a href="/music/{{$post->id}}">{{$post->title}}</a></h3>
                        <p>Uploaded on {{$post->created_at}} by {{$post->user->name}}</p>
                    </div>
                </div>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No music found</p>
    @endif
@endsection