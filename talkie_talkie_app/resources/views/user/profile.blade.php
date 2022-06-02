@extends('theme.base')

@section('content')
    <div class="mt-2-custom container px-5">
        @if (Session::has('resolution'))
        <div class="alert alert-warning my-5" role="alert">
            {{Session:: get('resolution')}}
        </div>
        @endif

        <h1>Tu perfil</h1>
        
        <form action="#" method="#">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" readonly class="form-control" placeholder="Tu nombre" value="{{@$user->name}}">
                </div>

                <div class="mb-3">
                    <label for="surname_1" class="form-label">Primer apellido</label>
                    <input type="text" name="surname_1" readonly class="form-control" placeholder="Primer apelldio" value="{{@$user->surname_1 }}" >
                </div>

                <div class="mb-3">
                    <label for="surname_2" class="form-label">Segundo apellido</label>
                    <input type="text" name="surname_2" readonly class="form-control" placeholder="Segundo apelldio" value="{{@$user->surname_2}}">
                </div>

                <div class="mb-3">    
                    <label for="email" class="form-label">Mail</label>
                    <input type="email" name="email" readonly class="form-control" placeholder="Email" value="{{@$user->email}}">
                </div>

                <div class="mb-3">
                    <label for="nickname" class="form-label">Nickname</label>
                    <input type="text" name="nickname" readonly class="form-control" placeholder="Nickname" value="{{@$user->nickname}}">
                </div>

                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Fecha de nacimiento</label>
                    <input type="date" name="date_of_birth" readonly class="form-control" value="{{@$user->date_of_birth}}">
                </div>

                <div class="mb-3">
                    <label for="pronouns" class="form-label">Pronombres</label>
                    <input type="text" name="pronouns" readonly class="form-control" value="{{@$user->pronouns}}">
                </div>
        </form>

        <div class="d-flex justify-content-center">
            <a class="btn btn-lg btn-warning rounded-pill" href="{{route('user.edit', $user)}}" role="button">Editar perfil</a>
        </div>

        <div class="return-btn-2">
            <a class="btn btn-warning rounded-pill" href="{{route('index')}}" role="button"> ← Volver a Inicio</a>
        </div>

    </div>
@endsection
