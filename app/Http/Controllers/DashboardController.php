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

        // Filter berdasarkan tahun (contoh: tahun saat ini)
        $year = date('Y'); // Bisa diubah sesuai kebutuhan

        // Data untuk Bar Chart: Jumlah nilai berdasarkan bulan
        $barChartData = DB::table('nilai')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month')
            ->toArray(); // Konversi ke array

        // Mengisi data kosong untuk bulan yang tidak memiliki nilai
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $barChartValues = [];
        foreach ($months as $index => $monthName) {
            $monthNumber = $index + 1;
            $barChartValues[$monthName] = $barChartData[$monthNumber] ?? 0;
        }

        // Data untuk Pie Chart: Distribusi siswa berdasarkan kelas
        $pieChartData = DB::table('students')
            ->select('class', DB::raw('COUNT(*) as total'))
            ->groupBy('class')
            ->pluck('total', 'class')
            ->toArray(); // Konversi ke array

        // Kirim data ke view
        return view('backend.dashboard.index', compact(
            'dashboards',
            'student',
            'teacher',
            'mapel',
            'barChartValues',
            'pieChartData'
        ));
    }
}