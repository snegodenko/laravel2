@extends('layouts.main')

@section('content')
    <h1>Events</h1>
    <div class="page-content">
        @if($events->isNotEmpty())
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Start</th>
                    <th scope="col">End</th>
                    <th scope="col">User</th>
                </tr>
                </thead>
                <tbody>

                @foreach($events as $event)
                    <tr>
                        <th scope="row">{{ ($loop->index + 1) }}</th>
                        <td><a href="{{ route('event.update', ['id' => $event->id]) }}" class="link-primary">{{ $event->title }}</a></td>
                        <td>{{ $event->description }}</td>
                        <td>{{ date('d-m-Y', strtotime($event->dt_start)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($event->dt_end)) }}</td>
                        <td>{{ $event->user->name }}</td>
                        <td>
                            <a href="{{ route('event.update', ['id' => $event->id]) }}" class="link-primary">Update</a>
                            <a href="{{ route('event.delete', ['id' => $event->id]) }}" class="link-primary">Delete</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        @else
            <div class="empty-string">На даний час немає подій (:</div>
        @endif
    </div>
@endsection
