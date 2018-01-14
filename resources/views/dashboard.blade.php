@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="/music/create" class="btn btn-primary">Upload Music</a>
                    <h3>Your Music</h3>
                    @if(count($posts) > 0)
                        <p>Title</p>
                        @foreach($posts as $post)
                            <div class="well" style="padding: 6px; margin-bottom: 7px">
                                <div class="row">
                                    <div class="col-md-8 col-sm-8 title" style="margin-top: 6px">
                                        <a href="/music/{{$post->id}}">{{$post->title}}</a>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <a href="/music/{{$post->id}}/edit" class="btn btn-default">Edit</a>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>You have no music</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


