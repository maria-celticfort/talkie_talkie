@extends('theme.base')

@section('content')
    <div class="info">
        <h1>Registro</h1>

        <!-- TO DO -->
        <!--'pronouns' should display the options in the DB. I'll improve in the frontend sprint-->
        <!--Add required to notnull fields (just in case, validations are alredy done). I'll improve in the frontend sprint-->
        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" placeholder="Tu nombre">
                @error('name')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="surname_1" class="form-label">Primer apellido</label>
                <input type="text" name="surname_1" class="form-control" placeholder="Primer apelldio">
                @error('surname_1')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="surname_2" class="form-label">Primer apellido</label>
                <input type="text" name="surname_2" class="form-control" placeholder="Segundo apelldio">
                @error('surname_2')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">    
                <label for="email" class="form-label">Mail</label>
                <input type="email" name="email" class="form-control" placeholder="Email">
                @error('email')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nickname" class="form-label">Nickname</label>
                <input type="text" name="nickname" class="form-control" placeholder="Nickname">
                @error('nickname')
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

            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Nickname</label>
                <input type="date" name="date_of_birth" class="form-control" placeholder="date_of_birth">
                @error('date_of_birth')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="pronouns" class="form-label">Pronombres</label>
                <input type="text" name="pronouns" class="form-control" placeholder="'Él','Ella','Elle','He/him','She/her','They/them'">
                @error('pronouns')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div>

                <button type="submit" class="btn btn-info">Aceptar</button>
        </form>
    </div>
    
@endsection