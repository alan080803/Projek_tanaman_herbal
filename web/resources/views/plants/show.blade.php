@extends('layouts.app')

@section('title', $plant->name . ' - Detail Tanaman')

@section('content')
<!-- Plant Header -->
<section class="bg-gradient-to-r from-green-600 to-emerald-700 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <nav class="text-sm mb-6 flex items-center gap-2">
                <a href="{{ route('home') }}" class="text-green-100 hover:text-white transition-colors">Beranda</a>
                <svg class="w-4 h-4 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('plants.index') }}" class="text-green-100 hover:text-white transition-colors">Database Tanaman</a>
                <svg class="w-4 h-4 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-white font-medium">{{ $plant->name }}</span>
            </nav>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm font-semibold">Tanaman Herbal Terverifikasi</span>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold mb-4 leading-tight">{{ $plant->name }}</h1>
                    @if($plant->local_name)
                        <p class="text-2xl text-green-100 mb-3 font-medium">{{ $plant->local_name }}</p>
                    @endif
                    @if($plant->scientific_name)
                        <p class="text-lg text-green-200 italic flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            {{ $plant->scientific_name }}
                        </p>
                    @endif
                </div>
                
                <!-- Primary Image -->
                <div class="rounded-2xl overflow-hidden shadow-2xl shadow-green-900/30 border-4 border-white/20">
                    @if($plant->primaryImage)
                        <img src="{{ asset('storage/' . $plant->primaryImage->image_path) }}" 
                             alt="{{ $plant->name }}"
                             class="w-full h-96 object-cover">
                    @elseif($plant->image_path)
                        <img src="{{ asset('storage/' . $plant->image_path) }}" 
                             alt="{{ $plant->name }}"
                             class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-green-700 to-green-900 flex items-center justify-center">
                            <svg class="w-32 h-32 text-green-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Info Column -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Description -->
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-8 hover:shadow-lg transition-all duration-200">
                        <div class="flex items-center gap-3 mb-5 pb-4 border-b-2 border-gray-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Deskripsi Umum</h2>
                        </div>
                        <p class="text-gray-700 leading-relaxed text-lg">{{ $plant->description }}</p>
                    </div>

                    <!-- Characteristics -->
                    @if($plant->characteristics)
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-8 hover:shadow-lg transition-all duration-200">
                        <div class="flex items-center gap-3 mb-5 pb-4 border-b-2 border-gray-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Karakteristik Fisik</h2>
                        </div>
                        <p class="text-gray-700 leading-relaxed text-lg">{{ $plant->characteristics }}</p>
                    </div>
                    @endif

                    <!-- Benefits -->
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-8 hover:shadow-lg transition-all duration-200">
                        <div class="flex items-center gap-3 mb-5 pb-4 border-b-2 border-gray-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Khasiat & Manfaat</h2>
                        </div>
                        <div class="text-gray-700 leading-relaxed text-lg space-y-2">
                            {!! nl2br(e($plant->benefits)) !!}
                        </div>
                    </div>

                    <!-- Usage Notes -->
                    @if($plant->usage_notes)
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-r-2xl p-6 shadow-sm">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900">Catatan Penggunaan</h3>
                        </div>
                        <div class="text-gray-700 leading-relaxed">
                            {!! nl2br(e($plant->usage_notes)) !!}
                        </div>
                    </div>
                    @endif

                    <!-- Image Gallery -->
                    @if($plant->images->count() > 1)
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-8 hover:shadow-lg transition-all duration-200">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b-2 border-gray-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Galeri Foto</h2>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($plant->images as $image)
                            <div class="group relative aspect-square rounded-xl overflow-hidden bg-gray-100 border-2 border-gray-200 hover:border-emerald-500 transition-all duration-300">
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     alt="{{ $image->title ?? $plant->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @if($image->title || $image->description)
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/90 via-black/60 to-transparent text-white p-3 text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    @if($image->title)
                                        <p class="font-semibold mb-1">{{ $image->title }}</p>
                                    @endif
                                    @if($image->description)
                                        <p class="text-gray-200">{{ $image->description }}</p>
                                    @endif
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Related Recipes -->
                    @if($recipes->isNotEmpty())
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-8 hover:shadow-lg transition-all duration-200">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b-2 border-gray-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Racikan Menggunakan {{ $plant->name }}</h2>
                        </div>
                        <div class="space-y-3">
                            @foreach($recipes as $recipe)
                            <a href="{{ route('diseases.show', $recipe->disease->slug) }}#recipe-{{ $recipe->id }}" 
                               class="block bg-gray-50 border-2 border-gray-200 rounded-xl p-5 hover:border-emerald-500 hover:bg-emerald-50 transition-all duration-200 group">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h3 class="font-bold text-gray-900 mb-2 text-lg group-hover:text-emerald-700 transition-colors">{{ $recipe->name }}</h3>
                                        <p class="text-sm text-gray-600 mb-2 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                            </svg>
                                            Untuk: <span class="text-red-600 font-semibold">{{ $recipe->disease->name }}</span>
                                        </p>
                                        @if($recipe->description)
                                            <p class="text-sm text-gray-600">{{ Str::limit($recipe->description, 100) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Info -->
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 sticky top-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-5 pb-3 border-b-2 border-gray-100">Info Singkat</h3>
                        <div class="space-y-4 text-sm">
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <div class="flex-1">
                                    <span class="font-semibold text-gray-700 block mb-1">Nama Umum</span>
                                    <span class="text-gray-900">{{ $plant->name }}</span>
                                </div>
                            </div>
                            @if($plant->local_name)
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div class="flex-1">
                                    <span class="font-semibold text-gray-700 block mb-1">Nama Lokal</span>
                                    <span class="text-gray-900">{{ $plant->local_name }}</span>
                                </div>
                            </div>
                            @endif
                            @if($plant->scientific_name)
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <div class="flex-1">
                                    <span class="font-semibold text-gray-700 block mb-1">Nama Ilmiah</span>
                                    <span class="text-gray-900 italic">{{ $plant->scientific_name }}</span>
                                </div>
                            </div>
                            @endif
                            <div class="flex items-center justify-between p-3 bg-emerald-50 rounded-xl">
                                <span class="font-semibold text-gray-700">Jumlah Foto</span>
                                <span class="bg-emerald-600 text-white px-3 py-1 rounded-full text-xs font-bold">{{ $plant->images->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-xl">
                                <span class="font-semibold text-gray-700">Jumlah Racikan</span>
                                <span class="bg-emerald-600 text-white px-3 py-1 rounded-full text-xs font-bold">{{ $recipes->count() }}</span>
                            </div>
                        </div>

                        <hr class="my-6 border-gray-200">

                        <!-- Actions -->
                        <div class="space-y-3">
                            <a href="{{ route('detection.index') }}" 
                               class="flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-600 to-green-700 text-white py-3 rounded-xl font-semibold hover:from-emerald-700 hover:to-green-800 transition-all shadow-lg shadow-emerald-600/30 hover:shadow-xl hover:scale-105 transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Deteksi Tanaman
                            </a>
                            <a href="{{ route('plants.index') }}" 
                               class="flex items-center justify-center gap-2 bg-white border-2 border-gray-200 text-gray-700 py-3 rounded-xl font-semibold hover:bg-gray-50 hover:border-gray-300 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Database
                            </a>
                        </div>
                    </div>

                    <!-- Disclaimer -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 rounded-r-2xl p-5 shadow-sm">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <h4 class="font-bold text-gray-900 text-sm">Perhatian Penting</h4>
                        </div>
                        <p class="text-xs text-gray-700 leading-relaxed">
                            Informasi ini bersifat edukatif. Konsultasikan dengan ahli herbal atau tenaga medis 
                            sebelum menggunakan tanaman untuk pengobatan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Plants CTA -->
<section class="py-16 bg-gradient-to-br from-emerald-50 to-green-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl shadow-lg shadow-emerald-600/30 mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Jelajahi Tanaman Herbal Lainnya</h2>
            <p class="text-lg text-gray-600 mb-8">Temukan berbagai tanaman herbal Indonesia dengan khasiat beragam</p>
            <a href="{{ route('plants.index') }}" 
               class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-green-700 text-white px-8 py-4 rounded-xl font-semibold hover:from-emerald-700 hover:to-green-800 transition-all shadow-lg shadow-emerald-600/30 hover:shadow-xl hover:scale-105 transform">
                Lihat Semua Tanaman
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
@endsection
