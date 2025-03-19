<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Mapel;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil jumlah data dari tabel student, teacher, dan mapel
        $student = Student::count();
        $teacher = Teacher::count();
        $mapel = Mapel::count();

        // Data card dashboard
        $dashboards = [
            ['title' => 'Student', 'value' => $student, 'icon' => 'fas fa-users', 'color' => 'primary'],
            ['title' => 'Teacher', 'value' => $teacher, 'icon' => 'fas fa-user-check', 'color' => 'info'],
            ['title' => 'Mapel', 'value' => $mapel, 'icon' => 'fas fa-book', 'color' => 'success'],
        ];

        return view('backend.dashboard.index', compact('dashboards', 'student', 'teacher', 'mapel'));
    }
}
