<?php

namespace App\Http\Controllers;

use App\Models\Model_siwwa;
use Illuminate\Http\Request;

class AdminSiswaController extends Controller
{
    //
     public function index()
    {
        $siswa = Model_siwwa::orderBy('kelas')->orderBy('absen')->get();

        return view('admin.kelolasiswa', compact('siswa'));
    }

    // ==========================
    // SIMPAN DATA SISWA
    // Bisa manual atau JSON
    // ==========================
  public function store(Request $request)
{
    // Jika upload JSON
    if ($request->type === "json") {

        $request->validate([
            'json_file' => 'required|file|mimes:json,txt',
        ]);

        $jsonContent = $request->file('json_file')->get();
        $data = json_decode($jsonContent, true);

        if (!is_array($data)) {
            return back()->withErrors([
                'json_file' => 'Format JSON harus berupa ARRAY daftar siswa!'
            ]);
        }

        foreach ($data as $row) {

            if (
                !isset($row['nama_siswa']) ||
                !isset($row['kelas']) ||
                !isset($row['absen'])
            ) {
                return back()->withErrors([
                    'json_file' => 'JSON tidak lengkap. Wajib ada: nama_siswa, kelas, absen.'
                ]);
            }

            Model_siwwa::create([
                'nama_siswa' => $row['nama_siswa'], // FIX
                'kelas'      => $row['kelas'],
                'absen'      => $row['absen'],
            ]);
        }

        return back()->with('success', 'Data siswa dari JSON berhasil ditambahkan!');
    }

    // Jika input manual
    $validated = $request->validate([
        'nama_siswa' => 'required|string', // FIX
        'kelas'      => 'required|string',
        'absen'      => 'required|integer',
    ]);

    Model_siwwa::create([
        'nama_siswa' => $validated['nama_siswa'],
        'kelas'      => $validated['kelas'],
        'absen'      => $validated['absen'],
    ]);

    return back()->with('success', 'Data siswa berhasil ditambahkan!');
}


    // ==========================
    // HAPUS SISWA
    // ==========================
    public function destroy($id)
    {
        $siswa = Model_siwwa::findOrFail($id);
        $siswa->delete();

        return back()->with('success', 'Siswa berhasil dihapus!');
    }
}
