@extends('layouts.guest')

@section('content')

<div class="login-page">
    <div class="login-card">

        <h1>Staff Login</h1>

        <form method="POST"
              action="{{ route('login') }}">

            @csrf

            <div class="form-group">
                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    required>
            </div>

            <div class="form-group">
                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    required>
            </div>

            <button type="submit"
                    class="btn btn-primary">

                Login
            </button>

        </form>

    </div>
</div>

@endsection