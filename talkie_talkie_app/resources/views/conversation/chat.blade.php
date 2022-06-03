@extends('theme.base')

@section('content')
    <div class="container mt-2-custom">
        <div class="return-btn-3 d-flex justify-content-center">
            @section('content')
            <!-- User 1 goes by here and gets User 2 data -->
            @if (Session::get('id') == isset($user_2_data->id))
                <h1>Estás hablando con {{$user_2_data->name}} ({{$user_2_data->pronouns}})</h1>
            @endif

            <!-- User 2 goes by here and gets User 1 data -->
            @if (Session::get('id') == isset($user_1_data->id))
                <h1>Estás hablando con{{$user_1_data->name}} ({{$user_1_data->pronouns}})</h1>
            @endif
        </div>

        <div class="row" id="app">

            <div class="offset-sm-1 col-sm-10">
            <div class="return-btn-3  d-flex justify-content-center">
                   <p>Usuarios en sala <span class="badge badge rounded-pill bg-warning">@{{number_of_users}} </span></p>
            </div>

                <div class="container-chat">
                    <div class="badge badge rounded-pill bg-success">@{{typing}}</div>
                    <ul class="list-group" v-chat-scroll>
                        <message v-for="value, index in chat.message" 
                        :key=value.index 
                        :color=chat.color[index] 
                        :user=chat.user[index] 
                        :time=chat.time[index]
                        >@{{value}}
                        </message>
                    </ul>

                    <input type="text" class="form-control" placeholder="Escribe un mensaje" v-model='message' @keyup.enter='send_message'>
                </div>
            </div>
        </div>
    </div>

    @if(isset($payload))
    <script type="text/javascript">
        window.__payload = JSON.parse("{!!$payload!!}");
    </script>
    @endif

    <script src="./js/app.js"></script>

    <div class="return-btn-3 d-flex justify-content-center">
        <a class="btn btn-lg  btn-danger rounded-pill" href="{{route('conversation.cancel')}}" role="button">Abandonar chat</a>
    </div>
@endsection