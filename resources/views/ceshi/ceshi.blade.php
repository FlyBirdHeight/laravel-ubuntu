@extends('app')
@section('content')
    @foreach($discussionss as $a)
        {{$a->created_at->diffForHumans()}}<br>
    @endforeach

@stop