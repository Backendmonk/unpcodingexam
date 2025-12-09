<!DOCTYPE html>
<html>
<head>
    <title>Hasil Ujian</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-purple-100 flex items-center justify-center">

<div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md text-center">

    <h1 class="text-3xl font-bold text-purple-600 mb-4">Hasil Ujian</h1>

    <p class="text-xl font-semibold mb-2">Nilai Kamu:</p>
    <p class="text-4xl font-bold mb-4">{{ $nilai }}</p>

    <p class="text-lg mb-2">KKM: {{ $kkm }}</p>

    <p class="text-2xl font-bold 
        {{ $status == 'LULUS 🎉' ? 'text-green-600' : 'text-red-600' }}">
        {{ $status }}
    </p>
    <a href="{{ route('siswa.login') }}" 
       class="mt-6 inline-block px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-lg shadow-md">
        Kembali ke Dashboard
    </a>

</div>

</body>
</html>
