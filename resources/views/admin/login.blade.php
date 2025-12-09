<!doctype html>
<html lang="id">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Login Admin — UNP Coding Exam</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
		<script src="https://cdn.tailwindcss.com"></script>
		<style>body{font-family:Inter,system-ui,-apple-system,'Segoe UI',Roboto,Arial}</style>
	</head>
	<body class="min-h-screen bg-gradient-to-br from-neutral-900 via-slate-900 to-indigo-900 text-white flex items-center justify-center">
		<div class="w-full max-w-md mx-4">
			<div class="bg-white/6 backdrop-blur rounded-2xl shadow-xl ring-1 ring-white/10 overflow-hidden">
				<div class="px-8 py-10">
					<div class="text-center mb-6">
						<h2 class="text-2xl font-bold">Login Admin</h2>
						<p class="mt-2 text-sm text-indigo-100/70">Masukkan email dan password untuk mengakses panel admin.</p>
					</div>

					@if(session('error'))
						<div class="mb-4 text-sm text-red-200 bg-red-900/30 rounded px-4 py-2">{{ session('error') }}</div>
					@endif

					<form method="POST" action="{{ url('/admin/login') }}">
						@csrf
						<div class="mb-4">
							<label for="email" class="block text-sm font-medium text-indigo-100/80 mb-2">email</label>
							<input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
								class="w-full px-4 py-2 rounded-lg bg-white/5 border border-white/8 placeholder-indigo-200 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" />
							@error('email')
								<p class="mt-2 text-xs text-red-200">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-4">
							<label for="password" class="block text-sm font-medium text-indigo-100/80 mb-2">Password</label>
							<input id="password" name="password" type="password" required
								class="w-full px-4 py-2 rounded-lg bg-white/5 border border-white/8 placeholder-indigo-200 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" />
							@error('password')
								<p class="mt-2 text-xs text-red-200">{{ $message }}</p>
							@enderror
						</div>

						<div class="flex items-center justify-between mb-6">
							<label class="inline-flex items-center text-sm text-indigo-100/80">
								<input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-indigo-400 rounded bg-white/3 mr-2"> Remember me
							</label>
							<a href="/" class="text-sm text-indigo-200 hover:underline">Kembali</a>
						</div>

						<div>
							<button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 px-4 py-2 font-semibold text-white shadow">Masuk</button>
						</div>
					</form>

					<div class="mt-6 text-center text-sm text-indigo-100/60">
						<span>Butuh bantuan? </span><a href="#" class="text-indigo-200 hover:underline">Hubungi admin</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
