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

        if ($cekNilai) {
            return back()->with('error', 'Kamu sudah mengerjakan dan memiliki nilai!');
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
        $kelas = session('kelas');
        $nama  = session('nama_siswa');
        $absen = session('absen_siswa');

        $jawaban = $request->jawaban;  // array: ['id_soal' => '["x","y","z"]']

        $nilai = 0;
        $total = 0;

        foreach ($jawaban as $id => $userAnswerJSON) {

            $soal = Model_question::find($id);
            if (!$soal) continue;

            $total++;

            // Decode jawaban user
            $userAnswer = json_decode($userAnswerJSON, true);

            // Decode kunci
            $correct = json_decode($soal->correct, true);

            // Bandingkan dua array
            if ($userAnswer == $correct) {
                $nilai++;
            }
        }

        // Hitung skor 0-100
        $finalScore = ($total > 0) ? round(($nilai / $total) * 100) : 0;

        // KKM
        $kkm = 72;
        if ($kelas == '8') $kkm = 76;
        if ($kelas == '9' || $kelas == '9.1' || $kelas == '9.2') $kkm = 78;

        $status = ($finalScore >= $kkm) ? "LULUS 🎉" : "REMIDI ❌";

        // Simpan nilai
        Model_nilaiSiswa::create([
            'nama_siswa' => $nama,
            'absen_siswa' => $absen,
            'kelas' => $kelas,
            'nilai' => $finalScore
        ]);

        return view('siswa.hasil', [
            'nilai' => $finalScore,
            'kkm'   => $kkm,
            'status'=> $status
        ]);
    }
}
