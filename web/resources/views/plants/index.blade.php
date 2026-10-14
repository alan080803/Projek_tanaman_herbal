@extends('layouts.app')

@section('title', 'Database Tanaman Herbal')

@section('content')
<!-- Page Header -->
<section class="relative overflow-hidden bg-gradient-to-br from-green-50 via-white to-green-50/30 py-16 lg:py-24">
    <!-- Decorative Elements -->
    <div class="absolute top-10 right-10 w-64 h-64 bg-green-100/30 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-80 h-80 bg-green-50/40 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm border border-green-100 mb-6">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span class="text-sm font-semibold text-gray-700">Database Lengkap</span>
            </div>
            
            <!-- Title -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight tracking-tight">
                Database Tanaman Herbal
                <span class="block mt-2 bg-gradient-to-r from-green-600 to-green-500 bg-clip-text text-transparent">
                    Indonesia
                </span>
            </h1>
            
            <!-- Subtitle -->
            <p class="text-lg md:text-xl text-gray-600 leading-relaxed font-light">
                Koleksi lengkap tanaman herbal dengan informasi detail, karakteristik, dan khasiat kesehatan
            </p>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="bg-white py-8 border-b border-gray-100">
    <div class="container mx-auto px-4">
        <form method="GET" action="{{ route('plants.index') }}" class="max-w-3xl mx-auto">
            <div class="relative">
                <!-- Search Input -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari tanaman (nama, nama lokal, khasiat)..." 
                           class="w-full pl-12 pr-32 py-4 border-2 border-gray-200 rounded-2xl focus:border-green-500 focus:ring-4 focus:ring-green-500/10 focus:outline-none transition-all duration-200 text-gray-900 placeholder-gray-400">
                    <button type="submit" 
                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-green-600 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-green-700 transition-colors duration-200 shadow-sm">
                        Cari
                    </button>
                </div>
            </div>
            
            @if(request('search'))
                <div class="mt-4 text-center">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 rounded-full border border-green-100">
                        <span class="text-sm text-gray-600">Hasil pencarian untuk:</span>
                        <span class="text-sm font-semibold text-gray-900">"{{ request('search') }}"</span>
                        <a href="{{ route('plants.index') }}" class="ml-1 text-green-600 hover:text-green-700 font-medium text-sm transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endif
        </form>
    </div>
</section>

