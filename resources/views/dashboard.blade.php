<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Inventory Oli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Header -->
            <header class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-3 bg-blue-600 rounded-xl shadow-lg">
                        <i class="fas fa-boxes w-8 h-8 text-white" style="width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center;"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800">Dashboard Inventory Oli</h1>
                        <p class="text-slate-600 mt-1">Kelola stok dan keuangan dengan mudah</p>
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

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Produk -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500 opacity-5 rounded-full -mr-16 -mt-16"></div>
                    <div class="flex items-start justify-between relative">
                        <div class="flex-1">
                            <p class="text-slate-600 text-sm font-medium mb-2">Total Produk</p>
                            <p class="text-3xl font-bold text-slate-800">{{ $totalProduk }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-xl">
                            <i class="fas fa-box text-blue-600" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Stok -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500 opacity-5 rounded-full -mr-16 -mt-16"></div>
                    <div class="flex items-start justify-between relative">
                        <div class="flex-1">
                            <p class="text-slate-600 text-sm font-medium mb-2">Total Stok</p>
                            <p class="text-3xl font-bold text-slate-800">
                                {{ $totalStok }}
                                <span class="text-lg font-normal text-slate-500"> unit</span>
                            </p>
                        </div>
                        <div class="bg-emerald-100 p-3 rounded-xl">
                            <i class="fas fa-cubes text-emerald-600" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>

                <!-- Produk Menipis -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500 opacity-5 rounded-full -mr-16 -mt-16"></div>
                    <div class="flex items-start justify-between relative">
                        <div class="flex-1">
                            <p class="text-slate-600 text-sm font-medium mb-2">Produk Menipis</p>
                            <p class="text-3xl font-bold text-orange-600">
                                {{ $produkMenipis->count() }}
                                <span class="text-lg font-normal text-slate-500"> item</span>
                            </p>
                        </div>
                        <div class="bg-orange-100 p-3 rounded-xl">
                            <i class="fas fa-exclamation-triangle text-orange-600" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    @if ($produkMenipis->count())
                        <div class="mt-3 pt-3 border-t border-slate-100">
                            <span class="text-xs font-medium text-orange-600 bg-orange-50 px-2 py-1 rounded-full">
                                Perlu Perhatian
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Laba Bersih -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 {{ $laba >= 0 ? 'bg-green-500' : 'bg-red-500' }} opacity-5 rounded-full -mr-16 -mt-16"></div>
                    <div class="flex items-start justify-between relative">
                        <div class="flex-1">
                            <p class="text-slate-600 text-sm font-medium mb-2">Laba Bersih</p>
                            <p class="text-2xl font-bold {{ $laba >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                Rp {{ number_format($laba, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="{{ $laba >= 0 ? 'bg-green-100' : 'bg-red-100' }} p-3 rounded-xl">
                            <i class="fas {{ $laba >= 0 ? 'fa-arrow-trend-up text-green-600' : 'fa-arrow-trend-down text-red-600' }}" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Finance Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Pemasukan -->
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-5 rounded-full -mr-20 -mt-20"></div>
                    <div class="flex items-start justify-between relative">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="bg-white/20 p-2 rounded-lg">
                                    <i class="fas fa-arrow-trend-up w-5 h-5 text-white" style="font-size: 1.25rem;"></i>
                                </div>
                                <p class="text-white text-sm font-semibold opacity-90">Pemasukan</p>
                            </div>
                            <p class="text-white text-2xl font-bold">
                                Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/20">
                        <p class="text-white/80 text-xs">Bulan ini</p>
                    </div>
                </div>

                <!-- Pengeluaran -->
                <div class="bg-gradient-to-br from-red-500 to-rose-600 rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-5 rounded-full -mr-20 -mt-20"></div>
                    <div class="flex items-start justify-between relative">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="bg-white/20 p-2 rounded-lg">
                                    <i class="fas fa-arrow-trend-down w-5 h-5 text-white" style="font-size: 1.25rem;"></i>
                                </div>
                                <p class="text-white text-sm font-semibold opacity-90">Pengeluaran</p>
                            </div>
                            <p class="text-white text-2xl font-bold">
                                Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/20">
                        <p class="text-white/80 text-xs">Bulan ini</p>
                    </div>
                </div>

                <!-- Laba Bersih Detail -->
                <div class="bg-gradient-to-br {{ $laba >= 0 ? 'from-blue-500 to-cyan-600' : 'from-slate-500 to-slate-600' }} rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-5 rounded-full -mr-20 -mt-20"></div>
                    <div class="flex items-start justify-between relative">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="bg-white/20 p-2 rounded-lg">
                                    <i class="fas fa-wallet w-5 h-5 text-white" style="font-size: 1.25rem;"></i>
                                </div>
                                <p class="text-white text-sm font-semibold opacity-90">Laba Bersih</p>
                            </div>
                            <p class="text-white text-2xl font-bold">
                                Rp {{ number_format($laba, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/20">
                        <p class="text-white/80 text-xs">Bulan ini</p>
                    </div>
                </div>
            </div>

            <!-- Low Stock Table -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div class="bg-white/20 p-2 rounded-lg">
                            <i class="fas fa-bell text-white" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Notifikasi Stok Menipis</h2>
                            <p class="text-white/90 text-sm mt-1">Produk yang perlu segera di-restock</p>
                        </div>
                    </div>
                </div>

                @if ($produkMenipis->count())
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                        Kode
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                        Nama Produk
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                        Stok Saat Ini
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                        Stok Minimum
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($produkMenipis as $product)
                                    <tr class="hover:bg-orange-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-mono font-semibold text-slate-900">
                                                {{ $product->kode_barang }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm font-medium text-slate-800">
                                                {{ $product->nama_barang }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-700">
                                                {{ $product->stok }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-sm font-medium bg-slate-100 text-slate-700">
                                                {{ $product->stok_minimum }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-orange-100 text-orange-700 border border-orange-200">
                                                <i class="fas fa-exclamation-triangle" style="font-size: 0.875rem;"></i>
                                                Stok Menipis
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-4">
                            <i class="fas fa-check-circle text-green-600" style="font-size: 2rem;"></i>
                        </div>
                        <p class="text-lg font-semibold text-green-700">Semua stok aman</p>
                        <p class="text-sm text-slate-600 mt-2">
                            Tidak ada produk yang memerlukan perhatian khusus
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>