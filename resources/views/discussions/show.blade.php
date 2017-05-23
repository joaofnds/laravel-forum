@extends('layouts.app')

@section('content')
    <div class="panel panel-default">

        <div class="panel-heading">
            <img style="width: 20px; border-radius: 50%; float: left; margin: 0px 10px;" src="{{ $discussion->user->avatar }}" alt="{{ $discussion->user->name }}">
            <span>{{ $discussion->user->name }}</span>, <em>{{ $discussion->created_at->diffForHumans() }}</em>
            <a href="{{ route('discussions.show', ['slug' => $discussion->slug]) }}"
               class="btn btn-default btn-xs pull-right">View Discussion</a>
        </div>

        <div class="panel-body">
            <h4>{{ $discussion->title }}</h4>
            {{ $discussion->content }}
        </div>

        <div class="panel-footer">
            {{ count($discussion->replies) }} {{ count($discussion->replies) === 1 ? 'Reply' : 'Replies' }}
        </div>

    </div>
    
    @foreach($discussion->replies as $reply)
        <div class="panel panel-default">

            <div class="panel-heading">
                <img style="width: 20px; border-radius: 50%; float: left; margin: 0px 10px;" src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}">
                <span>{{ $reply->user->name }}</span>, <em>{{ $reply->created_at->diffForHumans() }}</em>
                <a href="{{ route('discussions.show', ['slug' => $discussion->slug]) }}"
                   class="btn btn-default btn-xs pull-right">View Discussion</a>
            </div>

            <div class="panel-body">{{ $reply->content }}</div>

        </div>
    @endforeach
    
@endsection
