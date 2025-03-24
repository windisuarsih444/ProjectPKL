<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    public function show($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return response()->json($pendaftaran);
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:Diterima,Ditolak',
        ]);

        // Cari data pendaftaran berdasarkan ID
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Perbarui status pendaftaran
        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        // Kirim respon JSON
        return response()->json(['message' => 'Status berhasil diperbarui']);
    }
    public function __construct()
    {
        // Middleware hanya diterapkan untuk halaman yang butuh login
        $this->middleware('auth')->except(['create', 'store']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pendaftaran::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($pendaftaran) {
                    return view('backend.pendaftaran.aksi', compact('pendaftaran'));
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.pendaftaran.index');
    }

    public function create()
    {
        return view('auth.create'); // Mengakses create.blade.php di dalam folder auth
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|unique:pendaftaran,nisn',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'asal_sekolah' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'email' => 'required|email|unique:pendaftaran,email',
        ]);

        // Simpan data
        Pendaftaran::create($validatedData);

        return redirect()->route('pendaftaran.create')->with('success', 'Pendaftaran berhasil dikirim.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Lakukan pencarian berdasarkan nama atau NISN
        $student = Pendaftaran::where('nama', 'LIKE', "%$query%")
                              ->orWhere('nisn', 'LIKE', "%$query%")
                              ->first();

        if ($student) {
            return response()->json([
                'status' => $student->status,
            ]);
        } else {
            return response()->json([
                'status' => 'Data tidak ditemukan.',
            ], 404);
        }
    }

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id); // Mengambil data pendaftaran berdasarkan ID
        return view('backend.pendaftaran.edit', compact('pendaftaran')); // Mengirim data ke view edit.blade.php
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|unique:pendaftaran,nisn,' . $id,
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'asal_sekolah' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'email' => 'required|email|unique:pendaftaran,email,' . $id,
        ]);

        // Cari data pendaftaran berdasarkan ID
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Update data
        $pendaftaran->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('pendaftaran')->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari data pendaftaran berdasarkan ID
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Hapus data
        $pendaftaran->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('pendaftaran')->with('success', 'Data pendaftaran berhasil dihapus.');
    }

}