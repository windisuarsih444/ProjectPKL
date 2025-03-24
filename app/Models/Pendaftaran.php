<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'pendaftaran';

    /**
     * Kolom-kolom yang dapat diisi secara massal (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'asal_sekolah',
        'nomor_hp',
        'nama_ayah',
        'nama_ibu',
        'email',
        'status', // Hanya satu kolom 'status' diperlukan
    ];

    /**
     * Casting atribut untuk memastikan format data yang benar.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_lahir' => 'date', // Memastikan tanggal_lahir selalu dalam format tanggal
        'status' => 'string',      // Memastikan status disimpan sebagai string
    ];

    /**
     * Mendefinisikan nilai default untuk atribut tertentu.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 'Tidak Diterima', // Default status jika tidak diisi
    ];

    /**
     * Scope untuk memfilter pendaftaran berdasarkan status "Diterima".
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDiterima($query)
    {
        return $query->where('status', 'Diterima');
    }

    /**
     * Scope untuk memfilter pendaftaran berdasarkan status "Tidak Diterima".
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTidakDiterima($query)
    {
        return $query->where('status', 'Tidak Diterima');
    }
}