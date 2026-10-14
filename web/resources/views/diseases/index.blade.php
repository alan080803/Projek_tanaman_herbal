@extends('layouts.app')

@section('title', 'Direktori Penyakit & Racikan Herbal')

@section('content')
<!-- Page Header -->
<section class="relative overflow-hidden bg-gradient-to-br from-green-50 via-white to-green-50/30 py-16 lg:py-24">
    <!-- Decorative Elements -->
    <div class="absolute top-10 right-10 w-64 h-64 bg-green-100/30 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-80 h-80 bg-green-50/40 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm border border-green-100 mb-6">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="text-sm font-semibold text-gray-700">Pengobatan Tradisional</span>
            </div>
            
            <!-- Title -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight tracking-tight">
                Direktori Racikan
                <span class="block mt-2 bg-gradient-to-r from-green-600 to-green-500 bg-clip-text text-transparent">
                    Bolaang Mongondow
                </span>
            </h1>
            
            <!-- Subtitle -->
            <p class="text-lg md:text-xl text-gray-600 leading-relaxed font-light">
                15 jenis penyakit umum dengan solusi obat tradisional lengkap dengan panduan pembuatan
            </p>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="bg-white py-8 border-b border-gray-100">
    <div class="container mx-auto px-4 lg:px-8">
        <form method="GET" action="{{ route('diseases.index') }}" class="max-w-3xl mx-auto">
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
                           placeholder="Cari penyakit (contoh: diabetes, hipertensi, batuk)..." 
                           class="w-full pl-12 pr-32 py-4 border-2 border-gray-200 rounded-2xl focus:border-green-500 focus:ring-4 focus:ring-green-500/10 focus:outline-none transition-all duration-200 text-gray-900 placeholder-gray-400">
                    <button type="submit" 
                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-green-600 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-green-700 transition-colors duration-200 shadow-sm">
                        Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Diseases List -->
<section class="py-16 lg:py-20 bg-gradient-to-b from-gray-50/50 to-white">
    <div class="container mx-auto px-4 lg:px-8">
        @if($diseases->isEmpty())
            <!-- Empty State -->
            <div class="max-w-md mx-auto text-center py-16">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Tidak ada penyakit ditemukan</h3>
                <p class="text-gray-600 mb-6">Coba kata kunci lain atau lihat semua penyakit</p>
                <a href="{{ route('diseases.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <span>Lihat Semua Penyakit</span>
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
                @foreach($diseases as $disease)
                <a href="{{ route('diseases.show', $disease->slug) }}" class="group bg-white rounded-2xl shadow-sm overflow-hidden border-2 border-gray-100 hover:border-green-500 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <!-- Image -->
                    <div class="aspect-video bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center relative overflow-hidden">
                        @if($disease->image_path)
                            <img src="{{ asset('storage/' . $disease->image_path) }}" 
                                 alt="{{ $disease->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                 onerror="this.onerror=null; this.parentElement.innerHTML='<svg class=\'w-20 h-20 text-green-300 group-hover:scale-110 transition-transform duration-300\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1.5\' d=\'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4\'></path></svg>';">
                        @else
                            <svg class="w-20 h-20 text-green-300 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Recipe Count Badge -->
                        @if($disease->herbalRecipes->count() > 0)
                            <div class="absolute top-3 right-3 flex items-center gap-1 px-2.5 py-1.5 bg-white/90 backdrop-blur-sm rounded-lg shadow-sm">
                                <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">{{ $disease->herbalRecipes->count() }}</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="p-5">
                        <!-- Title -->
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-1 group-hover:text-green-600 transition-colors">
                            {{ $disease->name }}
                        </h3>
                        
                        <!-- Description -->
                        <p class="text-sm text-gray-600 leading-relaxed line-clamp-2 mb-4">
                            {{ Str::limit($disease->description, 80) }}
                        </p>
                        
                        <!-- Footer -->
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <span class="inline-flex items-center text-xs text-gray-500 font-medium">
                                <svg class="w-4 h-4 mr-1.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ $disease->herbalRecipes->count() }} Racikan
                            </span>
                            <span class="inline-flex items-center text-sm font-semibold text-green-600 group-hover:text-green-700 transition-colors">
                                Detail
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $diseases->links() }}
            </div>
        @endif
    </div>
</section>

<!-- Info Section -->
<section class="py-16 lg:py-20 bg-white">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-3xl shadow-sm border-2 border-gray-100 p-8 lg:p-12">
                <!-- Header -->
                <div class="flex items-start gap-4 mb-8">
                    <div class="flex-shrink-0 w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">Tentang Direktori Racikan Herbal</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Direktori ini menyediakan informasi lengkap mengenai racikan obat tradisional untuk 20 jenis penyakit yang umum diderita masyarakat Indonesia.
                        </p>
                    </div>
                </div>
                
                <!-- Features Grid -->
                <div class="border-t border-gray-100 pt-8">
                    <h3 class="font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Setiap halaman detail penyakit berisi:
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-start gap-4 p-4 bg-green-50/50 rounded-xl">
                            <div class="flex-shrink-0 w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 mb-1">Visualisasi Bahan</p>
                                <p class="text-sm text-gray-600">Foto tanaman herbal yang dibutuhkan</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 bg-green-50/50 rounded-xl">
                            <div class="flex-shrink-0 w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 mb-1">Formulasi & Dosis</p>
                                <p class="text-sm text-gray-600">Takaran yang tepat dan aman</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 bg-green-50/50 rounded-xl">
                            <div class="flex-shrink-0 w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 mb-1">Panduan Pembuatan</p>
                                <p class="text-sm text-gray-600">Langkah demi langkah detail</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 bg-green-50/50 rounded-xl">
                            <div class="flex-shrink-0 w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 mb-1">Informasi Tambahan</p>
                                <p class="text-sm text-gray-600">Durasi, peringatan, efek samping</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Warning Box -->
                <div class="bg-green-50 border-2 border-green-200 rounded-2xl p-6 mt-8">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 mb-2">Perhatian Penting</p>
                            <p class="text-sm text-gray-700 leading-relaxed">
                                Informasi ini bersifat edukatif. Konsultasikan dengan tenaga kesehatan profesional sebelum menggunakan obat herbal, terutama jika sedang mengonsumsi obat medis atau memiliki kondisi kesehatan khusus.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
