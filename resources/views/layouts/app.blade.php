<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <div class="container">
        <header class="header">
            <img src="/path_to_logo/logo.png" alt="Logo" class="logo">
            <nav>
                <ul>
                    <li><a href="{{ route('categories.index') }}">Budget Categories</a></li>
                    <li><a href="{{ route('expenses.index') }}">Expenses</a></li>
                </ul>
            </nav>
        </header>
        <hr>
        @yield('content')
    </div>
</body>
</html>
