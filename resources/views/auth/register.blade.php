@extends('layouts.main')

@section('content')
    <h1>Register</h1>
    <div class="page-content">
        <div class="form">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
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
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
            <div class="mb-3"><a href="{{ route('login') }}" class="link link-primary">Login</a></div>
        </div>
    </div>
@endsection

