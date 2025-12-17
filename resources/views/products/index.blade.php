<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Oli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <header class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-3 bg-indigo-600 rounded-xl shadow-lg">
                    <i class="fas fa-box text-white w-8 h-8 flex items-center justify-center"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">Produk Oli</h1>
                    <p class="text-slate-600 mt-1">Kelola Data Produk & Stok</p>
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
                                class="absolute right-0 mt-2 w-52 bg-white border rounded-xl shadow-lg hidden z-50">

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

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    {{-- STAT CARD --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow border">
            <p class="text-sm text-slate-500 mb-1">Total Produk</p>
            <p class="text-3xl font-bold text-slate-800">{{ $products->count() }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow border">
            <p class="text-sm text-slate-500 mb-1">Produk Menipis</p>
            <p class="text-3xl font-bold text-orange-600">
                {{ $products->filter(fn($p) => $p->isStokMenipis())->count() }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow border">
            <p class="text-sm text-slate-500 mb-1">Total Stok</p>
            <p class="text-3xl font-bold text-emerald-600">
                {{ $products->sum('stok') }}
            </p>
        </div>
    </div>

    {{-- FORM TAMBAH PRODUK --}}
    <div class="bg-white rounded-2xl shadow-lg border p-6 mb-10">
        <h2 class="text-xl font-bold text-slate-800 mb-4">
            <i class="fas fa-plus-circle text-blue-600 mr-2"></i>
            Tambah Produk
        </h2>

        <form method="POST" action="/products" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf

            <input type="text" name="kode_barang" placeholder="Kode Oli"
                   class="border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200" required>

            <input type="text" name="nama_barang" placeholder="Nama Oli"
                   class="border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200" required>

            <select name="category_id" required
                    class="border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                @endforeach
            </select>

            <input type="number" name="stok_minimum" placeholder="Stok Minimum"
                   class="border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200" required>

            <input type="number" name="harga_beli" placeholder="Harga Beli"
                   class="border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200" required>

            <input type="number" name="harga_jual" placeholder="Harga Jual"
                   class="border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200" required>

            <div class="md:col-span-3">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl shadow">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>

    {{-- TABEL PRODUK --}}
    <div class="bg-white rounded-2xl shadow-lg border overflow-hidden">
        <div class="bg-slate-100 px-6 py-4 font-bold text-slate-700">
            Daftar Produk
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b">
                    <tr class="text-sm text-slate-600">
                        <th class="px-6 py-3 text-left">Kode</th>
                        <th class="px-6 py-3 text-left">Nama</th>
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3 text-center">Stok</th>
                        <th class="px-6 py-3 text-center">Min</th>
                        <th class="px-6 py-3 text-center">Status</th>
                        <th class="px-6 py-3 text-right">Harga Beli</th>
                        <th class="px-6 py-3 text-right">Harga Jual</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                @foreach($products as $p)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-mono">{{ $p->kode_barang }}</td>
                        <td class="px-6 py-4 font-medium">{{ $p->nama_barang }}</td>
                        <td class="px-6 py-4 text-center">{{ $p->category->nama_kategori ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">{{ $p->stok }}</td>
                        <td class="px-6 py-4 text-center">{{ $p->stok_minimum }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($p->isStokMenipis())
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-700">
                                    ⚠ Menipis
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                    Aman
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            Rp {{ number_format($p->harga_beli, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            Rp {{ number_format($p->harga_jual, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>