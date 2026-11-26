@extends('layouts.app')

@section('content')

<h1>Sales History</h1>

<a href="{{ route('sales.create') }}"
   class="btn btn-success">
    Record Sale
</a>

<br><br>

<table>

    <thead>

        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Customer</th>
            <th>Cashier</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Date</th>
        </tr>

    </thead>

    <tbody>

    @foreach($sales as $sale)

        <tr>

            <td>{{ $sale->id }}</td>

            <td>{{ $sale->product->name }}</td>

            <td>
                {{ $sale->customer?->full_name ?? 'Walk-in Customer' }}
            </td>

            <td>{{ $sale->staff->full_name }}</td>

            <td>{{ $sale->quantity }}</td>

            <td>{{ number_format($sale->total_price,2) }}</td>

            <td>{{ $sale->created_at }}</td>

        </tr>

    @endforeach

    </tbody>

</table>

@endsection