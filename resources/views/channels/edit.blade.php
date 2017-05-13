@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Create channel</div>

        <div class="panel-body">
            <form action="{{ route('channels.update', ['channel' => $channel]) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <div class="form-group">
                        <input type="text"
                               name="title"
                               value="{{ $channel->title }}"
                               class="form-control"
                               placeholder="Channel name">
                    </div>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            Update channel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
