@extends('theme.base')

@section('content')

        <!-- TO DO -->
        <!--'pronouns' should display the options in the DB. I'll improve in the frontend sprint-->
        <!--Add required to notnull fields (just in case, validations are alredy done). I'll improve in the frontend sprint-->
        <div class="mt-2-custom container px-5">
            @if (isset($user))
                <h1>Edita tu perfil</h1>
            @else
                <h1>Regístrate</h1>
            @endif

            @if (isset($user))
                <form action="{{ route('user.update', $user) }}" method="post">
                @method('PUT')
            @else
                <form action="{{ route('user.store') }}" method="post">
            @endif

                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" placeholder="Tu nombre" value="{{old('name') ?? @$user->name}}" required>
                    @error('name')
                        <p class="form-text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="surname_1" class="form-label">Primer apellido</label>
                    <input type="text" name="surname_1" class="form-control" placeholder="Primer apelldio" value="{{old('surname_1') ?? @$user->surname_1 }}" required>
                    @error('surname_1')
                        <p class="form-text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="surname_2" class="form-label">Segundo apellido</label>
                    <input type="text" name="surname_2" class="form-control" placeholder="Segundo apelldio" value="{{old('surname_2') ?? @$user->surname_2}}"required>
                    @error('surname_2')
                        <p class="form-text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">    
                    <label for="email" class="form-label">Mail</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{old('email') ?? @$user->email}}"required>
                    @error('email')
                        <p class="form-text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nickname" class="form-label">Nickname</label>
                    <input type="text" name="nickname" class="form-control" placeholder="Nickname" value="{{old('nickname') ?? @$user->nickname}}"required>
                    @error('nickname')
                        <p class="form-text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" minlength="8"
                    @if (isset($user))
                            placeholder="¿Quieres mantener tu actual contraseña? Deja este campo en blanco ;)">
                    @else
                            required>
                    @endif
                    @error('password')
                        <p class="form-text text-danger">{{ $message }}</p>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Fecha de nacimiento</label>
                    <input type="date" name="date_of_birth" class="form-control" placeholder="Indica tu fecha de nacimiento" value="{{old('date_of_birth') ?? @$user->date_of_birth}}"required>
                    @error('date_of_birth')
                        <p class="form-text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pronouns" class="form-label">Pronombres</label>
                    <select type="text" name="pronouns" class="form-control" placeholder="Escoge tus pronombres" value="{{old('pronouns') ?? @$user->pronouns}}" required>
                        @if (isset($user->pronouns))
                            <option selected="true" disabled="disabled" value="{{$user->pronouns}}">{{$user->pronouns}}</option>
                        @else
                            <option value="">Selecciona tus pronombres</option>
                        @endif
                        <option value="Ella">Ella</option>
                        <option value="Elle">Elle</option>
                        <option value="Él">Él</option>
                        <option value="She/her">She/her</option>
                        <option value="They/them">They/them</option>
                        <option value="He/him">He/him</option>
                    </select>
                    @error('pronouns')
                        <p class="form-text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-lg btn-warning rounded-pill">Aceptar</button>
                </div>
            </form>

            @if (isset($user))
                <div class="return-btn-2">
                    <a class="btn btn-danger rounded-pill" href="{{route('user.show_profile')}}" role="button">Cancelar cambios</a>
                </div>
            @else 
                <div class="return-btn-2">
                    <a class="btn btn-warning rounded-pill" href="{{route('index')}}" role="button"> ← Volver a Inicio</a>
                </div>
            @endif
        </div>
    
@endsection