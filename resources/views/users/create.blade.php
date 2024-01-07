@extends('layouts.main')

@section('content')
    <h1>Create user</h1>
    <div class="page-content">
        <div class="form">
            @include('parts.user_form')
        </div>
    </div>
@endsection
