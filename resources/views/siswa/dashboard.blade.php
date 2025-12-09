<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ujian Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
</head>

<body class="bg-gradient-to-br from-blue-100 to-purple-100 min-h-screen p-6">

<h1 class="text-3xl font-bold text-center text-purple-700 mb-6">
    📘 Ujian Kelas {{ $kelas }}
</h1>

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-lg">

    <div class="text-center mb-4 text-lg font-semibold">
        ⏳ Waktu Tersisa: 
        <span id="timer" class="text-red-600">15:00</span>
    </div>

    <form action="{{ route('siswa.submit') }}" method="POST">
        @csrf

        @foreach($soal as $index => $s)
            @php 
                $items = json_decode($s->items, true);
            @endphp

            <div class="mb-6 p-4 bg-purple-50 border border-purple-200 rounded-lg">
                <p class="font-semibold mb-2">Soal {{ $index+1 }}:</p>
                <p class="mb-3">{{ $s->q }}</p>

                <ul id="sortable-{{ $s->id }}" class="space-y-2">
                    @foreach($items as $item)
                        <li class="p-2 bg-white border rounded shadow cursor-move">
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>

                <input type="hidden" name="jawaban[{{ $s->id }}]" id="input-{{ $s->id }}">
            </div>

            <script>
                new Sortable(document.getElementById('sortable-{{ $s->id }}'), {
                    animation: 150,
                    onSort: function () {
                        let arr = [];
                        document.querySelectorAll('#sortable-{{ $s->id }} li').forEach(li => {
                            arr.push(li.innerText.trim());
                        });
                        document.getElementById("input-{{ $s->id }}").value = JSON.stringify(arr);
                    }
                });

                // set initial value
                window.addEventListener('load', () => {
                    let arr = [];
                    document.querySelectorAll('#sortable-{{ $s->id }} li').forEach(li => {
                        arr.push(li.innerText.trim());
                    });
                    document.getElementById("input-{{ $s->id }}").value = JSON.stringify(arr);
                });
            </script>

        @endforeach

        <button class="w-full bg-purple-600 text-white py-3 rounded-xl font-bold hover:bg-purple-700 mt-4">
            Kumpulkan Jawaban
        </button>

    </form>
</div>

<!-- ==========================================
        🔒 FITUR ANTI REFRESH / BACK / CLOSE
=========================================== -->
<script>
// ==============================================
// 1. BLOK F5 / CTRL+R / CMD+R
// ==============================================
document.addEventListener('keydown', function (e) {
    if (
        e.key === "F5" || 
        (e.ctrlKey && e.key === "r") || 
        (e.metaKey && e.key === "r")
    ) {
        e.preventDefault();
        alert("❗ Halaman tidak boleh di-refresh. Jawaban dikumpulkan.");
        document.querySelector("form").submit();
    }
});

// ==============================================
// 2. BLOK TOMBOL RELOAD BROWSER
// ==============================================
window.addEventListener("beforeunload", function (e) {
    document.querySelector("form").submit();
    e.preventDefault();
    e.returnValue = '';
});

// ==============================================
// 3. CEGAH TOMBOL BACK
// ==============================================
history.pushState(null, null, location.href);
window.onpopstate = function () {
    alert("❗ Tidak bisa kembali ketika ujian berlangsung.");
    history.pushState(null, null, location.href);
};

// ==============================================
// 4. KETIKA TAB DITUTUP / PINDAH TAB → AUTO SUBMIT
// ==============================================
document.addEventListener("visibilitychange", function() {
    if (document.hidden) {
        document.querySelector("form").submit();
    }
});

// ==============================================
// 5. TIMER 60 MENIT
// ==============================================
let time = 3600;

setInterval(function() {
    let minutes = Math.floor(time / 60);
    let seconds = time % 60;

    document.getElementById("timer").innerText = 
        `${minutes}:${seconds.toString().padStart(2, '0')}`;

    if (time <= 0) {
        alert("⏰ Waktu habis! Jawaban otomatis dikumpulkan.");
        document.querySelector("form").submit();
    }

    time--;
}, 1000);
</script>

</body>
</html>
