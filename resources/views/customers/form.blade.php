@extends('layouts.app')

@section('content')

@php
    $isEdit = !empty($customer);
@endphp

<div class="form-card">

    <h1>{{ $title }}</h1>

    <form
        action="{{ $isEdit ? route('customers.update',$customer->id) : route('customers.store') }}"
        method="POST">

        @csrf

        @if($isEdit)
            @method('PUT')
        @endif

        <div class="form-group">
            <label>Full Name</label>

            <input
                type="text"
                name="full_name"
                value="{{ old('full_name',$customer->full_name ?? '') }}">

            @error('full_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email',$customer->email ?? '') }}">

            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Phone</label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone',$customer->phone ?? '') }}">

            @error('phone')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary">
            {{ $isEdit ? 'Update Customer' : 'Add Customer' }}
        </button>

        <a href="{{ route('customers.index') }}"
           class="btn btn-danger">
            Cancel
        </a>

    </form>

</div>

@endsection