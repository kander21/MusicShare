@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    @if(count($partners) > 0)
        <ul class="list-group">
            @foreach($partners as $value)
                <li class="list-group-item"><a href="{{$value->link}}">{{$value->partner}}</a></li>
            @endforeach
        </ul>
    @endif
@endsection
