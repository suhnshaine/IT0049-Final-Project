@extends('layouts.app')

@section('content')

@php
    $isEdit = !empty($product);
@endphp

<div class="form-card">

    <h1>{{ $title }}</h1>

    <form
        method="POST"
        action="{{ $isEdit ? route('products.update',$product->id) : route('products.store') }}"
        enctype="multipart/form-data">

        @csrf

        @if($isEdit)
            @method('PUT')
        @endif

        <div class="form-group">
            <label>Product Name</label>

            <input
                type="text"
                name="name"
                value="{{ old('name',$product->name ?? '') }}">

            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Price</label>

            <input
                type="number"
                step="0.01"
                name="price"
                value="{{ old('price',$product->price ?? '') }}">

            @error('price')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Stock Quantity</label>

            <input
                type="number"
                name="stock_quantity"
                value="{{ old('stock_quantity',$product->stock_quantity ?? '') }}">

            @error('stock_quantity')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Product Image</label>

            <input
                type="file"
                name="image"
                accept="image/*">

            @error('image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary">
            {{ $isEdit ? 'Update Product' : 'Add Product' }}
        </button>

        <a href="{{ route('products.index') }}"
           class="btn btn-danger">
            Cancel
        </a>

    </form>

</div>

@endsection