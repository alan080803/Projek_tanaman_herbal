@extends('layouts.app')

@section('title', 'Beranda - HerbalBolaangMongondow')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-green-50 via-white to-green-50/30">
    <!-- Subtle decorative circles -->
    <div class="absolute top-20 right-10 w-72 h-72 bg-green-100/30 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 left-10 w-96 h-96 bg-green-50/40 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10 py-20 lg:py-32">
        <div class="max-w-5xl mx-auto">
            <!-- Badge -->
            <div class="flex justify-center mb-8">
                <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-white rounded-full shadow-sm border border-green-100">
                    <span class="flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="text-sm font-medium text-gray-700">Powered by AI Technology</span>
                </div>
            </div>
            
            <!-- Main Heading -->
            <h1 class="text-center text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-gray-900 mb-6 leading-tight tracking-tight">
                Kenali Tanaman Herbal
                <span class="block mt-2 bg-gradient-to-r from-green-600 to-green-500 bg-clip-text text-transparent">
                    dengan Teknologi AI
                </span>
            </h1>
            
            <!-- Subtitle -->
            <p class="text-center text-lg md:text-xl lg:text-2xl text-gray-600 mb-12 leading-relaxed max-w-3xl mx-auto font-light">
                Sistem berbasis web untuk membantu mengenali 13 jenis tanaman herbal dan menyediakan informasi pengobatan tradisional Suku Bolaang Mongondow
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('detection.index') }}" class="group inline-flex items-center justify-center gap-3 px-8 py-4 bg-green-600 text-white rounded-2xl font-semibold text-base shadow-lg shadow-green-600/20 hover:bg-green-700 hover:shadow-xl hover:shadow-green-600/30 transition-all duration-300 hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span>Deteksi Tanaman Sekarang</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('diseases.index') }}" class="group inline-flex items-center justify-center gap-3 px-8 py-4 bg-white text-gray-700 rounded-2xl font-semibold text-base border-2 border-gray-200 hover:border-green-600 hover:text-green-600 transition-all duration-300 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span>Jelajahi Direktori Racikan</span>
                </a>
            </div>
            
            <!-- Stats -->
            <div class="mt-16 grid grid-cols-3 gap-8 max-w-3xl mx-auto">
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-green-600 mb-2">{{ $totalPlants }}+</div>
                    <div class="text-sm md:text-base text-gray-600 font-medium">Tanaman Herbal</div>
                </div>
                <div class="text-center border-x border-gray-200">
                    <div class="text-3xl md:text-4xl font-bold text-green-600 mb-2">{{ $totalDiseases }}+</div>
                    <div class="text-sm md:text-base text-gray-600 font-medium">Penyakit Teratasi</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-green-600 mb-2">{{ $totalDetections }}+</div>
                    <div class="text-sm md:text-base text-gray-600 font-medium">Total Deteksi</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-24 bg-white relative">
    <div class="container mx-auto px-4 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-20">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green-600 rounded-full text-sm font-semibold mb-6">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span>Fitur Unggulan</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 tracking-tight">
                Solusi Kesehatan Herbal Modern
            </h2>
            <p class="text-gray-600 text-lg md:text-xl max-w-2xl mx-auto font-light">
                Gabungan teknologi AI dan pengetahuan tradisional untuk kesehatan keluarga Anda
            </p>
        </div>
        
        <!-- Features Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
            <!-- Feature 1: Deteksi AI -->
            <div class="group relative bg-white rounded-3xl p-8 lg:p-10 border-2 border-gray-100 hover:border-green-200 shadow-sm hover:shadow-xl transition-all duration-300">
                <!-- Icon -->
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                
                <!-- Title -->
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Deteksi & Identifikasi AI</h3>
                <p class="text-green-600 text-sm font-semibold mb-4">Powered by MobileNetV2</p>
                
                <!-- Description -->
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Upload foto tanaman herbal yang Anda temukan, sistem akan mengidentifikasi menggunakan teknologi Deep Learning dengan akurasi tinggi dan memberikan informasi lengkap.
                </p>
                
                <!-- Features List -->
                <div class="space-y-4 mb-8">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center mt-0.5">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium">Identifikasi instan dengan foto</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center mt-0.5">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium">Informasi nama lokal & ilmiah</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center mt-0.5">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium">Karakteristik & khasiat lengkap</span>
                    </div>
                </div>
                
                <!-- CTA Button -->
                <a href="{{ route('detection.index') }}" class="group/btn inline-flex items-center gap-2 px-6 py-3.5 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 shadow-lg shadow-green-600/20 hover:shadow-xl hover:shadow-green-600/30 transition-all duration-300">
                    <span>Coba Deteksi</span>
                    <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            <!-- Feature 2: Direktori Racikan -->
            <div class="group relative bg-white rounded-3xl p-8 lg:p-10 border-2 border-gray-100 hover:border-green-200 shadow-sm hover:shadow-xl transition-all duration-300">
                <!-- Icon -->
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                
                <!-- Title -->
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Direktori Racikan Herbal</h3>
                <p class="text-green-600 text-sm font-semibold mb-4">15+ Resep Tradisional</p>
                
                <!-- Description -->
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Temukan resep racikan obat tradisional untuk berbagai jenis penyakit umum, lengkap dengan foto bahan, takaran dosis, dan panduan pembuatan yang detail.
                </p>
                
                <!-- Features List -->
                <div class="space-y-4 mb-8">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center mt-0.5">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium">Berbagai jenis penyakit umum</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center mt-0.5">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium">Visualisasi bahan & takaran</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center mt-0.5">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium">Panduan pembuatan step-by-step</span>
                    </div>
                </div>
                
                <!-- CTA Button -->
                <a href="{{ route('diseases.index') }}" class="group/btn inline-flex items-center gap-2 px-6 py-3.5 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 shadow-lg shadow-green-600/20 hover:shadow-xl hover:shadow-green-600/30 transition-all duration-300">
                    <span>Lihat Direktori</span>
                    <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-24 bg-gradient-to-b from-gray-50/50 via-white to-white relative overflow-hidden">
    <!-- Decorative background -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-64 bg-green-50/40 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-20">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white text-green-600 rounded-full text-sm font-semibold mb-6 shadow-sm border border-green-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <span>Cara Kerja</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 tracking-tight">
                Mudah, Cepat, dan Akurat
            </h2>
            <p class="text-gray-600 text-lg md:text-xl max-w-2xl mx-auto font-light">
                Tiga langkah sederhana untuk mendapatkan informasi lengkap tentang tanaman herbal
            </p>
        </div>
        
        <!-- Steps Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-16 max-w-6xl mx-auto">
            <!-- Step 1 -->
            <div class="relative group">
                <!-- Connector Line (desktop only) -->
                <div class="hidden md:block absolute top-16 left-1/2 w-full h-0.5 z-0">
                    <div class="w-full h-full bg-gradient-to-r from-green-500 via-green-400 to-green-300"></div>
                </div>
                
                <!-- Content -->
                <div class="relative z-10 text-center">
                    <!-- Icon Badge -->
                    <div class="relative inline-flex items-center justify-center mb-8">
                        <div class="absolute inset-0 bg-green-500 rounded-3xl blur-2xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-green-500 to-green-600 text-white w-32 h-32 rounded-3xl flex items-center justify-center shadow-xl shadow-green-500/30 group-hover:scale-105 transition-transform duration-300">
                            <div class="text-center">
                                <div class="text-4xl font-bold mb-1">01</div>
                                <div class="text-xs font-medium text-green-100">Step</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Title & Description -->
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">Upload Foto</h3>
                    <p class="text-gray-600 leading-relaxed max-w-xs mx-auto">
                        Ambil foto tanaman herbal yang ingin Anda ketahui atau pilih dari galeri perangkat Anda
                    </p>
                </div>
            </div>
            
            <!-- Step 2 -->
            <div class="relative group">
                <!-- Connector Line (desktop only) -->
                <div class="hidden md:block absolute top-16 left-1/2 w-full h-0.5 z-0">
                    <div class="w-full h-full bg-gradient-to-r from-green-400 via-green-300 to-green-200"></div>
                </div>
                
                <!-- Content -->
                <div class="relative z-10 text-center">
                    <!-- Icon Badge -->
                    <div class="relative inline-flex items-center justify-center mb-8">
                        <div class="absolute inset-0 bg-green-500 rounded-3xl blur-2xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-green-500 to-green-600 text-white w-32 h-32 rounded-3xl flex items-center justify-center shadow-xl shadow-green-500/30 group-hover:scale-105 transition-transform duration-300">
                            <div class="text-center">
                                <div class="text-4xl font-bold mb-1">02</div>
                                <div class="text-xs font-medium text-green-100">Step</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Title & Description -->
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">AI Menganalisis</h3>
                    <p class="text-gray-600 leading-relaxed max-w-xs mx-auto">
                        Verifikasi daun dan klasifikasi jenis tanaman herbal secara otomatis dan akurat
                    </p>
                </div>
            </div>
            
            <!-- Step 3 -->
            <div class="relative group">
                <!-- Content -->
                <div class="relative z-10 text-center">
                    <!-- Icon Badge -->
                    <div class="relative inline-flex items-center justify-center mb-8">
                        <div class="absolute inset-0 bg-green-500 rounded-3xl blur-2xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-green-500 to-green-600 text-white w-32 h-32 rounded-3xl flex items-center justify-center shadow-xl shadow-green-500/30 group-hover:scale-105 transition-transform duration-300">
                            <div class="text-center">
                                <div class="text-4xl font-bold mb-1">03</div>
                                <div class="text-xs font-medium text-green-100">Step</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Title & Description -->
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">Dapatkan Info</h3>
                    <p class="text-gray-600 leading-relaxed max-w-xs mx-auto">
                        Lihat informasi lengkap: nama, karakteristik, khasiat, dan cara pengolahan tanaman
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Bottom CTA -->
        <div class="text-center mt-16">
            <a href="{{ route('detection.index') }}" class="inline-flex items-center gap-2 text-green-600 font-semibold hover:text-green-700 group transition-colors">
                <span>Mulai Deteksi Sekarang</span>
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Popular Diseases -->
<section class="py-24 bg-white relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-green-50/30 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-green-50/20 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end mb-16 gap-6">
            <div class="max-w-xl">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green-600 rounded-full text-sm font-semibold mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Penyakit Umum</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 tracking-tight">
                    Solusi Herbal untuk Berbagai Penyakit
                </h2>
                <p class="text-gray-600 text-lg font-light">
                    Temukan resep racikan tradisional yang telah terbukti untuk mengatasi berbagai keluhan kesehatan
                </p>
            </div>
            <a href="{{ route('diseases.index') }}" class="group inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 shadow-lg shadow-green-600/20 transition-all duration-300 hover:shadow-xl hover:shadow-green-600/30 whitespace-nowrap">
                <span>Lihat Semua</span>
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
        
        <!-- Diseases Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach($featuredDiseases as $disease)
            <a href="{{ route('diseases.show', $disease->slug) }}" class="group bg-white rounded-2xl p-6 text-center border-2 border-gray-100 hover:border-green-500 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <!-- Image -->
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl mb-4 overflow-hidden group-hover:scale-110 transition-transform duration-300">
                    @if($disease->image_path)
                        <img src="{{ asset('storage/' . $disease->image_path) }}" 
                             alt="{{ $disease->name }}" 
                             class="w-full h-full object-cover"
                             onerror="this.onerror=null; this.parentElement.innerHTML='<svg class=\'w-8 h-8 text-green-600\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z\'></path></svg>';">
                    @else
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    @endif
                </div>
                <!-- Disease Name -->
                <h3 class="font-bold text-gray-900 group-hover:text-green-600 transition-colors text-base lg:text-lg">
                    {{ $disease->name }}
                </h3>
                <!-- Hover Indicator -->
                <div class="mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span class="text-xs text-green-600 font-medium">Lihat Resep →</span>
                </div>
            </a>
            @endforeach
        </div>
        
        <!-- Additional Info -->
        <div class="mt-12 text-center">
            <p class="text-gray-500 text-sm">
                <span class="font-semibold text-gray-700">15+ resep racikan tradisional</span> tersedia dengan panduan lengkap
            </p>
        </div>
    </div>
