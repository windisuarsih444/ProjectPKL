<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Mapel;
use Yajra\DataTables\Facades\DataTables;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Nilai::with(['student', 'teacher', 'mapel'])->select('nilai.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('student.name', function ($row) {
                    return $row->student->name ?? '-';
                })
                ->editColumn('teacher.name', function ($row) {
                    return $row->teacher->name ?? '-';
                })
                ->editColumn('mapel.nama', function ($row) {
                    return $row->mapel->nama ?? '-';
                })
                ->addColumn('aksi', function ($row) {
                    return '
                        <a href="' . route('nilai.edit', $row->id) . '" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger btn-sm delete-button" data-id="' . $row->id . '">
                            <i class="fas fa-trash"></i> Hapus
                        </button>';
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->search['value'])) {
                        $searchValue = $request->search['value'];
                        $query->whereHas('student', function ($q) use ($searchValue) {
                            $q->where('name', 'like', "%{$searchValue}%");
                        })->orWhereHas('teacher', function ($q) use ($searchValue) {
                            $q->where('name', 'like', "%{$searchValue}%");
                        })->orWhereHas('mapel', function ($q) use ($searchValue) {
                            $q->where('nama', 'like', "%{$searchValue}%");
                        })->orWhere('nilai', 'like', "%{$searchValue}%");
                    }
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('backend.nilai.index');
    }

    public function create()
    {
        $students = Student::all();
        $teachers = Teacher::all();
        $mapels = Mapel::all();
        return view('backend.nilai.create', compact('students', 'teachers', 'mapels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teacher,id', 
            'mapel_id' => 'required|exists:mapel,id',
            'nilai' => 'required|numeric|min:0|max:100'
        ]);

        Nilai::create($request->only(['student_id', 'teacher_id', 'mapel_id', 'nilai']));

        return redirect()->route('nilai')->with('success', 'Nilai berhasil ditambahkan');
    }

    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        $students = Student::all();
        $teachers = Teacher::all();
        $mapels = Mapel::all();


        return view('backend.nilai.edit', compact('nilai', 'students', 'teachers', 'mapels'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teacher,id',
            'mapel_id' => 'required|exists:mapel,id',
            'nilai' => 'required|numeric|min:0|max:100'
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update($request->only(['student_id', 'teacher_id', 'mapel_id', 'nilai']));

        return redirect()->route('nilai')->with('success', 'Nilai berhasil diperbarui');
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();
        
        return response()->json(['success' => 'Nilai berhasil dihapus']);
    }
}
