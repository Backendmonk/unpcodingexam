<?php

namespace App\Http\Controllers;

use App\Models\Model_nilaiSiswa;
use App\Models\Model_question;
use App\Models\Model_siwwa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $kelas = Model_siwwa::select('kelas')->distinct()->orderBy('kelas')->get();
        return view('siswa.login', compact('kelas'));
    }

    public function fetchNama($kelas)
    {
        return Model_siwwa::where('kelas', $kelas)
            ->orderBy('nama_siswa')
            ->get(['nama_siswa']);
    }

    public function loginAction(Request $request)
    {
        $request->validate([
            'kelas'        => 'required',
            'nama_siswa'   => 'required',
            'absen_siswa'  => 'required|integer',
        ]);

        $siswa = Model_siwwa::where('kelas', $request->kelas)
            ->where('nama_siswa', $request->nama_siswa)
            ->where('absen', $request->absen_siswa)
            ->first();

        if (!$siswa) {
            return back()->with('error', 'Data tidak cocok! Periksa kembali kelas, nama, dan nomor absen.');
        }

        // Cek nilai
        $cekNilai = Model_nilaiSiswa::where('kelas', $siswa->kelas)
            ->where('nama_siswa', $siswa->nama_siswa)
            ->where('absen_siswa', $siswa->absen)
            ->first();

      // Jika sudah ada nilai → langsung ke hasil
        if ($cekNilai) {
            session([
                'has_submitted' => true,
                'nilai' => $cekNilai->nilai,
                'kkm' => $cekNilai->kelas == '7' ? 72 : ($cekNilai->kelas == '8' ? 76 : 78),
                'status' => ($cekNilai->nilai >= ($cekNilai->kelas == '7' ? 72 : ($cekNilai->kelas == '8' ? 76 : 78)))
                    ? "LULUS 🎉" : "REMIDI ❌"
            ]);

            return redirect()->route('siswa.hasil');
}

        // Simpan session
        session([
            'kelas'        => $siswa->kelas,
            'nama_siswa'   => $siswa->nama_siswa,
            'absen_siswa'  => $siswa->absen
        ]);

        return redirect()->route('siswa.dashboard');
    }

    public function dashboard()
    {
        $kelas = session('kelas');
        $nama  = session('nama_siswa');
        $absen = session('absen_siswa');

        // Map kelas 9.1 & 9.2 -> 9
        $kelas_int = ($kelas == '9.1' || $kelas == '9.2') ? '9' : $kelas;

        $soal = Model_question::where('grade', $kelas_int)->get();

        return view('siswa.dashboard', compact('soal', 'kelas', 'nama', 'absen'));
    }

    public function submitUjian(Request $request)
{
    // Jika sudah submit, jangan boleh submit ulang
    if (session()->has('has_submitted')) {
        return redirect()->route('siswa.hasil');
    }

    $kelas = session('kelas');
    $nama  = session('nama_siswa');
    $absen = session('absen_siswa');

    $jawaban = $request->jawaban;

    $nilai = 0;
    $total = 0;

    foreach ($jawaban as $id => $userAnswer) {
        $soal = Model_question::find($id);
        if (!$soal) continue;

        $total++;

        $kunci = json_encode(json_decode($soal->correct));

        if (trim($userAnswer) === trim($kunci)) {
            $nilai += 1;
        }
    }

    $finalScore = ($total > 0) ? round(($nilai / $total) * 100) : 0;

    // KKM
    $kkm = 72;
    if ($kelas == '8') $kkm = 76;
    if (in_array($kelas, ['9', '9.1', '9.2'])) $kkm = 78;

    $status = ($finalScore >= $kkm) ? "LULUS 🎉" : "REMIDI ❌";

    // Simpan nilai ke DB
    Model_nilaiSiswa::create([
        'nama_siswa' => $nama,
        'absen_siswa' => $absen,
        'kelas' => $kelas,
        'nilai' => $finalScore
    ]);

    // SIMPAN STATUS SUBMIT
    session([
        'has_submitted' => true,
        'nilai' => $finalScore,
        'kkm' => $kkm,
        'status' => $status
    ]);

    return redirect()->route('siswa.hasil');
}

public function hasil()
{
    if (!session()->has('has_submitted')) {
        return redirect()->route('siswa.dashboard');
    }

    return view('siswa.hasil', [
        'nilai' => session('nilai'),
        'kkm' => session('kkm'),
        'status' => session('status'),
    ]);
}


}
