<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Windi Pages</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body {
            background-color: #fdfdfc;
            color: #1b1b18;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
            font-family: 'Instrument Sans', sans-serif;
        }
        .container {
            text-align: center;
            max-width: 400px;
            animation: fadeIn 1s ease-in-out;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            margin: 10px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-color: #f53003;
            color: white;
        }
        .btn-primary:hover {
            background-color: #c42702;
        }
        .btn-secondary {
            background-color: transparent;
            border: 2px solid #f53003;
            color: #f53003;
        }
        .btn-secondary:hover {
            background-color: #f53003;
            color: white;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <i class="fas fa-user-circle fa-4x mb-3 text-danger"></i>
        <h1>Welcome to Windi Platform</h1>
        <p>We can learn together on this page Please log in or register to continue.</p>
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary"><i class="fas fa-tachometer-alt"></i> Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-secondary"><i class="fas fa-user-plus"></i> Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>