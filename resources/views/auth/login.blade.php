@extends('layouts.guest')

@section('content')

<div class="login-page">
    <div class="login-card">

        <h1>Staff Login</h1>

        @if(session('message'))
            <div class="success-message">
                {{ session('message') }}
            </div>
        @endif

        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="username">Username</label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">
                Login
            </button>

        </form>

    </div>
</div>

@endsection
