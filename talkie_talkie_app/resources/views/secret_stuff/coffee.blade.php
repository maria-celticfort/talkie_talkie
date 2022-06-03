@extends('theme.base')


@section('content') 
<div class="mt-custom container px-5">
    <div class="d-flex justify-content-center">
        <h1> Error 418 - I'm a teapot </h1>
    </div>

    <div class="d-flex justify-content-center">
        <h5>Esto... solo podemos ofrecerte té</h5>
    </div>

    <div class="d-flex justify-content-center">
        <small>Creo...</small>
    </div>

    <div class="mt-2-custom d-flex justify-content-center">
        <a class="btn btn-warning rounded-pill" href="{{route('index')}}" role="button">← Volver a Inicio</a>
    </div>
</div>
@endsection
