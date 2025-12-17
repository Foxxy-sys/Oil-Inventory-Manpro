<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Masuk | Inventory Oli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <header class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-3 bg-emerald-600 rounded-xl shadow-lg">
                    <i class="fas fa-arrow-down text-white w-8 h-8 flex items-center justify-center"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">Barang Masuk</h1>
                    <p class="text-slate-600 mt-1">Restock & pembelian oli</p>
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

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-xl">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Card Form -->
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-500 to-green-600 px-6 py-5">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 p-2 rounded-lg">
                        <i class="fas fa-box-open text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Form Barang Masuk</h2>
                        <p class="text-white/90 text-sm">Tambahkan stok oli</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <form method="POST" action="/barang-masuk" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf

                    <!-- Produk -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Produk Oli
                        </label>
                        <select name="product_id" required
                                class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring focus:ring-emerald-200">
                            <option value="">-- Pilih Produk --</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}">
                                    {{ $p->kode_barang }} - {{ $p->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jumlah -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Jumlah Masuk
                        </label>
                        <input type="number" name="jumlah" min="1" required
                               class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring focus:ring-emerald-200"
                               placeholder="Contoh: 20">
                    </div>

                    <!-- Harga Beli -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Harga Beli / Unit
                        </label>
                        <input type="number" name="harga_beli" min="0" required
                               class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring focus:ring-emerald-200"
                               placeholder="Contoh: 40000">
                    </div>

                    <!-- Tombol -->
                    <div class="md:col-span-2 flex gap-3 mt-2">
                        <button type="submit"
                                class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-xl shadow transition">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Barang Masuk
                        </button>

                        <a href="/dashboard"
                           class="px-6 py-2 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 transition">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- TABEL BARANG MASUK --}}
        <div class="bg-white rounded-2xl shadow-lg border overflow-hidden mt-8">
            <div class="bg-slate-100 px-6 py-4 font-bold text-slate-700">
                Daftar Barang Masuk
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 border-b">
                        <tr>
                            <th class="px-4 py-2">Supplier</th>
                            <th class="px-4 py-2">Kode Barang</th>
                            <th class="px-4 py-2">Nama Barang</th>
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2 text-center">Jumlah</th>
                            <th class="px-4 py-2 text-left">Harga Beli</th>
                            <th class="px-4 py-2 text-left">Total</th>
                            <th class="px-4 py-2">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($barang_masuk as $bm)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-2">{{ $bm->supplier->nama_supplier }}</td>
                                <td class="px-4 py-2">{{ $bm->products->kode_barang }}</td>
                                <td class="px-4 py-2">{{ $bm->products->nama_barang }}</td>
                                <td class="px-4 py-2">{{ $bm->user->nama ?? 'Admin'}}</td>
                                <td class="px-4 py-2 text-center">{{ $bm->jumlah }}</td>
                                <td class="px-4 py-2 text-left">Rp {{ number_format($bm->harga_beli,0,',','.') }}</td>
                                <td class="px-4 py-2 text-left">Rp {{ number_format($bm->total,0,',','.') }}</td>
                                <td class="px-4 py-2 text-sm text-slate-700">{{ $bm->tanggal->format('d-m-Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
