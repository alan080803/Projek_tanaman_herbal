@extends('layouts.admin')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview dan statistik aplikasi')

@section('content')
<!-- Decorative Background Elements -->
<div class="fixed top-20 right-20 w-96 h-96 bg-green-100/20 rounded-full blur-3xl pointer-events-none -z-10"></div>
<div class="fixed bottom-20 left-20 w-80 h-80 bg-green-100/20 rounded-full blur-3xl pointer-events-none -z-10"></div>

<!-- Welcome Banner -->
<div class="bg-gradient-to-br from-green-500 to-green-600 rounded-3xl shadow-xl shadow-green-500/20 p-8 mb-8 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
    <div class="relative z-10">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="text-3xl font-bold text-white mb-2">Selamat Datang Kembali, {{ auth()->user()->name }}! 👋</h2>
                <p class="text-green-50 text-lg font-medium">Kelola data tanaman herbal dan pantau aktivitas deteksi</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="bg-white/20 backdrop-blur-sm rounded-2xl px-6 py-4 border border-white/30">
                    <p class="text-green-50 text-sm font-semibold mb-1">Hari Ini</p>
                    <p class="text-white text-2xl font-bold">{{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Penyakit -->
    <div class="group bg-white rounded-3xl shadow-lg shadow-green-500/5 border-2 border-gray-100 p-7 hover:shadow-xl hover:shadow-green-500/10 hover:border-green-200 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-50 to-transparent rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <p class="text-sm font-bold text-gray-600 uppercase tracking-wide">Total Penyakit</p>
                </div>
                <p class="text-5xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">{{ $totalDiseases }}</p>
                <p class="text-sm text-gray-500 font-medium">Jenis penyakit terdaftar</p>
            </div>
            <div class="flex-shrink-0 w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg shadow-green-500/30 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Tanaman -->
    <div class="group bg-white rounded-3xl shadow-lg shadow-green-500/5 border-2 border-gray-100 p-7 hover:shadow-xl hover:shadow-green-500/10 hover:border-green-200 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-50 to-transparent rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <p class="text-sm font-bold text-gray-600 uppercase tracking-wide">Total Tanaman</p>
                </div>
                <p class="text-5xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">{{ $totalPlants }}</p>
                <p class="text-sm text-gray-500 font-medium">Tanaman herbal terdaftar</p>
            </div>
            <div class="flex-shrink-0 w-20 h-20 bg-gradient-to-br from-green-600 to-green-700 rounded-2xl flex items-center justify-center shadow-lg shadow-green-500/30 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Racikan -->
    <div class="group bg-white rounded-3xl shadow-lg shadow-green-500/5 border-2 border-gray-100 p-7 hover:shadow-xl hover:shadow-green-500/10 hover:border-green-200 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-50 to-transparent rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <p class="text-sm font-bold text-gray-600 uppercase tracking-wide">Total Racikan</p>
                </div>
                <p class="text-5xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">{{ $totalRecipes }}</p>
                <p class="text-sm text-gray-500 font-medium">Resep obat herbal</p>
            </div>
            <div class="flex-shrink-0 w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg shadow-green-500/30 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Deteksi -->
    <div class="group bg-white rounded-3xl shadow-lg shadow-green-500/5 border-2 border-gray-100 p-7 hover:shadow-xl hover:shadow-green-500/10 hover:border-green-200 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-50 to-transparent rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <p class="text-sm font-bold text-gray-600 uppercase tracking-wide">Total Deteksi</p>
                </div>
                <p class="text-5xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">{{ $totalDetections }}</p>
                <p class="text-sm text-gray-500 font-medium">Deteksi dilakukan</p>
            </div>
            <div class="flex-shrink-0 w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg shadow-green-500/30 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Detection Statistics Row -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Success Detection -->
    <div class="group bg-gradient-to-br from-green-500 to-green-600 rounded-3xl p-8 shadow-xl shadow-green-500/20 hover:shadow-2xl hover:shadow-green-500/30 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-white rounded-full animate-pulse"></div>
                    <p class="text-sm font-bold text-green-50 uppercase tracking-wide">Status</p>
                </div>
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/30 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-5xl font-bold text-white mb-2">{{ $successfulDetections }}</p>
            <p class="text-green-100 text-base font-semibold">Deteksi Berhasil</p>
        </div>
    </div>

    <!-- Pending Detection -->
    <div class="group bg-gradient-to-br from-slate-500 to-slate-600 rounded-3xl p-8 shadow-xl shadow-slate-500/20 hover:shadow-2xl hover:shadow-slate-500/30 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-white rounded-full animate-pulse"></div>
                    <p class="text-sm font-bold text-slate-50 uppercase tracking-wide">Status</p>
                </div>
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/30 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-5xl font-bold text-white mb-2">{{ $pendingDetections }}</p>
            <p class="text-slate-100 text-base font-semibold">Deteksi Pending</p>
        </div>
    </div>

    <!-- Failed Detection -->
    <div class="group bg-gradient-to-br from-gray-600 to-gray-700 rounded-3xl p-8 shadow-xl shadow-gray-600/20 hover:shadow-2xl hover:shadow-gray-600/30 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-white rounded-full animate-pulse"></div>
                    <p class="text-sm font-bold text-gray-50 uppercase tracking-wide">Status</p>
                </div>
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/30 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-5xl font-bold text-white mb-2">{{ $failedDetections }}</p>
            <p class="text-gray-100 text-base font-semibold">Deteksi Gagal</p>
        </div>
    </div>
</div>

<!-- Recent Activity Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <!-- Last 7 Days -->
    <div class="group bg-white rounded-3xl shadow-lg border-2 border-gray-100 p-7 hover:shadow-xl hover:border-green-200 transition-all duration-300">
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center shadow-sm border-2 border-green-200 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Minggu Ini</p>
                    <p class="text-sm text-gray-600 mt-0.5">7 Hari Terakhir</p>
                </div>
            </div>
        </div>
        <div class="flex items-end gap-3">
            <p class="text-5xl font-bold text-gray-900">{{ $detectionsLastWeek }}</p>
            <p class="text-lg text-gray-600 mb-2">deteksi</p>
        </div>
        <div class="mt-4 pt-4 border-t-2 border-gray-100">
            <p class="text-xs text-gray-500">Aktivitas deteksi dalam seminggu terakhir</p>
        </div>
    </div>

    <!-- Last 30 Days -->
    <div class="group bg-white rounded-3xl shadow-lg border-2 border-gray-100 p-7 hover:shadow-xl hover:border-green-200 transition-all duration-300">
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center shadow-sm border-2 border-green-200 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Bulan Ini</p>
                    <p class="text-sm text-gray-600 mt-0.5">30 Hari Terakhir</p>
                </div>
            </div>
        </div>
        <div class="flex items-end gap-3">
            <p class="text-5xl font-bold text-gray-900">{{ $detectionsLastMonth }}</p>
            <p class="text-lg text-gray-600 mb-2">deteksi</p>
        </div>
        <div class="mt-4 pt-4 border-t-2 border-gray-100">
            <p class="text-xs text-gray-500">Aktivitas deteksi dalam sebulan terakhir</p>
        </div>
    </div>
</div>

<!-- Quick Actions & Recent Detections -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Quick Actions -->
    <div class="bg-white rounded-3xl shadow-lg border-2 border-gray-100 p-7 hover:shadow-xl hover:border-green-200 transition-all duration-300">
        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span>Quick Actions</span>
        </h3>
        <div class="space-y-3">
            <a href="{{ route('admin.diseases.create') }}" class="group flex items-center p-4 rounded-2xl hover:bg-gradient-to-r hover:from-green-50 hover:to-transparent border-2 border-transparent hover:border-green-200 transition-all duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 group-hover:scale-110 rounded-xl flex items-center justify-center mr-4 transition-all shadow-lg shadow-green-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm group-hover:text-green-600 transition-colors">Tambah Penyakit</p>
                    <p class="text-xs text-gray-500">Daftarkan penyakit baru</p>
                </div>
            </a>

            <a href="{{ route('admin.plants.create') }}" class="group flex items-center p-4 rounded-2xl hover:bg-gradient-to-r hover:from-green-50 hover:to-transparent border-2 border-transparent hover:border-green-200 transition-all duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-green-600 to-green-700 group-hover:scale-110 rounded-xl flex items-center justify-center mr-4 transition-all shadow-lg shadow-green-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm group-hover:text-green-600 transition-colors">Tambah Tanaman</p>
                    <p class="text-xs text-gray-500">Daftarkan tanaman herbal</p>
                </div>
            </a>

            <a href="{{ route('admin.recipes.create') }}" class="group flex items-center p-4 rounded-2xl hover:bg-gradient-to-r hover:from-green-50 hover:to-transparent border-2 border-transparent hover:border-green-200 transition-all duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 group-hover:scale-110 rounded-xl flex items-center justify-center mr-4 transition-all shadow-lg shadow-green-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm group-hover:text-green-600 transition-colors">Tambah Racikan</p>
                    <p class="text-xs text-gray-500">Buat resep obat herbal</p>
                </div>
            </a>

            <a href="{{ route('admin.detections.statistics') }}" class="group flex items-center p-4 rounded-2xl hover:bg-gradient-to-r hover:from-green-50 hover:to-transparent border-2 border-transparent hover:border-green-200 transition-all duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 group-hover:scale-110 rounded-xl flex items-center justify-center mr-4 transition-all shadow-lg shadow-green-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm group-hover:text-green-600 transition-colors">Lihat Statistik</p>
                    <p class="text-xs text-gray-500">Analisis deteksi lengkap</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Detections -->
    <div class="bg-white rounded-3xl shadow-lg border-2 border-gray-100 p-7 lg:col-span-2 hover:shadow-xl hover:border-green-200 transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span>Deteksi Terbaru</span>
            </h3>
            <a href="{{ route('admin.detections.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold text-green-600 bg-green-50 hover:bg-green-100 rounded-xl transition-all duration-200 border-2 border-transparent hover:border-green-200">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        @if($recentDetections->count() > 0)
        <div class="overflow-x-auto rounded-2xl border-2 border-gray-100">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                        <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Tanaman</th>
                        <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Confidence</th>
                        <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @foreach($recentDetections as $detection)
                    <tr class="hover:bg-gradient-to-r hover:from-green-50/50 hover:to-transparent transition-all duration-200 group">
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                @if($detection->plant)
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm group-hover:shadow-md group-hover:scale-105 transition-all">
                                    <span class="text-base font-bold text-white">{{ substr($detection->plant->name, 0, 1) }}</span>
                                </div>
                                <span class="text-sm font-bold text-gray-900 group-hover:text-green-600 transition-colors">{{ $detection->plant->name }}</span>
                                @else
                                <div class="w-12 h-12 bg-gray-200 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-500 italic font-medium">Belum teridentifikasi</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            @if($detection->confidence_score)
                            <div class="inline-flex items-center gap-2">
                                <div class="flex-1">
                                    <div class="w-20 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full" style="width: {{ $detection->confidence_score }}%"></div>
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-gray-900">{{ number_format($detection->confidence_score, 1) }}%</span>
                            </div>
                            @else
                            <span class="text-sm text-gray-400 font-medium">-</span>
                            @endif
                        </td>
                        <td class="py-4 px-4">
                            @if($detection->detection_status === 'success')
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-800 border-2 border-green-200">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Berhasil
                            </span>
                            @elseif($detection->detection_status === 'no_leaf')
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border-2 border-amber-200">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                Tidak Ada Daun
                            </span>
                            @elseif($detection->detection_status === 'pending')
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border-2 border-slate-200">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                Pending
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border-2 border-gray-200">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                Gagal
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-2 text-sm text-gray-600 font-medium">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $detection->created_at->diffForHumans() }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-20 bg-gradient-to-br from-gray-50 to-white rounded-2xl border-2 border-dashed border-gray-200">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl mb-5 shadow-sm">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <p class="text-gray-900 text-base font-bold mb-2">Belum Ada Deteksi</p>
            <p class="text-gray-500 text-sm font-medium mb-6">Deteksi tanaman akan muncul di sini</p>
            <a href="{{ route('admin.detections.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-xl font-semibold text-sm shadow-lg shadow-green-500/20 hover:shadow-xl transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                Lihat Semua Deteksi
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Most Detected Plants -->
@if($mostDetectedPlants->count() > 0)
<div class="bg-white rounded-3xl shadow-lg border-2 border-gray-100 p-7 mt-6 hover:shadow-xl hover:border-green-200 transition-all duration-300">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <span>Tanaman Paling Banyak Terdeteksi</span>
        </h3>
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green-700 rounded-xl border-2 border-green-100 font-bold text-sm">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            Top {{ $mostDetectedPlants->count() }}
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($mostDetectedPlants as $item)
        <div class="group relative bg-gradient-to-br from-gray-50 to-white rounded-2xl border-2 border-gray-100 p-5 hover:shadow-lg hover:border-green-200 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-green-50 to-transparent rounded-bl-3xl opacity-50"></div>
            <div class="relative z-10 flex items-center gap-4">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg shadow-green-500/30 group-hover:scale-110 transition-transform">
                        <span class="text-2xl font-bold text-white">#{{ $loop->iteration }}</span>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-bold text-gray-900 text-base truncate group-hover:text-green-600 transition-colors mb-1">
                        {{ $item->plant->name ?? 'Unknown' }}
                    </p>
                    <p class="text-sm text-gray-500 truncate mb-3">{{ $item->plant->local_name ?? '-' }}</p>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-green-100 rounded-xl border-2 border-green-200">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="text-base font-bold text-green-700">{{ $item->detection_count }}</span>
                        <span class="text-xs text-green-600 font-semibold">deteksi</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection
