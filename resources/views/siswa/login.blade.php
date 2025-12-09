<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Siswa</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-200 via-purple-200 to-pink-200 min-h-screen flex items-center justify-center font-sans">

<div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md border border-purple-300">

    <h2 class="text-3xl font-bold text-center text-purple-600 mb-6">
        🎒 Login Siswa
    </h2>

    @if(session('error'))
        <div class="mb-4 bg-red-100 text-red-600 px-4 py-2 rounded-lg border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('siswa.login.action') }}" method="POST">
        @csrf

        <!-- Kelas -->
        <label class="font-semibold text-purple-700">Kelas:</label>
        <select name="kelas" id="kelas" required
            class="w-full mt-1 mb-4 px-3 py-2 rounded-lg bg-purple-50 border border-purple-300 focus:ring-2 focus:ring-purple-400">
            <option value="">-- pilih kelas --</option>
            @foreach($kelas as $k)
                <option value="{{ $k->kelas }}">{{ $k->kelas }}</option>
            @endforeach
        </select>

        <!-- Nama -->
        <label class="font-semibold text-purple-700">Nama Siswa:</label>
        <select name="nama_siswa" id="nama_siswa" required
            class="w-full mt-1 mb-4 px-3 py-2 rounded-lg bg-purple-50 border border-purple-300 focus:ring-2 focus:ring-purple-400">
            <option value="">-- pilih kelas dulu --</option>
        </select>

        <!-- Absen -->
        <label class="font-semibold text-purple-700">Nomor Absen:</label>
        <input type="text" name="absen_siswa" placeholder="contoh: 1 atau 12" required
            class="w-full mt-1 mb-6 px-3 py-2 rounded-lg bg-purple-50 border border-purple-300 placeholder-purple-300 focus:ring-2 focus:ring-purple-400">

        <button type="submit"
            class="w-full bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 rounded-lg shadow-md transition">
            Masuk 🚀
        </button>
    </form>

     <a href="{{ ('/') }}" 
       class="mt-6 inline-block px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-lg shadow-md">
        Kembali 
        </a>
</div>

<script>
document.getElementById('kelas').addEventListener('change', function () {
    let kelas = this.value;

    fetch('/ajax/nama-siswa/' + kelas)
        .then(res => res.json())
        .then(data => {
            let option = '<option value="">-- pilih nama --</option>';
            data.forEach(d => {
                option += `<option value="${d.nama_siswa}">${d.nama_siswa}</option>`;
            });
            document.getElementById('nama_siswa').innerHTML = option;
        });
});
</script>

</body>
</html>