</section>

<!-- Featured Plants Section -->
<section class="py-20 lg:py-28 bg-gradient-to-b from-white to-gray-50">
    <div class="container mx-auto px-4 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 rounded-full text-sm font-semibold text-green-700 mb-6">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                </svg>
                <span>Database Tanaman</span>
            </div>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                Tanaman Herbal <span class="text-green-600">Populer</span>
            </h2>
            <p class="text-lg text-gray-600 leading-relaxed">
                Kenali tanaman herbal Indonesia dengan informasi lengkap tentang manfaat, cara pengolahan, dan racikan tradisional
            </p>
        </div>
        
        <!-- Plants Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach($featuredPlants as $plant)
            <a href="{{ route('plants.show', $plant->id) }}" class="group bg-white rounded-2xl overflow-hidden border-2 border-gray-100 hover:border-green-500 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <!-- Plant Image -->
                <div class="relative h-56 bg-gradient-to-br from-green-50 to-green-100 overflow-hidden">
                    @if($plant->primaryImage)
                        <img src="{{ asset('storage/' . $plant->primaryImage->image_path) }}" 
                             alt="{{ $plant->name }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'flex items-center justify-center h-full\'><svg class=\'w-20 h-20 text-green-600 opacity-40\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg></div>';">
                    @elseif($plant->image_path)
                        <img src="{{ asset('storage/' . $plant->image_path) }}" 
                             alt="{{ $plant->name }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'flex items-center justify-center h-full\'><svg class=\'w-20 h-20 text-green-600 opacity-40\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg></div>';">
                    @elseif($plant->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $plant->images->first()->image_path) }}" 
                             alt="{{ $plant->name }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'flex items-center justify-center h-full\'><svg class=\'w-20 h-20 text-green-600 opacity-40\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg></div>';">
                    @else
                        <div class="flex items-center justify-center h-full">
                            <svg class="w-20 h-20 text-green-600 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <!-- Active Badge -->
                    @if($plant->is_active)
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-full shadow-lg">
                            Aktif
                        </span>
                    </div>
                    @endif
                </div>
                <!-- Plant Info -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">
                        {{ $plant->name }}
                    </h3>
                    @if($plant->scientific_name)
                    <p class="text-sm text-gray-500 italic mb-3">{{ $plant->scientific_name }}</p>
                    @endif
                    <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                        {{ Str::limit($plant->description, 100) }}
                    </p>
                    <!-- View Details -->
                    <div class="flex items-center gap-2 text-green-600 font-semibold text-sm group-hover:gap-3 transition-all">
                        <span>Lihat Detail</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        
        <!-- View All Link -->
        <div class="mt-12 text-center">
            <a href="{{ route('plants.index') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-white text-gray-700 rounded-2xl font-semibold text-base border-2 border-gray-200 hover:border-green-600 hover:text-green-600 transition-all duration-300 shadow-sm hover:shadow-md">
                <span>Jelajahi Semua Tanaman</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="relative py-24 lg:py-32 overflow-hidden">
    <!-- Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-green-600 via-green-500 to-green-600"></div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full">
        <div class="absolute top-20 right-20 w-2 h-2 bg-white/30 rounded-full"></div>
        <div class="absolute top-40 right-40 w-1 h-1 bg-white/20 rounded-full"></div>
        <div class="absolute bottom-20 left-20 w-2 h-2 bg-white/25 rounded-full"></div>
        <div class="absolute bottom-32 left-40 w-1 h-1 bg-white/20 rounded-full"></div>
    </div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 backdrop-blur-sm rounded-full text-sm font-medium text-white mb-8 border border-white/20">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                </svg>
                <span>Gratis & Mudah Digunakan</span>
            </div>
            
            <!-- Main Heading -->
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight tracking-tight">
                Mulai Perjalanan Kesehatan
                <span class="block mt-2">Herbal Anda Sekarang</span>
            </h2>
            
            <!-- Description -->
            <p class="text-xl md:text-2xl mb-12 text-white/90 leading-relaxed max-w-2xl mx-auto font-light">
                Platform gratis untuk semua kalangan. Dapatkan manfaat pengobatan tradisional Indonesia dengan teknologi modern.
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                <a href="{{ route('detection.index') }}" class="group inline-flex items-center justify-center gap-3 px-8 py-4 bg-white text-green-600 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Deteksi Tanaman Sekarang</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('plants.index') }}" class="group inline-flex items-center justify-center gap-3 px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-2xl font-bold text-lg border-2 border-white/30 hover:bg-white/20 hover:border-white/50 transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <span>Jelajahi Database</span>
                </a>
            </div>
            
            <!-- Features List -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-3xl mx-auto">
                <div class="flex flex-col items-center gap-3 p-4">
                    <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div class="text-center">
                        <div class="font-semibold text-white mb-1">100% Gratis</div>
                        <div class="text-sm text-white/70">Tidak ada biaya tersembunyi</div>
                    </div>
                </div>
                <div class="flex flex-col items-center gap-3 p-4">
                    <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div class="text-center">
                        <div class="font-semibold text-white mb-1">Cepat & Akurat</div>
                        <div class="text-sm text-white/70">Hasil dalam hitungan detik</div>
                    </div>
                </div>
                <div class="flex flex-col items-center gap-3 p-4">
                    <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div class="text-center">
                        <div class="font-semibold text-white mb-1">Terpercaya</div>
                        <div class="text-sm text-white/70">Informasi terverifikasi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
