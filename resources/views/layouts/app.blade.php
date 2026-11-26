<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'POS System' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="header">
    <div class="logo">
        POS System
    </div>

    <nav>
        <a href="{{ route('products.index') }}">Products</a>
        <a href="{{ route('customers.index') }}">Customers</a>
        <a href="{{ route('users.index') }}">Users</a>
        <a href="{{ route('sales.index') }}">Sales</a>

        <form action="{{ route('logout') }}"
              method="POST"
              style="display:inline">

            @csrf

            <button
                type="submit"
                class="btn btn-danger">
                Logout
            </button>

        </form>
    </nav>
</header>

<div class="container">

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

    @yield('content')

</div>

<footer class="footer">
    <p>&copy; {{ date('Y') }} POS System</p>
</footer>

</body>
</html>