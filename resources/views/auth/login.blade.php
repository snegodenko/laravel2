@extends('layouts.main')

@section('content')
    <h1>Login</h1>
    <div class="page-content">
        @if($request->session()->has('invalid'))
            <div class="alert alert-danger">{{ $request->session()->get('invalid') }}</div>
        @endif
        <div class="form">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control">
                </div>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            <div class="mb-3"><a href="{{ $facebookLink }}" class="btn btn-primary" target="_blank">Login with Facebook</a></div>
            <div class="mb-3"><a href="{{ route('register') }}" class="link link-primary">Register</a></div>
        </div>
    </div>
@endsection
