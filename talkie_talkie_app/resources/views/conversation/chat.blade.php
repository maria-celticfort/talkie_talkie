@extends('theme.base')

@section('content')
    <!-- User 1 goes by here and gets User 2 data -->
    @if (Session::get('id') == isset($user_2_data->id))
        Chat con {{$user_2_data->name}}({{$user_2_data->pronouns}})
    @endif

    <!-- User 2 goes by here and gets User 1 data -->
    @if (Session::get('id') == isset($user_1_data->id))
        Chat con {{$user_1_data->name}}({{$user_1_data->pronouns}})
    @endif

    <div class="container">
        <h1>Chat Room</h1>
        <div class="row" id="app">
            <div class="offsset-4 col-4 offset-sm-1 col-sm-10">
                <li class="list-group-item active">Chat room 
                    <span class= "badge badge rounded-pill bg-warning">@{{number_of_users}} </span>
                </li>
                <div class= "badge badge rounded-pill bg-success">@{{typing}}</div>
                    <ul class="list-group" v-chat-scroll>
                        <message
                            v-for="value, index in chat.message"
                            :key=value.index
                            :color= chat.color[index]
                            :user = chat.user[index]
                            :time = chat.time[index]
                        >
                        @{{value}}
                        </message>
                    </ul>
                
                    <input type="text" class="form-control" placeholder="mensajito" 
                        v-model='message' @keyup.enter='send_message'>
                </div>
        </div>
    </div>

    @if(isset($payload))
        <script type="text/javascript">
            window.__payload = JSON.parse("{!!$payload!!}");
        </script>
    @endif
 
    <script src="./js/app.js"></script>
    <a class="btn btn-primary" href="{{route('conversation.cancel')}}" role="button">Abandonar chat</a>
@endsection