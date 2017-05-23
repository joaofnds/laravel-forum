@extends('layouts.app')

@section('content')
    @foreach($discussions as $discussion)
        <div class="panel panel-default">

            <div class="panel-heading">
                <img style="width: 20px; border-radius: 50%; float: left; margin: 0px 10px;" src="{{ $discussion->user->avatar }}" alt="{{ $discussion->user->name }}">
                <span>{{ $discussion->user->name }}</span>, <em>{{ $discussion->created_at->diffForHumans() }}</em>
                <a href="{{ route('discussions.show', ['slug' => $discussion->slug]) }}"
                   class="btn btn-default btn-xs pull-right">View Discussion</a>
            </div>

            <div class="panel-body">
                <h4>{{ $discussion->title }}</h4>
                {{ str_limit($discussion->content, 300) }}
            </div>

            <div class="panel-footer">
                {{ count($discussion->replies) }} {{ count($discussion->replies) === 1 ? 'Reply' : 'Replies' }}
            </div>

        </div>
    @endforeach
    <div class="text-center">
        {{ $discussions->links() }}
    </div>
@endsection
