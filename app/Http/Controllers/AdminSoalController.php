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
        $validated = $request->validate([
            'grade' => 'required|string',
            'q' => 'required|string',
            'items' => 'required|array',
            'correct' => 'required|array',
        ]);

        // Simpan data ke database
        Model_question::create([
            'grade' => $validated['grade'],
            'q' => $validated['q'],
            'items' => json_encode($validated['items']),
            'correct' => json_encode($validated['correct']),
        ]);

        return redirect()->route('admin.soal')->with('success', 'Soal berhasil ditambahkan.');
    }
}
