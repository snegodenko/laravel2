@extends('layouts.main')

@section('content')
    <h1>Update event {{ $event->title }}</h1>
    <div class="page-content">
        <div class="event-date">Start: {{ date('d-m-Y', strtotime($event->dt_start)) }}</div>
        <div class="event-date">End: {{ date('d-m-Y', strtotime($event->dt_end)) }}</div>
        <div class="form">
            @include('parts.event_from')
        </div>

    </div>
@endsection
