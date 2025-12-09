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

    <h1 class="text-2xl font-bold mb-6">Kelola Soal Susun Algoritma</h1>

    <div class="mb-8 p-6 bg-white/10 rounded-xl shadow-lg">
      <h2 class="text-lg font-semibold mb-4">Tambah Soal Baru</h2>

      <form action="/admin/soal/store" method="POST" class="space-y-4">
        @csrf

        <div>
          <label class="block text-sm mb-1">Grade</label>
          <input type="text" name="grade" class="w-full p-2 rounded bg-white/20 focus:bg-white/30 outline-none" placeholder="Contoh: 10" required>
        </div>

        <div>
          <label class="block text-sm mb-1">Pertanyaan (q)</label>
          <textarea name="q" class="w-full p-2 rounded bg-white/20 focus:bg-white/30 outline-none" rows="3" placeholder="Tuliskan pertanyaan" required></textarea>
        </div>

        <div>
          <label class="block text-sm mb-1">Urutan Benar (correct)</label>
          <textarea name="correct" class="w-full p-2 rounded bg-white/20 focus:bg-white/30 outline-none" rows="3" placeholder='Contoh:
[
  "Mulai",
  "Input nilai n",
  "Tampilkan n"
]' required></textarea>
          <p class="text-xs text-indigo-200 mt-1">*Format JSON array</p>
        </div>

        <div>
          <label class="block text-sm mb-1">Urutan Acak (items)</label>
          <textarea name="items" class="w-full p-2 rounded bg-white/20 focus:bg-white/30 outline-none" rows="3" placeholder='Contoh:
[
  "Tampilkan n",
  "Mulai",
  "Input nilai n"
]' required></textarea>
          <p class="text-xs text-indigo-200 mt-1">*Format JSON array yang berisi urutan acak dari "correct"</p>
        </div>

        <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg">Simpan Soal</button>
      </form>
    </div>

    <h2 class="text-xl font-semibold mb-4">Daftar Soal</h2>

    <table class="w-full bg-white/10 rounded-xl overflow-hidden">
      <thead class="bg-white/20">
        <tr>
          <th class="p-3 text-left">ID</th>
          <th class="p-3 text-left">Grade</th>
          <th class="p-3 text-left">Pertanyaan</th>
          <th class="p-3 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($soal as $s)
        <tr class="border-b border-white/10">
          <td class="p-3">{{ $s->id }}</td>
          <td class="p-3">{{ $s->grade }}</td>
          <td class="p-3">{{ Str::limit($s->q, 50) }}</td>
          <td class="p-3">
            <a href="/admin/soal/{{ $s->id }}" class="text-indigo-300 hover:underline mr-3">Lihat</a>
            <a href="/admin/soal/{{ $s->id }}/edit" class="text-yellow-300 hover:underline mr-3">Edit</a>
            <form action="/admin/soal/{{ $s->id }}/delete" method="POST" class="inline">
              @csrf
              @method('DELETE')
              <button class="text-red-300 hover:underline" onclick="return confirm('Hapus soal ini?')">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </body>
</html>
