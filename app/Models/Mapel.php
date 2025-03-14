<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel'; // Pastikan nama tabel sesuai dengan database
    protected $fillable = ['nama']; // Kolom yang bisa diisi massal
}
