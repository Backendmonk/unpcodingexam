<!doctype html>
<html lang="id">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Tambah Akun — Admin</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
		<script src="https://cdn.tailwindcss.com"></script>
		<style>body{font-family:Inter,system-ui,-apple-system,'Segoe UI',Roboto,Arial}</style>
	</head>
	<body class="min-h-screen bg-gradient-to-br from-slate-900 to-indigo-900 text-white flex items-center justify-center">
		<div class="w-full max-w-lg mx-4">
			<div class="bg-white/6 backdrop-blur rounded-2xl shadow-xl ring-1 ring-white/10 overflow-hidden">
				<div class="px-8 py-10">
					<div class="flex items-center justify-between mb-6">
						<div>
							<h2 class="text-2xl font-bold">Tambah Akun</h2>
							<p class="mt-1 text-sm text-indigo-100/80">Buat akun baru untuk pengguna Admin.</p>
						</div>
						<a href="{{ route('admin.login') }}" class="text-sm text-indigo-200 hover:underline">Kembali</a>
					</div>

					@if(session('success'))
						<div class="mb-4 text-sm text-green-100 bg-green-900/30 rounded px-4 py-2">{{ session('success') }}</div>
					@endif

					@if(session('error'))
						<div class="mb-4 text-sm text-red-200 bg-red-900/30 rounded px-4 py-2">{{ session('error') }}</div>
					@endif

					<form method="POST" action="{{ url('/admin/usersadd') }}" novalidate>
						@csrf

						<div class="mb-4">
							<label for="name" class="block text-sm font-medium text-indigo-100/80 mb-2">Nama Lengkap</label>
							<input id="name" name="name" type="text" value="{{ old('name') }}" required
								class="w-full px-4 py-2 rounded-lg bg-white/5 border border-white/8 placeholder-indigo-200 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" />
							@error('name')
								<p class="mt-2 text-xs text-red-200">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-4">
							<label for="email" class="block text-sm font-medium text-indigo-100/80 mb-2">Email</label>
							<input id="email" name="email" type="email" value="{{ old('email') }}" required
								class="w-full px-4 py-2 rounded-lg bg-white/5 border border-white/8 placeholder-indigo-200 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" />
							@error('email')
								<p class="mt-2 text-xs text-red-200">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-6">
							<label for="password" class="block text-sm font-medium text-indigo-100/80 mb-2">Password</label>
							<input id="password" name="password" type="password" required
								class="w-full px-4 py-2 rounded-lg bg-white/5 border border-white/8 placeholder-indigo-200 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" />
							@error('password')
								<p class="mt-2 text-xs text-red-200">{{ $message }}</p>
							@enderror
						</div>

						<div class="flex items-center justify-between">
							<button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 px-4 py-2 font-semibold text-white shadow">Buat Akun</button>
							<a href="{{ url('/login/admin') }}" class="text-sm text-indigo-200 hover:underline">Batal</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

