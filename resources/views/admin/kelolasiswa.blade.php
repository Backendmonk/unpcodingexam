<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kelola Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>body{font-family:Inter,system-ui,-apple-system,'Segoe UI',Roboto,Arial}</style>
</head>

<body class="min-h-screen bg-slate-900 text-white p-8">

<h1 class="text-2xl font-bold mb-6">Kelola Data Siswa</h1>

<a href="{{ route('admin.dashboard') }}" class="inline-block mb-6 text-sm text-indigo-200 hover:underline">
  ← Kembali ke Dashboard Admin
</a>

<!-- FORM MANUAL -->
<div class="mb-8 p-6 bg-white/10 rounded-xl shadow-lg">
  <h2 class="text-lg font-semibold mb-4">Tambah Siswa Manual</h2>

  <form action="{{ route('admin.siswa.store') }}" method="POST" class="space-y-4">
    @csrf
    <input type="hidden" name="type" value="manual">

    <div>
      <label class="block text-sm mb-1">Nama</label>
      <input type="text" name="nama_siswa" class="w-full p-2 rounded bg-white/20" placeholder="Nama siswa" required>
    </div>

    <div>
      <label class="block text-sm mb-1">Kelas</label>
      <input type="text" name="kelas" class="w-full p-2 rounded bg-white/20" placeholder="Contoh: 7A / 8B / 9C" required>
    </div>

    <div>
      <label class="block text-sm mb-1">Absen</label>
      <input type="number" name="absen" class="w-full p-2 rounded bg-white/20" placeholder="Nomor absen" required>
    </div>

    <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg">
      Simpan Manual
    </button>
  </form>
</div>

<!-- FORM JSON -->
<div class="mb-8 p-6 bg-white/10 rounded-xl shadow-lg">
  <h2 class="text-lg font-semibold mb-4">Upload Data Siswa via JSON</h2>

  <form action="{{ route('admin.siswa.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <input type="hidden" name="type" value="json">

    <div>
      <label class="block text-sm mb-1">Upload File JSON</label>
      <input type="file" name="json_file" accept=".json,.txt"
             class="w-full p-2 rounded bg-white/20" required>
      <p class="text-xs text-indigo-200 mt-1">Format JSON: [{"nama":"Budi","kelas":"8A","absen":12}]</p>
    </div>

    <button class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg">Upload</button>
  </form>
</div>

<!-- TABEL -->
<h2 class="text-xl font-semibold mb-4">Daftar Siswa</h2>

<table class="w-full bg-white/10 rounded-xl overflow-hidden">
  <thead class="bg-white/20">
    <tr>
      <th class="p-3 text-left">ID</th>
      <th class="p-3 text-left">Nama</th>
      <th class="p-3 text-left">Kelas</th>
      <th class="p-3 text-left">Absen</th>
      <th class="p-3 text-left">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($siswa as $s)
    <tr class="border-b border-white/10">
      <td class="p-3">{{ $s->id }}</td>
      <td class="p-3">{{ $s->nama_siswa}}</td>
      <td class="p-3">{{ $s->kelas }}</td>
      <td class="p-3">{{ $s->absen }}</td>

      <td class="p-3">
        <form action="{{ route('admin.siswa.delete', $s->id) }}" method="POST" class="inline">
          @csrf @method('DELETE')
          <button onclick="return confirm('Hapus siswa ini?')" class="text-red-300 hover:underline">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

</body>
</html>
