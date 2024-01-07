
@extends('layouts.main')

@section('content')
    <h1>Update User {{ $user->name }}</h1>
    <div class="page-content">

        @if($user->events->isNotEmpty())
        <div class="events-list">
            <h3>Events list</h3>
            <div class="events-list-content">
                @foreach($user->events as $event)
                    <div class="event-list-item">{{ $event->title }}</div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="form">
        @include('parts.user_form')
        </div>
    </div>

@endsection
