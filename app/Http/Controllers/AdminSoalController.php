<?php

namespace App\Http\Controllers;

use App\Models\Model_question;
use Illuminate\Http\Request;

class AdminSoalController extends Controller
{
    //

    public function index()
    {   

        $soal = Model_question::all();
        return view('admin.kelolasoal', compact('soal'));
    }

 public function store(Request $request)
{
    // =============== FORM MANUAL ===============
    if ($request->type === 'manual') {

        $validated = $request->validate([
            'grade' => 'required|string',
            'q' => 'required|string',
            'items' => 'required|string',
            'correct' => 'required|string',
        ]);

        $items = json_decode($validated['items'], true);
        $correct = json_decode($validated['correct'], true);

        if (!is_array($items) || !is_array($correct)) {
            return back()->withErrors(['items' => 'Format JSON tidak valid!'])->withInput();
        }

        Model_question::create([
            'grade' => $validated['grade'],
            'q' => $validated['q'],
            'items' => json_encode($items),
            'correct' => json_encode($correct),
        ]);

        return redirect()
            ->route('admin.soal')
            ->with('success', 'Soal manual berhasil ditambahkan.');
    }

    // =============== FORM JSON FILE ===============
    if ($request->type === 'json') {

        $validated = $request->validate([
            'json_file' => 'required|file|mimes:json,txt',
        ]);

        $json = $request->file('json_file')->get();
        $data = json_decode($json, true);

        if (!is_array($data)) {
            return back()->withErrors([
                'json_file' => 'Format JSON harus berupa array daftar soal!',
            ])->withInput();
        }

        foreach ($data as $s) {

            if (!isset($s['grade'], $s['q'], $s['items'], $s['correct'])) {
                return back()->withErrors([
                    'json_file' => 'Setiap soal harus berisi grade, q, items, correct.',
                ])->withInput();
            }

            Model_question::create([
                'grade' => $s['grade'],
                'q' => $s['q'],
                'items' => json_encode($s['items']),
                'correct' => json_encode($s['correct']),
            ]);
        }

        return redirect()
            ->route('admin.soal')
            ->with('success', 'File JSON berhasil diupload dan disimpan.');
    }

    // Jika tidak ditemukan tipe form
    return back()->withErrors(['type' => 'Form tidak dikenali.']);
}


public function destroy($id)
{
    // Cari soal
    $soal = Model_question::find($id);

    // Jika tidak ditemukan
    if (!$soal) {
        return redirect()->back()->with('error', 'Soal tidak ditemukan!');
    }

    // Hapus
    $soal->delete();

    return redirect()->route('admin.soal')->with('success', 'Soal berhasil dihapus!');
}


}
