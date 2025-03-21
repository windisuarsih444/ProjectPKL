<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class PendaftaranController extends Controller
{
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

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('backend.pendaftaran.edit', compact('pendaftaran'));
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Validasi data dengan pengecualian ID agar bisa update
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

        // Update data
        $pendaftaran->update($validatedData);

        return redirect()->route('pendaftaran')->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('pendaftaran')->with('success', 'Data pendaftaran berhasil dihapus.');
    }

    public function exportPDF()
    {
        $pendaftaran = Pendaftaran::all();
        $pdf = Pdf::loadView('backend.pendaftaran.pdf', compact('pendaftaran'));

        return $pdf->download('data_pendaftaran.pdf');
    }

    public function show($id)
{
    $pendaftaran = Pendaftaran::findOrFail($id);
    return response()->json($pendaftaran);
}

    public function updateStatus(Request $request, $id)
{
    $pendaftaran = Pendaftaran::findOrFail($id);
    $pendaftaran->status = $request->status;
    $pendaftaran->save();

    return response()->json(['message' => 'Status berhasil diperbarui']);
}


}
