@extends('theme.base')

@section('content')
    <h1>Perfil</h1>

    @if (Session::has('resolution'))
    <div class="alert alert-info my-5">
        {{Session:: get('resolution')}}
    </div>
    @endif

    <div class="user_data">
        Nombre: {{$user->name}} <br>
        Primer apellido: {{$user->surname_1}} <br>
        Segundo apellido: {{$user->surname_2}} <br>
        Nickname: {{$user->nickname}} <br>
        Email: {{$user->email}} <br>
        Pronombres: {{$user->pronouns}} <br>
        Fecha de nacimiento: {{$user->date_of_birth}} <br>
    </div>

    <a class="btn btn-primary" href="{{route('user.edit', $user)}}" role="button">Editar perfil</a>
    <a class="btn btn-primary" href="{{route('user.logout')}}" role="button">Logout</a>
    <a class="btn btn-primary" href="{{route('index')}}" role="button">Volver a Inicio</a>
@endsection
