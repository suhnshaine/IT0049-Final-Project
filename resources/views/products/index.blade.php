@extends('layouts.app')

@section('content')

<h1>Product List</h1>

<a href="{{ route('products.create') }}"
   class="btn btn-success">
    Add Product
</a>

<br><br>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Image</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

        @forelse($products as $product)

            <tr>

                <td>{{ $product->id }}</td>

                <td>{{ $product->name }}</td>

                <td>{{ number_format($product->price, 2) }}</td>

                <td>{{ $product->stock_quantity }}</td>

                <td>

                    @if($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="product-image"
                            width="80"
                            height="80"
                            style="object-fit: cover;">

                    @else

                        No Image

                    @endif

                </td>

                <td>{{ $product->created_at }}</td>

                <td>

                    <div class="actions">

                        <a href="{{ route('products.edit', $product->id) }}"
                           class="btn btn-primary">
                            Edit
                        </a>

                        <form
                            method="POST"
                            action="{{ route('products.destroy', $product->id) }}"
                            onsubmit="return confirm('Are you sure you want to delete this product?');">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger">
                                Delete
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="7" style="text-align:center;">
                    No products found.
                </td>
            </tr>

        @endforelse

    </tbody>

</table>

@endsection