<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\File;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // query untuk mengambil data teacher dengan pencarian
        $teachers = Teacher::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%")
                         ->orWhere('address', 'LIKE', "%$search%");

        // pagination
        })->paginate(3)->appends(request()->query());

        return view('backend.teacher.index', compact('teachers', 'search'));
    }

    public function create()
    {
        return view('backend.teacher.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:teacher,email', 
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $teacher = new Teacher($request->except('photo'));

        if ($request->hasFile('photo')) {
            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('backend/images'), $fileName);
            $teacher->photo = $fileName;
        }

        $teacher->save();

        return redirect()->route('teacher')->with('success', 'Guru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('backend.teacher.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:teacher,email,' . $id,
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            if ($teacher->photo && File::exists(public_path('backend/images/' . $teacher->photo))) {
                File::delete(public_path('backend/images/' . $teacher->photo));
            }

            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('backend/images'), $fileName);
            $data['photo'] = $fileName;
        }

        $teacher->update($data);

        return redirect()->route('teacher')->with('success', 'Guru berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);

        if ($teacher->photo && File::exists(public_path('backend/images/' . $teacher->photo))) {
            File::delete(public_path('backend/images/' . $teacher->photo));
        }

        $teacher->delete();

        return redirect()->route('teacher')->with('success', 'Guru berhasil dihapus!');
    }
}
