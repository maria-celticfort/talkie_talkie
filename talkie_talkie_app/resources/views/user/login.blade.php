@extends('theme.base')

@section('content')
    <div class="info">
        <a href="{{ route('user.create')}}" class="btn btn-primary">Registro</a>
    </div>

    @if (Session::has('log_needed_message'))
    <div class="alert alert-info my-5">
        {{Session:: get('log_needed_message')}}
    </div>
    @endif

    @if (Session::has('resolution'))
    <div class="alert alert-info my-5">
        {{Session:: get('resolution')}}
    </div>
    @endif

    <h1>Inicia sesión</h1>
    <form action="{{ route('user.auth') }}" method="POST">
        @csrf
        <div class="mb-3">    
            <label for="email" class="form-label">Mail</label>
            <input type="email" name="email" class="form-control" placeholder="Email">
            @error('email')
                <p class="form-text text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Contraseña">
            @error('password')
                <p class="form-text text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-info">Aceptar</button>
    </form>

    <a class="btn btn-primary" href="{{route('index')}}" role="button">Volver a Inicio</a>
    
@endsection
