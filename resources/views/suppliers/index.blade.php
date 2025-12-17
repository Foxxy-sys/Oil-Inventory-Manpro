<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier | Inventory Oli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <header class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-3 bg-orange-500 rounded-xl shadow-lg">
                    <i class="fas fa-truck text-white w-8 h-8 flex items-center justify-center"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">Supplier</h1>
                    <p class="text-slate-600 mt-1">Daftar supplier oli</p>
                </div>
            </div>
        </header>

        <!-- Navbar -->
        <nav class="relative z-50 bg-white shadow-md border border-slate-200 mb-6 rounded-2xl overflow-visible">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex justify-between items-center h-16">

                    <!-- LEFT: MENU -->
                    <div class="hidden md:flex items-center gap-4 text-sm font-semibold">

                        <a href="/dashboard"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl 
                                text-slate-600
                                hover:bg-blue-600 hover:text-white
                                transition">
                            <i class="fas fa-chart-line"></i>
                            Dashboard
                        </a>

                        <!-- PRODUK (WARNA BEDA) -->
                        <a href="/products"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl
                                text-slate-600
                                hover:bg-indigo-600 hover:text-white
                                transition">
                            <i class="fas fa-box"></i>
                            Produk
                        </a>

                        <a href="/barang-masuk"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl
                                text-slate-600
                                hover:bg-emerald-600 hover:text-white
                                transition">
                            <i class="fas fa-arrow-down"></i>
                            Barang Masuk
                        </a>

                        <a href="/barang-keluar"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl
                                text-slate-600
                                hover:bg-red-600 hover:text-white
                                transition">
                            <i class="fas fa-arrow-up"></i>
                            Barang Keluar
                        </a>

                        <a href="/categories"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl
                                text-slate-600
                                hover:bg-purple-600 hover:text-white
                                transition">
                            <i class="fas fa-tags"></i>
                            Kategori
                        </a>

                        <a href="/suppliers"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl
                                text-slate-600
                                hover:bg-orange-600 hover:text-white
                                transition">
                            <i class="fas fa-truck"></i>
                            Supplier
                        </a>
                    </div>

                    <div class="flex items-center gap-4 relative">
                        @auth
                            <!-- Dropdown Profil -->
                            <div class="relative">
                                <button
                                    class="flex items-center gap-2 bg-slate-100 px-4 py-2 rounded-xl hover:bg-slate-200 transition focus:outline-none"
                                    onclick="this.nextElementSibling.classList.toggle('hidden')">
                                    <i class="fas fa-user-circle"></i>
                                    {{ auth()->user()->nama }}
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>

                                <!-- Dropdown -->
                                <div
                                    class="absolute right-0 mt-2 w-48 bg-white border rounded-xl shadow-lg hidden z-50">

                                    <!-- Nama dan Role -->
                                    <div class="px-4 py-2 border-b">
                                        <p class="font-semibold">{{ auth()->user()->nama }}</p>
                                        <p class="text-sm text-slate-500">Role: {{ ucfirst(auth()->user()->role) }}</p>
                                    </div>

                                    <form method="POST" action="/logout">
                                        @csrf
                                        <button
                                            class="w-full text-left flex items-center gap-2 px-4 py-2
                                                hover:bg-red-50 text-red-600">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="/login"
                            class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
                                Login
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-xl">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Card Tabel Supplier -->
        <div class="bg-white rounded-2xl shadow-lg border overflow-hidden">
            <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-5">
                <h2 class="text-xl font-bold text-white">Daftar Supplier</h2>
                <p class="text-white/90 text-sm">Semua supplier yang bekerja sama</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 font-semibold text-slate-700">Nama</th>
                            <th class="px-4 py-3 font-semibold text-slate-700">Alamat</th>
                            <th class="px-4 py-3 font-semibold text-slate-700">Telepon</th>
                            <th class="px-4 py-3 font-semibold text-slate-700">Email</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($suppliers as $s)
                            <tr class="hover:bg-slate-50 transition-colors duration-150">
                                <td class="px-4 py-3 text-slate-700">{{ $s->nama_supplier }}</td>
                                <td class="px-4 py-3 text-slate-700">{{ $s->alamat }}</td>
                                <td class="px-4 py-3 text-slate-700">{{ $s->kontak }}</td>
                                <td class="px-4 py-3 text-slate-700">{{ $s->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-slate-500">
                                    Belum ada supplier.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tombol Tambah Supplier -->
        <div class="mt-6 flex justify-end">
            <a href="{{ route('suppliers.create') }}"
               class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-xl shadow transition flex items-center gap-2">
                <i class="fas fa-plus"></i> Tambah Supplier
            </a>
        </div>

    </div>
</div>
</body>
</html>