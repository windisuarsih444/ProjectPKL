<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f9fafb; 
            color: #333;
            overflow-x: hidden; 
        }

        /* Status Message */
        .status-message {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            font-size: 1rem;
            animation: fadeIn 1s ease-out;
            border: 2px solid transparent; /* Default border transparan */
        }

        .status-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #28a745; /* Border hijau untuk status diterima */
        }

        .status-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #dc3545; /* Border merah untuk status ditolak */
        }

        /* Animasi Fade-In */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .content-wrapper {
            flex: 1; 
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .hero-section {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            padding: 60px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 10px;
            animation: fadeInUp 1s ease-out;
        }

        .hero-section p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            animation: fadeInUp 1.5s ease-out;
        }

        .hero-section button {
            background-color: white;
            color: #1e3c72;
            border: none;
            padding: 12px 24px;
            font-size: 1rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            animation: fadeInUp 2s ease-out;
        }

        .hero-section button:hover {
            background-color: #1e3c72;
            color: white;
            box-shadow: 0 4px 6px rgba(30, 60, 114, 0.3);
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 10%, transparent 10.01%);
            transform: translateX(-50%) translateY(-50%) rotate(45deg);
            animation: rotateBackground 10s linear infinite;
        }

        @keyframes rotateBackground {
            0% {
                transform: translateX(-50%) translateY(-50%) rotate(0deg);
            }
            100% {
                transform: translateX(-50%) translateY(-50%) rotate(360deg);
            }
        }

        .search-section {
            margin-top: -50px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 2.5s ease-out;
        }

        .search-section h2 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .search-section form {
            display: flex;
            gap: 10px;
        }

        .search-section input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-section input:focus {
            border-color: #1e3c72;
            box-shadow: 0 0 5px rgba(30, 60, 114, 0.5);
        }

        .search-section button {
            padding: 10px 20px;
            background-color: #1e3c72;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-section button:hover {
            background-color: #2a5298;
            box-shadow: 0 4px 6px rgba(42, 82, 152, 0.3);
        }

        .status-message {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            font-size: 1rem;
            animation: fadeInUp 3s ease-out;
        }

        .status-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        footer {
            background-color: #1e3c72;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto; 
        }

        footer a {
            color: #FFFAED;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        footer a:hover {
            color: #FFFAED;
            text-decoration: underline;
        }

        .btn-custom {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login {
            background-color: #1e3c72;
            color: white;
        }

        .btn-login:hover {
            background-color: #2a5298;
            box-shadow: 0 4px 6px rgba(42, 82, 152, 0.3);
        }

        .btn-register {
            background-color: #FFFAED;
            color: #1e3c72;
            border: 1px solid #1e3c72;
        }

        .btn-register:hover {
            background-color: #1e3c72;
            color: white;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }

        
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <section class="hero-section">
            <div class="container">
                <h1>Selamat Datang di Aplikasi Pembelajaran Microdata Indonesia</h1>
                <p>Platform Modern Guna Mendukung Pembelajaran Mahasiswa PKL Politeknik Negeri Lampung 2025.</p>
                <a href="{{ route('pendaftaran.create') }}">
                    <button>Daftar Sekarang</button>
                </a>
            </div>
        </section>
        <!-- Search Section -->
        <div class="container">
            <div class="search-section"><br>
                <h2>Cek Status Pendaftaran</h2>
                <p>Masukkan Nama atau NISN untuk memeriksa status penerimaan.</p>

                <!-- Form Pencarian -->
                <form action="{{ route('search.pendaftaran') }}" method="GET">
                    <div class="flex gap-2">
                        <input type="text" name="query" placeholder="Nama atau NISN" required
                            class="px-3 py-1 border border-gray-300 rounded-sm focus:outline-none focus:border-[#F53003]">
                        <button type="submit"
                            class="px-4 py-1 bg-[#F53003] text-white rounded-sm hover:bg-[#FF4433] transition-colors">
                            Cari
                        </button>
                    </div>
                </form>
                <br>
                <br>
                <br>

                <!-- Tombol Login dan Register -->
                <div class="auth-buttons mt-4 flex justify-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-custom btn-login">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-custom btn-login">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-custom btn-register">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
                <br>

               <!-- Area untuk Menampilkan Hasil Pencarian -->
                @if(isset($status))
                    @if(isset($nama_lengkap) && isset($nisn))
                        <div class="status-message 
                            @if($status === 'Diterima') status-success 
                            @elseif($status === 'Tidak Diterima' || $status === 'Ditolak') status-danger 
                            @endif"
                            style="animation: fadeIn 1s ease-out;">
                            <p><strong>Nama Lengkap:</strong> {{ $nama_lengkap }}</p>
                            <p><strong>NISN:</strong> {{ $nisn }}</p>
                            <p><strong>Status:</strong> {{ $status }}</p>
                        </div>
                    @else
                        <div class="status-message status-danger" style="animation: fadeIn 1s ease-out;">
                            <p>{{ $status }}</p>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Microdata Indonesia. All rights reserved. | 
            <a href="https://laravel.com/docs" target="_blank">Documentation</a>
        </p>
    </footer>
</body>
</html>