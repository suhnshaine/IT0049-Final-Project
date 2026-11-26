<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

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

</body>
</html>