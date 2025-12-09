<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_nilaiSiswa extends Model
{
    use HasFactory;
    protected $table = 'tb_siswa_nilai';
    protected $fillable = [
        'id',
        'nama_siswa',
        'absen_siswa',
        'kelas',
        'nilai',
    ];
    public $incrementing = true;
    public $timestamps = true;

}
