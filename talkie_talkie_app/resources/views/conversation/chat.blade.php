@extends('theme.base')

@section('content')
    <h1>Chat will go here</h1>

    <a class="btn btn-primary" href="{{route("conversation.cancel")}}" role="button">Cancel match</a>
@endsection