@extends('layouts.app')

@section('content')
    @foreach($discussions as $discussion)
        <div class="panel panel-default">
            <div class="panel-heading">
                <img style="width: 30px; border-radius: 50%; float: left; margin: 0px 10px;" src="{{ $discussion->user['avatar'] }}" alt="{{ $discussion->user['name'] }}">
                <h4>{{ $discussion->user['name'] }}</h4>
            </div>
            <div class="panel-body">
                {{ $discussion->content }}
            </div>
        </div>
    @endforeach
    <div class="text-center">
        {{ $discussions->links() }}
    </div>
@endsection
