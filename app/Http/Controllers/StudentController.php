<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%")
                  ->orWhere('phone', 'LIKE', "%$search%")
                  ->orWhere('class', 'LIKE', "%$search%")
                  ->orWhere('address', 'LIKE', "%$search%");
        }

        // paginasi dengan menambahkan appends()
        $students = $query->paginate(3)->appends(request()->query());

        return view('backend.student.index', compact('students'));
    }

    public function create()
    {
        return view('backend.student.create');
    }

    public function store(StoreStudentRequest $request)
    {
        try {
            $data = $request->all();

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('backend/images'), $filename);
                $data['photo'] = 'backend/images/' . $filename;
            } else {
                $data['photo'] = 'backend/images/default.png';
            }

            Student::create($data);
            return redirect()->route('students')->with('success', 'Data mahasiswa berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('backend.student.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required',
            'class' => 'required',
            'address' => 'required',
            'gender' => 'required|in:L,P',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $student = Student::findOrFail($id);
            $data = $request->all();

            if ($request->hasFile('photo')) {
                if ($student->photo && $student->photo !== 'backend/images/default.png' && file_exists(public_path($student->photo))) {
                    unlink(public_path($student->photo));
                }

                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('backend/images'), $filename);
                $data['photo'] = 'backend/images/' . $filename;
            }

            $student->update($data);
            
            // Perbaikan route update
            return redirect()->route('students')->with('success', 'Data mahasiswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);

            if ($student->photo && $student->photo !== 'backend/images/default.png' && file_exists(public_path($student->photo))) {
                unlink(public_path($student->photo));
            }

            $student->delete();
            return redirect()->route('students')->with('success', 'Data mahasiswa berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
