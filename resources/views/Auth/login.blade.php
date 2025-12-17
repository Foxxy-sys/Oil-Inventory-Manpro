<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Inventory Oli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100 flex items-center justify-center">

<div class="w-full max-w-md">

    <!-- Card -->
    <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-5">
            <div class="flex items-center gap-3">
                <div class="bg-white/20 p-3 rounded-xl">
                    <i class="fas fa-user-circle text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">Login</h1>
                    <p class="text-sm text-white/90">Masuk ke sistem Inventory Oli</p>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="p-6">

            <!-- Error -->
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <i class="fas fa-circle-exclamation mr-1"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">
                        Email
                    </label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="email" name="email" required autofocus
                            class="w-full border border-slate-300 rounded-xl pl-10 pr-4 py-2
                                   focus:ring focus:ring-blue-200 focus:border-blue-400"
                            placeholder="admin@mail.com">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">
                        Password
                    </label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="password" name="password" required
                            class="w-full border border-slate-300 rounded-xl pl-10 pr-4 py-2
                                   focus:ring focus:ring-blue-200 focus:border-blue-400"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Button -->
                <button
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl
                           shadow-md transition flex items-center justify-center gap-2">
                    <i class="fas fa-right-to-bracket"></i>
                    Login
                </button>
            </form>

            <!-- Register Link -->
            <div class="text-center mt-6 text-sm text-slate-600">
                Belum punya akun?
                <a href="/register" class="text-blue-600 font-semibold hover:underline">
                    Daftar sekarang
                </a>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <p class="text-center text-sm text-slate-500 mt-6">
        © {{ date('Y') }} Inventory Oli
    </p>

</div>

</body>
</html>