@extends('theme.base')

@section('content')
    <h1>Wait room</h1>

    @if (Session::has('wait_message'))
        <div class="alert alert-info my-5">
            {{Session:: get('wait_message')}}
        </div>
    @endif

    <a class="btn btn-primary" href="{{route("conversation.cancel")}}" role="button">Cancel match</a>
    <a class="btn btn-primary" href="{{route("user.logout")}}" role="button">Logout</a>

    
    <script type="text/javascript">
        var queue = "{{ route('conversation.queue') }}";
        var intervalId = window.setInterval(function(){
            location.href = queue;
        }, 5000);
    </script>

@endsection
