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

                @if($reply->user->id === Auth::id())
                    <a href="{{ route('discussions.reply.delete', ['id' => $reply->id]) }}"
                       class="btn btn-xs btn-danger pull-right">Delete</a>
                @endif
            </div>

            <div class="panel-body">{{ $reply->content }}</div>

            <div class="panel-footer">
                @if(!$reply->likedBy(Auth::id()))
                    <a href="{{ route('discussions.reply.like', ['id' => $discussion->id,'replyId' => $reply->id]) }}" class="btn-sm btn-info">Like</a>
                @else
                    <a href="{{ route('discussions.reply.unlike', ['id' => $discussion->id,'replyId' => $reply->id]) }}" class="btn-sm btn-danger">Unlike</a>
                @endif
                {{ count($reply->likes) }} Likes
            </div>

        </div>
    @endforeach

    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('discussions.reply.store', ['id' => $discussion->id]) }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="reply">Reply</label>
                    <textarea name="content" id="reply" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-default">Reply</button>
                </div>

            </form>
        </div>
    </div>
    
@endsection
