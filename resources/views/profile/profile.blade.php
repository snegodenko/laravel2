@extends('layouts.main')

@section('content')
    <h1>Profile</h1>
    <div class="page-content">
        <div class="profile-str mb-3">Name: {{ $request->user()->name }}</div>
        <div class="profile-str mb-3">Email: {{ $request->user()->email }}</div>
    </div>
@endsection
