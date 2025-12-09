<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard — UNP Coding Exam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body{font-family:Inter,system-ui,-apple-system,'Segoe UI',Roboto,Arial}</style>
  </head>
  <body class="min-h-screen bg-gradient-to-br from-slate-900 to-indigo-900 text-white">
    <div class="container mx-auto px-6 py-12">
      <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>
        <a href="/" class="text-sm text-indigo-200 hover:underline">Kembali ke Beranda</a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card Soal -->
        <div class="p-6 rounded-xl bg-white/5 shadow-inner flex flex-col justify-between">
          <div>
            <h2 class="text-lg font-semibold mb-2">Soal</h2>
            <p class="text-sm text-indigo-100/80">Kelola bank soal, tambah, edit, dan hapus pertanyaan.</p>
          </div>
          <a href="/admin/soal" class="mt-4 inline-block px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-sm font-medium text-white text-center">Kelola Soal</a>
        </div>

        <!-- Card Siswa -->
        <div class="p-6 rounded-xl bg-white/5 shadow-inner flex flex-col justify-between">
          <div>
            <h2 class="text-lg font-semibold mb-2">Siswa</h2>
            <p class="text-sm text-indigo-100/80">Lihat daftar siswa, impor, dan sinkronisasi data.</p>
          </div>
          <a href="/admin/siswa" class="mt-4 inline-block px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-sm font-medium text-white text-center">Kelola Siswa</a>
        </div>

        <!-- Card Laporan -->
        <div class="p-6 rounded-xl bg-white/5 shadow-inner flex flex-col justify-between">
          <div>
            <h2 class="text-lg font-semibold mb-2">Laporan</h2>
            <p class="text-sm text-indigo-100/80">Lihat hasil ujian, statistik, dan ekspor laporan.</p>
          </div>
          <a href="/admin/laporan" class="mt-4 inline-block px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-sm font-medium text-white text-center">Lihat Laporan</a>
        </div>
      </div>

      <div class="mt-8">
        <div class="p-6 rounded-xl bg-white/6">
          <h3 class="text-lg font-medium">Selamat datang, Admin</h3>
          <p class="mt-2 text-sm text-indigo-100/80">Gunakan menu di atas untuk mengelola sistem.</p>
        </div>
      </div>
    </div>
  </body>
</html>
