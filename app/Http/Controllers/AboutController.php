<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('about'); // Menampilkan halaman about.blade.php di folder resources/views
    }
}
