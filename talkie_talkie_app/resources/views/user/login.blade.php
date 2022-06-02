@extends('theme.base')


@section('content')
    <div class="mt-custom container px-5">
        @if (Session::has('log_needed_message'))
        <div class="alert alert-warning my-5" role="alert">
            {{Session:: get('log_needed_message')}}
        </div>
        @endif

        @if (Session::has('resolution'))
        <div class="alert alert-warning my-5" role="alert">
            {{Session:: get('resolution')}}
        </div>
        @endif

        <h1>Inicia sesión</h1>
        <form action="{{ route('user.auth') }}" method="POST">
            @csrf
            <div class="mb-3">    
                <label for="email" class="form-label">Email</label>
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

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-lg btn-warning rounded-pill">Aceptar</button>
            </div>
        </form>

        <div class="info d-flex justify-content-center">
            <h2>¿No tienes cuenta?</h2>
        </div>        
        
        <div class="d-flex justify-content-center">
            <a href="{{ route('user.create')}}" class="btn btn-warning rounded-pill">¡Regístrate aquí!</a>
        </div>

        <div class="return-btn">
            <a href="{{route('index')}}" class="btn btn-warning rounded-pill"> ← Volver a Inicio</a>
        </div>
    </div>
@endsection
