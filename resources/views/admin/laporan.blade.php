<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laporan Nilai Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>body{font-family:Inter,system-ui,-apple-system,'Segoe UI',Roboto,Arial}</style>
</head>

<body class="min-h-screen bg-slate-900 text-white p-8">

<h1 class="text-2xl font-bold mb-6">📊 Laporan Nilai Siswa</h1>
<a href="{{ route('admin.dashboard') }}" class="text-indigo-300 hover:underline mb-6 inline-block">
    ← Kembali ke Dashboard Admin
</a>

<!-- ===================== GRAFIK ==================== -->
<div class="p-6 bg-white/10 rounded-xl shadow-lg mb-8">
    <h2 class="text-lg font-semibold mb-4">Statistik Kelulusan</h2>

    <canvas id="chartNilai" height="100"></canvas>

    <script>
        const ctx = document.getElementById('chartNilai');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Tuntas', 'Remidi'],
                datasets: [{
                    data: [{{ $tuntas }}, {{ $remidi }}],
                    backgroundColor: ['#4ade80', '#f87171'],
                    borderWidth: 1
                }]
            }
        });
    </script>
</div>

<!-- ===================== TABEL ==================== -->
<h2 class="text-xl font-semibold mb-4">Daftar Nilai Siswa</h2>

<table class="w-full bg-white/10 rounded-xl overflow-hidden">
    <thead class="bg-white/20">
        <tr>
            <th class="p-3 text-left">ID</th>
            <th class="p-3 text-left">Nama</th>
            <th class="p-3 text-left">Absen</th>
            <th class="p-3 text-left">Kelas</th>
            <th class="p-3 text-left">Nilai</th>
            <th class="p-3 text-left">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)

        @php
            if ($d->kelas == 7) $kkm = 72;
            elseif ($d->kelas == 8) $kkm = 76;
            else $kkm = 78;

            $status = $d->nilai >= $kkm ? "Tuntas" : "Remidi";
            $color  = $d->nilai >= $kkm ? "text-green-300" : "text-red-300";
        @endphp

        <tr class="border-b border-white/10">
            <td class="p-3">{{ $d->id }}</td>
            <td class="p-3">{{ $d->nama_siswa }}</td>
            <td class="p-3">{{ $d->absen_siswa }}</td>
            <td class="p-3">{{ $d->kelas }}</td>
            <td class="p-3">{{ $d->nilai }}</td>
            <td class="p-3 font-bold {{ $color }}">{{ $status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
