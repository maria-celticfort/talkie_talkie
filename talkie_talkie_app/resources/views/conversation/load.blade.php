@extends('theme.base')

@section('content')
    <h1>Wait room</h1>

    @if (Session::has('wait_message'))
        <div class="alert alert-info my-5">
            {{Session:: get('wait_message')}}
        </div>
    @endif

    <a class="btn btn-primary" href="{{route("user.logout")}}" role="button">Logout</a>
    <a class="btn btn-primary" href="{{route("match.cancel")}}" role="button">Cancel match</a>
@endsection
