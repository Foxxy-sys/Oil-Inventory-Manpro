<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | Inventory Oli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100 flex items-center justify-center">

<div class="w-full max-w-md">

    <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">

        <div class="bg-gradient-to-r from-emerald-600 to-green-600 px-6 py-5">
            <div class="flex items-center gap-3">
                <div class="bg-white/20 p-3 rounded-xl">
                    <i class="fas fa-user-plus text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">Register</h1>
                    <p class="text-sm text-white/90">Buat akun baru</p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <form method="POST" action="/register" class="space-y-4">
                @csrf

                <input name="nama" placeholder="Nama"
                    class="w-full border rounded-xl px-4 py-2" required>

                <input type="email" name="email" placeholder="Email"
                    class="w-full border rounded-xl px-4 py-2" required>

                <select name="role" required
                    class="w-full border rounded-xl px-4 py-2">
                    <option value="admin">Admin</option>
                </select>

                <input type="password" name="password" placeholder="Password"
                    class="w-full border rounded-xl px-4 py-2" required>

                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                    class="w-full border rounded-xl px-4 py-2" required>

                <button class="w-full bg-emerald-600 text-white py-2 rounded-xl hover:bg-emerald-700">
                    Register
                </button>
            </form>

            <p class="text-center text-sm mt-4">
                Sudah punya akun?
                <a href="/login" class="text-blue-600 font-semibold">Login</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>