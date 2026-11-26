@extends('layouts.app')

@section('content')

@php
    $isEdit = !empty($user);
@endphp

<div class="form-card">

    <h1>{{ $title }}</h1>

    <form
        method="POST"
        action="{{ $isEdit ? route('users.update',$user->id) : route('users.store') }}"
        enctype="multipart/form-data">

        @csrf

        @if($isEdit)
            @method('PUT')
        @endif

        <div class="form-group">

            <label>Username</label>

            <input
                type="text"
                name="username"
                value="{{ old('username',$user->username ?? '') }}">

            @error('username')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="form-group">

            <label>Full Name</label>

            <input
                type="text"
                name="full_name"
                value="{{ old('full_name',$user->full_name ?? '') }}">

            @error('full_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="form-group">

            <label>
                Password
                @if($isEdit)
                    (leave blank to keep current password)
                @endif
            </label>

            <input type="password"
                   name="password">

            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="form-group">

            <label>Avatar</label>

            <input
                type="file"
                name="avatar"
                accept="image/*">

            @error('avatar')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <button class="btn btn-primary">
            {{ $isEdit ? 'Update Staff User' : 'Add Staff User' }}
        </button>

        <a href="{{ route('users.index') }}"
           class="btn btn-danger">
            Cancel
        </a>

    </form>

</div>

@endsection