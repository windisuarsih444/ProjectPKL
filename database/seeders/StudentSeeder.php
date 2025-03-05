<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        DB::table('students')->insert([
                'name'    => 'Windi',
                'email'   => 'windi444@gmail.com',
                'phone'   => '085211319447',
                'class'  => 'Siswa X',
                'address' => 'Palembang',
                'gender'  => 'P',
                'status'  => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
        ]);

    }
}

