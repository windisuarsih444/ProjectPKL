<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class PaginationController extends Controller
{
    public function students()
    {
        $students = Student::paginate(5); // Menampilkan 10 data per halaman
        return view('backend.student.index', compact('students'));
    }
}
