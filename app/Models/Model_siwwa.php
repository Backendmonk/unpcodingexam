<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_siwwa extends Model
{
    use HasFactory;
    protected $table = 'tb_siswa';
    protected $fillable = [
        'id',
        'nama_siswa',
        'absen',
        'kelas',
    ];
    public $incrementing = true;    
    public $timestamps = true;

}
