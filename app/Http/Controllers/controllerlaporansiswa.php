<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_nilaiSiswa;

class controllerlaporansiswa extends Controller
{
    public function index()
{
    $data = Model_nilaiSiswa::all();

    // SORT KELAS MANUAL
    $data = $data->sort(function($a, $b) {

        // pecah kelas: contoh "9.2" -> [9,2]
        $ka = explode('.', $a->kelas);
        $kb = explode('.', $b->kelas);

        // angka pertama (kelas utama)
        $mainA = intval($ka[0]);
        $mainB = intval($kb[0]);

        if ($mainA !== $mainB) {
            return $mainA <=> $mainB; // urut 7,8,9
        }

        // jika ada subkelas seperti .1 .2
        $subA = isset($ka[1]) ? intval($ka[1]) : 0;
        $subB = isset($kb[1]) ? intval($kb[1]) : 0;

        return $subA <=> $subB;
    });

    // Hitung kelulusan
    $remidi = 0;
    $tuntas = 0;

    foreach ($data as $row) {

        if ($row->kelas == 7) $kkm = 72;
        elseif ($row->kelas == 8) $kkm = 76;
        else $kkm = 78; // kelas 9 & subkelas

        if ($row->nilai >= $kkm) $tuntas++;
        else $remidi++;
    }

    return view('admin.laporan', [
        'data' => $data,
        'remidi' => $remidi,
        'tuntas' => $tuntas
    ]);
}

}
