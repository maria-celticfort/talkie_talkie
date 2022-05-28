@extends('theme.base')

@section('content')
    <h1>Main page</h1>
       
    @if (Session::has('id'))
        <div class="alert alert-info my-5">
            <h5>Hi! Sessions are working</h5>
        </div>
    @endif

    <a class="btn btn-primary" href="{{route('user.index')}}" role="button">Login</a>
    <a class="btn btn-primary" href="{{route('user.logout')}}" role="button">Logout</a>


    <form action="{{route('topic.store')}}" method="POST">
        @csrf
        <div class="#">
            <label for="name" class="form-label">¿De qué quieres hablar?</label>
            <input type="text" name="name" class="form-control" placeholder="One Piece">
            @error('name')
                <p class="form-text text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="#">
            <label for="laguage" class="form-label">Idioma</label>
            <input type="text" name="language" class="form-control" placeholder="ESP/ENG">
            @error('language')
                <p class="form-text text-danger">{{ $message }}</p> 
            @enderror
        </div>

        <button type="submit" class="btn btn-info">Aceptar</button>
    </form>


@endsection