<!-- Plants Grid -->
<section class="py-16 lg:py-20 bg-gradient-to-b from-gray-50/50 to-white">
    <div class="container mx-auto px-4">
        @if($plants->isEmpty())
            <!-- Empty State -->
            <div class="max-w-md mx-auto text-center py-16">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Tidak ada tanaman ditemukan</h3>
                <p class="text-gray-600 mb-6">Coba kata kunci lain atau lihat semua tanaman</p>
                <a href="{{ route('plants.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <span>Lihat Semua Tanaman</span>
                </a>
            </div>
        @else
            <div class="max-w-7xl mx-auto">
                <!-- Count Info -->
                <div class="mb-10 text-center">
                    <div class="inline-flex items-center gap-3 px-6 py-3 bg-white rounded-full shadow-sm border border-gray-100">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="text-gray-600">
                            Menampilkan <span class="font-bold text-gray-900">{{ $plants->count() }}</span> dari 
                            <span class="font-bold text-green-600">{{ $plants->total() }}</span> tanaman herbal
                        </span>
                    </div>
                </div>

                <!-- Plants Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
                    @foreach($plants as $plant)
                    <a href="{{ route('plants.show', $plant->id) }}" 
                       class="group bg-white rounded-2xl shadow-sm overflow-hidden border-2 border-gray-100 hover:border-green-500 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <!-- Image -->
                        <div class="aspect-square bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center overflow-hidden relative">
                            @if($plant->primaryImage)
                                <img src="{{ asset('storage/' . $plant->primaryImage->image_path) }}" 
                                     alt="{{ $plant->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @elseif($plant->image_path)
                                <img src="{{ asset('storage/' . $plant->image_path) }}" 
                                     alt="{{ $plant->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <svg class="w-24 h-24 text-green-300 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                                </svg>
                            @endif
                            
                            <!-- Image Count Badge -->
                            @if($plant->images->count() > 0)
                                <div class="absolute top-3 right-3 flex items-center gap-1 px-2.5 py-1.5 bg-white/90 backdrop-blur-sm rounded-lg shadow-sm">
                                    <svg class="w-3.5 h-3.5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-gray-700">{{ $plant->images->count() }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <div class="p-5">
                            <!-- Title -->
                            <h3 class="text-lg font-bold text-gray-900 mb-1.5 line-clamp-1 group-hover:text-green-600 transition-colors">
                                {{ $plant->name }}
                            </h3>
                            
                            <!-- Local Name -->
                            @if($plant->local_name)
                                <div class="flex items-center gap-1.5 mb-2">
                                    <svg class="w-3.5 h-3.5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-sm text-green-600 font-semibold line-clamp-1">{{ $plant->local_name }}</p>
                                </div>
                            @endif
                            
                            <!-- Scientific Name -->
                            @if($plant->scientific_name)
                                <p class="text-xs text-gray-500 italic mb-3 line-clamp-1">{{ $plant->scientific_name }}</p>
                            @endif
                            
                            <!-- Description -->
                            <p class="text-sm text-gray-600 line-clamp-2 mb-4 leading-relaxed">
                                {{ Str::limit($plant->description, 80) }}
                            </p>
                            
                            <!-- CTA -->
                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <span class="text-sm font-semibold text-green-600 group-hover:text-green-700 transition-colors">
                                    Lihat Detail
                                </span>
                                <svg class="w-5 h-5 text-green-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $plants->links() }}
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Quick Actions -->
<section class="py-16 lg:py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 tracking-tight">Fitur Lainnya</h2>
                <p class="text-gray-600 text-lg font-light">Manfaatkan fitur lain untuk pengalaman yang lebih lengkap</p>
            </div>
            
            <!-- Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <a href="{{ route('detection.index') }}" 
                   class="group bg-white p-8 lg:p-10 rounded-3xl border-2 border-gray-100 hover:border-green-500 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold mb-2 text-gray-900 group-hover:text-green-600 transition-colors">Deteksi Tanaman AI</h3>
                            <p class="text-gray-600 leading-relaxed mb-4">Upload foto tanaman untuk identifikasi otomatis dengan teknologi AI MobileNetV2</p>
                            <span class="inline-flex items-center gap-2 text-green-600 font-semibold text-sm">
                                <span>Coba Sekarang</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('diseases.index') }}" 
                   class="group bg-white p-8 lg:p-10 rounded-3xl border-2 border-gray-100 hover:border-green-500 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold mb-2 text-gray-900 group-hover:text-green-600 transition-colors">Direktori Racikan</h3>
                            <p class="text-gray-600 leading-relaxed mb-4">Temukan resep racikan obat herbal untuk 20 jenis penyakit umum dengan panduan lengkap</p>
                            <span class="inline-flex items-center gap-2 text-green-600 font-semibold text-sm">
                                <span>Jelajahi Resep</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Info Section -->
<section class="py-16 lg:py-20 bg-gradient-to-b from-green-50/50 to-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-sm border-2 border-gray-100 p-8 lg:p-12">
            <div class="flex items-start gap-4 mb-6">
                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Tentang Database Tanaman Herbal</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Database ini berisi koleksi lengkap tanaman herbal Indonesia yang telah digunakan secara turun-temurun 
                        dalam pengobatan tradisional.
                    </p>
                </div>
            </div>
            
            <div class="border-t border-gray-100 pt-6">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Setiap entri tanaman berisi:
                </h3>
                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Nama umum, nama lokal/daerah, dan nama ilmiah (scientific name)</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Deskripsi umum dan karakteristik fisik tanaman</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Khasiat dan manfaat untuk kesehatan</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Catatan penggunaan dan cara pengolahan</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Galeri foto untuk memudahkan identifikasi visual</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
