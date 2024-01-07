
@extends('layouts.main')

@section('content')
    <h1>Users</h1>
    <div class="page-content">
        @if($users)
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Events</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ ($loop->index + 1) }}</th>
                        <td><a href="{{ route('user.update', ['id' => $user->id]) }}" class="link-primary">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->events as $event)
                                <a href="{{ route('event.update', ['id' => $event->id]) }}" class="link-primary">{{ $event->title }}</a>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('user.update', ['id' => $user->id]) }}" class="link-primary">Update</a>
                            <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="link-primary">Delete</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            @endif
    </div>
@endsection
