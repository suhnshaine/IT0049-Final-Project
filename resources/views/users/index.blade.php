@extends('layouts.app')

@section('content')

<h1>User List</h1>

<a href="{{ route('users.create') }}"
   class="btn btn-success">
    Add Staff User
</a>

<br><br>

<table>

    <thead>

        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Avatar</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>

    </thead>

    <tbody>

    @foreach($users as $user)

        <tr>

            <td>{{ $user->id }}</td>

            <td>{{ $user->username }}</td>

            <td>{{ $user->full_name }}</td>

            <td>

                @if($user->avatar)

                    <img
                        src="{{ asset('storage/'.$user->avatar) }}"
                        alt="{{ $user->full_name }}"
                        class="product-image">

                @else

                    No Image

                @endif

            </td>

            <td>{{ $user->created_at }}</td>

            <td>

                <div class="actions">

                    <a href="{{ route('users.edit',$user->id) }}"
                       class="btn btn-primary">
                        Edit
                    </a>

                    <form method="POST"
                          action="{{ route('users.destroy',$user->id) }}"
                          onsubmit="return confirm('Are you sure you want to delete this user?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger">
                            Delete
                        </button>

                    </form>

                </div>

            </td>

        </tr>

    @endforeach

    </tbody>

</table>

@endsection@extends('layouts.app')

@section('content')

<h1>User List</h1>

<a href="{{ route('users.create') }}"
   class="btn btn-success">
    Add Staff User
</a>

<br><br>

<table>

    <thead>

        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Avatar</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>

    </thead>

    <tbody>

    @foreach($users as $user)

        <tr>

            <td>{{ $user->id }}</td>

            <td>{{ $user->username }}</td>

            <td>{{ $user->full_name }}</td>

            <td>

                @if($user->avatar)

                    <img
                        src="{{ asset('storage/'.$user->avatar) }}"
                        alt="{{ $user->full_name }}"
                        class="product-image">

                @else

                    No Image

                @endif

            </td>

            <td>{{ $user->created_at }}</td>

            <td>

                <div class="actions">

                    <a href="{{ route('users.edit',$user->id) }}"
                       class="btn btn-primary">
                        Edit
                    </a>

                    <form method="POST"
                          action="{{ route('users.destroy',$user->id) }}"
                          onsubmit="return confirm('Are you sure you want to delete this user?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger">
                            Delete
                        </button>

                    </form>

                </div>

            </td>

        </tr>

    @endforeach

    </tbody>

</table>

@endsection