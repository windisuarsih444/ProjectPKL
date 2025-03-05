<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name'    => 'Windi',
                'email'   => 'windi444@gmail.com',
                'phone'   => '085211319447',
                'course'  => 'Fisika',
                'address' => 'Palembang',
                'gender'  => 'P',
                'status'  => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'    => 'Wahyu',
                'email'   => 'wahyu444@gmail.com',
                'phone'   => '085211319445',
                'course'  => 'Biologi',
                'address' => 'Bangka Belitung',
                'gender'  => 'L',
                'status'  => 'Tidak Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Looping untuk insert data ke dalam tabel
        foreach ($teachers as $teacher) {
            DB::table('teacher')->insert($teacher);
        }
    }
}
