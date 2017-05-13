@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Channels</div>

        <div class="panel-body">
            <table class="table table-hover">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($channels as $channel)
                        <tr>
                            <td>{{ $channel->title }}</td>
                            <td>
                                <a href="{{ route('channels.edit', ['channel' => $channel]) }}"
                                   role="button"
                                   class="btn btn-xs btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('channels.destroy', ['channel' => $channel]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-xs btn-danger">Destroy</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
