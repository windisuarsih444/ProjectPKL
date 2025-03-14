<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;
use DataTables;
use DB;

class MapelController extends Controller
{
    // Menampilkan daftar mata pelajaran
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Mapel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '<a href="'.route('mapel.edit', $row->id).'" class="btn btn-warning btn-sm me-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button type="button" class="btn btn-danger btn-sm delete-button" data-id="'.$row->id.'">
                                <i class="fas fa-trash"></i> Hapus
                            </button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.mapel.index');
    }

    public function create()
{
    
    return view('backend.mapel.create');
}
public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
    ]);

    Mapel::create([
        'nama' => $request->nama
    ]);

    return redirect()->route('mapel')->with('success', 'Mata Pelajaran berhasil ditambahkan!');
}


    // Menampilkan halaman edit mata pelajaran
    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        return view('backend.mapel.edit', compact('mapel'));
    }

    // Memperbarui data mata pelajaran
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $mapel = Mapel::findOrFail($id);
        $mapel->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('mapel')->with('success', 'Mata Pelajaran berhasil diperbarui!');
    }

    // Menghapus data mata pelajaran menggunakan AJAX
    public function destroy($id)
    {
        try {
            $mapel = Mapel::findOrFail($id);
            $mapel->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data.'
            ], 500);
        }
    }
}
