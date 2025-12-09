<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Ujian</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-xl shadow-xl text-center max-w-md">

    <h2 class="text-3xl font-bold mb-4 text-purple-600">📊 Hasil Ujian</h2>

    <p class="text-xl mb-2">Nilai Anda: 
        <span class="font-bold">{{ $nilai }}</span>
    </p>

    <p class="mb-2">KKM: {{ $kkm }}</p>

    <p class="text-2xl font-bold mt-4 
        {{ $status == 'LULUS 🎉' ? 'text-green-600' : 'text-red-600' }}">
        {{ $status }}
    </p>

</div>

</body>
</html>
