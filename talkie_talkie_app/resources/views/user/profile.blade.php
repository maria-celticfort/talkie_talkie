@extends('theme.base')

@section('content')
    <h1>Aqui deberia ir el perfil</h1>
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
@endsection
