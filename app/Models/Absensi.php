<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'matakuliah_id',
        'tanggal_absensi',
        'status_absen'
    ];

    protected $table = 'absensis';
}
