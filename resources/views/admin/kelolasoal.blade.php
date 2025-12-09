<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kelola Soal — Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body{font-family:Inter,system-ui,-apple-system,'Segoe UI',Roboto,Arial}</style>
  </head>

  <body class="min-h-screen bg-slate-900 text-white p-8">

    <h1 class="text-2xl font-bold mb-6">Kelola Soal Susun Algoritma </h1>
    <a href="{{ route('admin.dashboard') }}" class="inline-block mb-6 text-sm text-indigo-200 hover:underline">← Kembali ke Dashboard Admin</a>

    <!-- ====================== FORM MANUAL ======================= -->
    <div class="mb-8 p-6 bg-white/10 rounded-xl shadow-lg">
      <h2 class="text-lg font-semibold mb-4">Tambah Soal Manual</h2>

      <form action="{{ route('admin.soal.store') }}" method="POST" class="space-y-4">
        @csrf
            <input type="hidden" name="type" value="manual">

         <div>
      <label class="block text-sm mb-1">Grade</label>
      <input type="text" name="grade"
        class="w-full p-2 rounded bg-white/20 focus:bg-white/30 outline-none"
        placeholder="Contoh: 7 / 8 / 9" required>
    </div>

    <div>
      <label class="block text-sm mb-1">Pertanyaan (q)</label>
      <textarea name="q"
        class="w-full p-2 rounded bg-white/20 focus:bg-white/30 outline-none"
        rows="3"
        placeholder="Tuliskan pertanyaan di sini..."
        required></textarea>
    </div>

    <div>
      <label class="block text-sm mb-1">Urutan Benar (correct) — JSON</label>
      <textarea name="correct"
        class="w-full p-2 rounded bg-white/20 focus:bg-white/30 outline-none"
        rows="3"
        placeholder='Contoh: ["Langkah 1", "Langkah 2", "Langkah 3"]'></textarea>
    </div>

    <div>
      <label class="block text-sm mb-1">Urutan Acak (items) — JSON</label>
      <textarea name="items"
        class="w-full p-2 rounded bg-white/20 focus:bg-white/30 outline-none"
        rows="3"
        placeholder='Contoh: ["Langkah 3", "Langkah 1", "Langkah 2"]'></textarea>
    </div>

        <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg">Simpan Manual</button>
      </form>
    </div>

    <!-- ====================== FORM UPLOAD JSON ======================= -->
    <div class="mb-8 p-6 bg-white/10 rounded-xl shadow-lg">
      <h2 class="text-lg font-semibold mb-4">Upload Soal via File JSON</h2>

      <form action="{{ route('admin.soal.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
  <input type="hidden" name="type" value="json">
        <div>
          <label class="block text-sm mb-1">Upload File JSON</label>
          <input type="file" name="json_file" accept=".json,.txt"
            class="w-full p-2 rounded bg-white/20 focus:bg-white/30 outline-none" required>
        </div>

        <button class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg">Upload Soal</button>
      </form>
    </div>

    <!-- ====================== TABEL DATA ======================= -->
    <h2 class="text-xl font-semibold mb-4">Daftar Soal</h2>

    <table class="w-full bg-white/10 rounded-xl overflow-hidden">
      <h2 class="text-xl font-semibold mb-4 mt-12">Daftar Soal</h2>

@php
    $grouped = $soal->groupBy('grade');
@endphp

@foreach([7,8,9] as $grade)
    <h3 class="text-lg font-bold mt-6 mb-2 text-indigo-300">Kelas {{ $grade }}</h3>

    @if(isset($grouped[$grade]) && count($grouped[$grade]) > 0)
        <table class="w-full bg-white/10 rounded-xl overflow-hidden mb-6">
        <thead class="bg-white/20">
            <tr>
                <th class="p-3 text-left">ID</th>
                <th class="p-3 text-left">Grade</th>
                <th class="p-3 text-left">Pertanyaan</th>
                <th class="p-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grouped[$grade] as $s)
                <tr class="border-b border-white/10">
                    <td class="p-3">{{ $s->id }}</td>
                    <td class="p-3">{{ $s->grade }}</td>
                    <td class="p-3">{{ Str::limit($s->q, 50) }}</td>
                    <td class="p-3">
                        <form action="/admin/soal/{{ $s->id }}/delete" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-300 hover:underline"
                                onclick="return confirm('Hapus soal ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    @else
        <p class="text-sm text-gray-400 ml-2 mb-4">Belum ada soal untuk kelas {{ $grade }}.</p>
    @endif
@endforeach

    </table>

  </body>
</html>
