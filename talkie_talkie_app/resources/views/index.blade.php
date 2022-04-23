@extends('theme.base')

@section('content')
    <h1>Main page</h1>
       
    @if (Session::has('id'))
        <div class="alert alert-info my-5">
            <h5>Hi! Sessions are working</h5>
        </div>
    @endif

    <a class="btn btn-primary" href="{{route("user.index")}}" role="button">Login</a>
    <a class="btn btn-primary" href="{{route("user.logout")}}" role="button">Logout</a>

@endsection

