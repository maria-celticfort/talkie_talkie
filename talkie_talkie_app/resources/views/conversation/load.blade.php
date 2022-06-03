@extends('theme.base')

@section('content')
    <div class="mt-2-custom container px-5">
        <h1>Sala de espera</h1>
        <h3>Estamos buscando a alguien con quien puedas hablar...</h3>

        <div class="mt-2-custom">
            <div class="d-flex justify-content-center">
                <img src="{{URL::asset('/image/loading.gif')}}" alt="Imágen de carga" height=20% width=20%>
            </div>
        </div>

        <div class="mt-2-custom">
            <div class="d-flex justify-content-center">
                <a class="btn btn-lg btn-danger rounded-pill" href="{{route('conversation.cancel')}}" role="button">Cancelar búsqueda</a>
            </div>
        </div>

        <script type="text/javascript">
            var queue = "{{ route('conversation.queue') }}";
            var intervalId = window.setInterval(function(){
                location.href = queue;
            }, 5000);
        </script>
    </div>

@endsection
