@extends('layouts.app')

@section('content')

<h1>Customer List</h1>

<a href="{{ route('customers.create') }}"
   class="btn btn-success">
    Add Customer
</a>

<br><br>

@if($customers->count())

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

    @foreach($customers as $customer)

    <tr>

        <td>{{ $customer->id }}</td>

        <td>{{ $customer->full_name }}</td>

        <td>{{ $customer->email }}</td>

        <td>{{ $customer->phone }}</td>

        <td>{{ $customer->created_at }}</td>

        <td class="actions">

            <a href="{{ route('customers.edit',$customer->id) }}"
               class="btn btn-primary">
                Edit
            </a>

            <form method="POST"
                  action="{{ route('customers.destroy',$customer->id) }}"
                  onsubmit="return confirm('Are you sure you want to delete this customer?');">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-danger">
                    Delete
                </button>

            </form>

        </td>

    </tr>

    @endforeach

    </tbody>

</table>

@else

<p>No customers found.</p>

@endif

@endsection