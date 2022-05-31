@extends('theme.base')

@section('content') 

    <h1>Talkie Talkie - Main page</h1>
       
    <a class="btn btn-primary" href="{{route('user.index')}}" role="button">Login/Sign in</a>

    @if (Session::has('id'))
        <a class="btn btn-primary" href="{{route('user.show_profile')}}" role="button">Ver Perfil</a>
        <a class="btn btn-primary" href="{{route('user.logout')}}" role="button">Logout</a>
    @endif

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
            <input type="text" name="language" class="form-control" placeholder="eng/spa/cat/glg/eus/jpn/chi/deu/ita/fra/por/gre/gle/ukr">
            @error('language')
                <p class="form-text text-danger">{{ $message }}</p> 
            @enderror
        </div>

        <button type="submit" class="btn btn-info">Aceptar</button>
    </form>

@endsection

