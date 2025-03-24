<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Pendaftaran;

class PendaftaranSearchController extends Controller
{
    /**
     * Menampilkan hasil pencarian status pendaftaran.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // Validasi input
        $request->validate([
            'query' => 'required|string|min:3', // Minimal 3 karakter untuk pencarian
        ]);

        // Ambil query dari input
        $query = $request->input('query');

        // Cari data pendaftaran berdasarkan nama atau NISN
        $pendaftaran = Pendaftaran::where('nama', 'like', '%' . $query . '%')
            ->orWhere('nisn', 'like', '%' . $query . '%')
            ->first(); // Mengambil satu hasil pertama

        // Jika ditemukan, kirim data lengkap
        if ($pendaftaran) {
            return view('welcome', [
                'nama_lengkap' => $pendaftaran->nama, // Nama lengkap
                'nisn' => $pendaftaran->nisn,         // NISN
                'status' => $pendaftaran->status,     // Status pendaftaran
            ]);
        }

        // Jika tidak ditemukan, tampilkan pesan error
        return view('welcome', [
            'status' => 'Data tidak ditemukan.',
        ]);
    }
}