<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Pilih Login — UNP Coding Exam</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body { font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; }
        </style>
    </head>
    <body class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-900 to-purple-800 text-white">
        <div class="container mx-auto px-6 py-16">
            <div class="max-w-3xl mx-auto text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 mb-6 rounded-full bg-white/10 backdrop-blur-lg shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c2.761 0 5-2.239 5-5S14.761 1 12 1 7 3.239 7 6s2.239 5 5 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 22c0-4.418 3.582-8 8-8s8 3.582 8 8"/>
                    </svg>
                </div>

                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight mb-2">Pilih Jenis Login</h1>
                <p class="text-indigo-200/80 mb-8">Masuk sebagai <span class="font-semibold text-white">Admin</span> atau <span class="font-semibold text-white">Siswa</span> untuk melanjutkan ke sistem UNP Coding Exam.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Admin Card -->
                    <a href="/login/admin" class="group block transform hover:-translate-y-1 transition shadow-lg rounded-xl bg-gradient-to-br from-indigo-700 to-indigo-500 p-6 ring-1 ring-white/5">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-white/10 group-hover:bg-white/20 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11V3m0 0L8 7m4-4 4 4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold">Login Admin</h3>
                                <p class="text-indigo-100/80 mt-1 text-sm">Akses panel kontrol, manajemen soal, dan laporan ujian.</p>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-sm font-medium opacity-90">Masuk sebagai Admin</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 text-sm">Mulai →</span>
                        </div>
                    </a>

                    <!-- Siswa Card -->
                    <a href="/login/siswa" class="group block transform hover:-translate-y-1 transition shadow-lg rounded-xl bg-white/5 backdrop-blur-sm p-6 ring-1 ring-white/10 border border-white/5">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-white/6 group-hover:bg-white/10 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422A12.083 12.083 0 0121 12.5c0 4.418-3.582 8-8 8s-8-3.582-8-8c0-.345.016-.685.047-1.02L12 14z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold">Login Siswa</h3>
                                <p class="text-indigo-100/80 mt-1 text-sm">Masuk untuk mengerjakan soal dan melihat hasil ujian.</p>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-sm font-medium opacity-90">Masuk sebagai Siswa</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 text-sm">Mulai →</span>
                        </div>
                    </a>
                </div>

                <p class="text-sm text-indigo-100/60 mt-8">Butuh akun? Hubungi administrator sekolah untuk pembuatan akun siswa atau admin.</p>
            </div>
        </div>
    </body>
</html>
