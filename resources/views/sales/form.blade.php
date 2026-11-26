@extends('layouts.app')

@section('content')

<div class="form-card">

    <h1>Record Sale</h1>

    <form method="POST"
          action="{{ route('sales.store') }}">

        @csrf

        <div class="form-group">

            <label for="product_id">
                Product
            </label>

            <select id="product_id"
                    name="product_id">

                <option value="">
                    Select Product
                </option>

                @foreach($products as $product)

                    <option
                        value="{{ $product->id }}"
                        {{ old('product_id') == $product->id ? 'selected' : '' }}>

                        {{ $product->name }}
                        (Stock: {{ $product->stock_quantity }})

                    </option>

                @endforeach

            </select>

            @error('product_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror

        </div>

        <div class="form-group">

            <label for="customer_id">
                Customer
            </label>

            <select id="customer_id"
                    name="customer_id">

                <option value="">
                    Walk-in Customer
                </option>

                @foreach($customers as $customer)

                    <option
                        value="{{ $customer->id }}"
                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>

                        {{ $customer->full_name }}

                    </option>

                @endforeach

            </select>

            @error('customer_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror

        </div>

        <div class="form-group">

            <label for="quantity">
                Quantity
            </label>

            <input
                id="quantity"
                type="number"
                min="1"
                name="quantity"
                value="{{ old('quantity') }}">

            @error('quantity')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror

        </div>

        <button type="submit"
                class="btn btn-primary">
            Record Sale
        </button>

        <a href="{{ route('sales.index') }}"
           class="btn btn-danger">
            Cancel
        </a>

    </form>

</div>

@endsection