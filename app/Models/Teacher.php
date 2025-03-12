<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teacher'; 

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'course', 
        'address', 
        'gender', 
        'status', 
        'photo'
    ];

    // Jika tabel tidak memiliki timestamps (created_at & updated_at)
    public $timestamps = false;
}
