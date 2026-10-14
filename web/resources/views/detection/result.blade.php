@extends('layouts.app')

@section('title', 'Hasil Deteksi - ' . ($detection->plant->name ?? ($detection->detection_status === 'no_leaf' ? 'Tidak Ada Daun' : 'Memproses')))

@section('content')
<!-- Status Header -->
<section class="py-8 {{ $detection->detection_status === 'success' ? 'bg-green-600' : ($detection->detection_status === 'no_leaf' ? 'bg-amber-600' : ($detection->detection_status === 'failed' ? 'bg-red-600' : 'bg-yellow-600')) }} text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            @if($detection->detection_status === 'success')
                <svg class="w-20 h-20 mx-auto mb-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <h1 class="text-3xl font-bold mb-2">Deteksi Berhasil!</h1>
                <p class="text-green-100">Tanaman berhasil diidentifikasi dengan tingkat kepercayaan {{ number_format($detection->confidence_score, 1) }}%</p>
            @elseif($detection->detection_status === 'no_leaf')
                <div class="w-20 h-20 mx-auto mb-3 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold mb-2">Tidak Ada Daun Terdeteksi</h1>
                <p class="text-amber-100">Sistem tidak menemukan objek daun di dalam gambar ini</p>
            @elseif($detection->detection_status === 'failed')
                <svg class="w-20 h-20 mx-auto mb-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <h1 class="text-3xl font-bold mb-2">Deteksi Gagal</h1>
                <p class="text-red-100">Maaf, sistem tidak dapat mengidentifikasi tanaman ini</p>
            @else
                <svg class="w-20 h-20 mx-auto mb-3 text-white animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <h1 class="text-3xl font-bold mb-2">Sedang Memproses...</h1>
                <p class="text-yellow-100">Mohon tunggu, sistem sedang menganalisis foto Anda</p>
            @endif
        </div>
    </div>
</section>

<!-- Main Result Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="space-y-8">
                <!-- Uploaded Image -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <h2 class="text-xl font-bold text-gray-800">Foto yang Diupload</h2>
                    </div>
                    <div class="rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center min-h-[200px]">
                        @if($detection->uploaded_image_path)
                            <img src="{{ asset('storage/' . $detection->uploaded_image_path) }}" 
                                 alt="Uploaded plant"
                                 class="max-h-96 w-auto object-contain"
                                 onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'text-center p-8 text-gray-400\'><svg class=\'w-16 h-16 mx-auto mb-2 text-gray-300\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg><p class=\'text-sm font-medium\'>Foto tidak dapat dimuat</p></div>';">
                        @else
                            <div class="text-center p-8 text-gray-400">
                                <svg class="w-16 h-16 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-sm font-medium">Foto tidak tersedia</p>
                            </div>
                        @endif
                    </div>
                    
                    @if($detection->notes)
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-600 font-semibold mb-1">Catatan Anda:</p>
                            <p class="text-gray-700">{{ $detection->notes }}</p>
                        </div>
                    @endif
                    
                    <div class="mt-4 text-sm text-gray-500">
                        <p>Waktu upload: {{ $detection->created_at->format('d M Y, H:i') }}</p>
                        @if($detection->detected_at)
                            <p>Waktu deteksi: {{ $detection->detected_at->format('d M Y, H:i') }}</p>
                        @endif
                    </div>
                </div>

                <!-- Detection Result -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    @if($detection->detection_status === 'success' && $detection->plant)
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                            </svg>
                            <h2 class="text-xl font-bold text-gray-800">Hasil Identifikasi</h2>
                        </div>

                        @if((isset($detection->detection_result['leaf_detected']) && $detection->detection_result['leaf_detected']) || (isset($detection->detection_result['yolo_result']['leaf_detected']) && $detection->detection_result['yolo_result']['leaf_detected']))
                            <div class="mb-4 inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <span>Objek Daun Terverifikasi ({{ $detection->detection_result['leaf_count'] ?? ($detection->detection_result['yolo_result']['leaf_count'] ?? 1) }} objek)</span>
                            </div>
                        @endif
                        
                        <!-- Confidence Score -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-700 font-semibold">Tingkat Kepercayaan</span>
                                <span class="text-2xl font-bold text-green-600">{{ number_format($detection->confidence_score, 1) }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-green-600 h-3 rounded-full transition-all duration-500" 
                                     style="width: {{ $detection->confidence_score }}%"></div>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">
                                @if($detection->confidence_score >= 80)
                                    Sangat akurat
                                @elseif($detection->confidence_score >= 60)
                                    Cukup akurat
                                @else
                                    Kurang akurat - verifikasi manual disarankan
                                @endif
                            </p>
                        </div>

                        <!-- Plant Info -->
                        <div class="border-t pt-6">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $detection->plant->name }}</h3>
                            
                            @if($detection->plant->local_name)
                                <p class="text-lg text-gray-600 mb-1">Nama Lokal: <span class="font-semibold">{{ $detection->plant->local_name }}</span></p>
                            @endif
                            
                            @if($detection->plant->scientific_name)
                                <p class="text-sm text-gray-500 italic mb-4">{{ $detection->plant->scientific_name }}</p>
                            @endif

                            <!-- Plant Images Gallery -->
                            @if($detection->plant->images->isNotEmpty())
                                <div class="mb-6">
                                    <p class="text-sm font-semibold text-gray-700 mb-2">Foto Referensi:</p>
                                    <div class="grid grid-cols-3 gap-2">
                                        @foreach($detection->plant->images->take(6) as $image)
                                            <div class="aspect-square rounded-lg overflow-hidden bg-gray-100">
                                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                                     alt="{{ $image->title }}"
                                                     class="w-full h-full object-cover"
                                                     onerror="this.onerror=null; this.parentElement.classList.add('hidden');">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Description -->
                            <div class="mb-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h4 class="font-bold text-gray-800">Deskripsi Umum</h4>
                                </div>
                                <p class="text-gray-700 leading-relaxed">{{ $detection->plant->description }}</p>
                            </div>

                            @if($detection->plant->characteristics)
                                <div class="mb-4">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        <h4 class="font-bold text-gray-800">Karakteristik</h4>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed">{{ $detection->plant->characteristics }}</p>
                                </div>
                            @endif

                            <div class="mb-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                    </svg>
                                    <h4 class="font-bold text-gray-800">Khasiat & Manfaat</h4>
                                </div>
                                <p class="text-gray-700 leading-relaxed">{{ $detection->plant->benefits }}</p>
                            </div>

                            @if($detection->plant->usage_notes)
                                <div class="bg-green-50 p-4 rounded-lg border-2 border-green-100">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <h4 class="font-bold text-gray-800">Catatan Penggunaan</h4>
                                    </div>
                                    <p class="text-gray-700 text-sm leading-relaxed">{{ $detection->plant->usage_notes }}</p>
                                </div>
                            @endif

                            <!-- View Full Details -->
                            <div class="mt-6">
                                <a href="{{ route('plants.show', $detection->plant->id) }}" 
                                   class="block w-full bg-green-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                                    Lihat Detail Lengkap →
                                </a>
                            </div>
                        </div>

                    @elseif($detection->detection_status === 'no_leaf')
                        <div class="text-center py-8">
                            <div class="w-20 h-20 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Objek Daun Tidak Ditemukan</h3>
                            <p class="text-gray-600 max-w-xl mx-auto mb-6">
                                Sistem memeriksa foto terlebih dahulu untuk memastikan keberadaan daun sebelum proses klasifikasi. Pada gambar ini, tidak ditemukan objek daun sehingga klasifikasi tidak dapat dilanjutkan.
                            </p>

                            <div class="bg-amber-50 border border-amber-200 rounded-xl p-5 max-w-lg mx-auto text-left mb-6 shadow-sm">
                                <h4 class="font-bold text-amber-900 mb-3 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Petunjuk Foto yang Baik:
                                </h4>
                                <ul class="text-amber-800 text-sm space-y-2">
                                    <li class="flex items-start">
                                        <span class="mr-2 font-bold">•</span>
                                        <span>Pastikan foto berfokus pada <strong>daun tanaman herbal</strong>.</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="mr-2 font-bold">•</span>
                                        <span>Hindari mengunggah gambar selain daun (manusia, hewan, pemandangan tanpa daun, atau benda lain).</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="mr-2 font-bold">•</span>
                                        <span>Pastikan pencahayaan terang dan daun terlihat jelas (tidak buram/terlalu gelap).</span>
                                    </li>
                                </ul>
                            </div>

                            <a href="{{ route('detection.index') }}" 
                               class="inline-block bg-amber-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-amber-700 transition shadow">
                                Coba Lagi dengan Foto Daun
                            </a>
                        </div>

                    @elseif($detection->detection_status === 'failed')
                        <div class="text-center py-8">
                            <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Tanaman Tidak Dapat Diidentifikasi</h3>
                            <p class="text-gray-600 mb-6">Sistem tidak dapat mengenali tanaman ini. Kemungkinan penyebab:</p>
                            <ul class="text-left text-gray-600 space-y-2 mb-6">
                                <li class="flex items-start">
                                    <span class="mr-2">•</span>
                                    <span>Foto kurang jelas atau buram</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="mr-2">•</span>
                                    <span>Tanaman belum terdaftar dalam database kami</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="mr-2">•</span>
                                    <span>Pencahayaan tidak optimal</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="mr-2">•</span>
                                    <span>Bagian tanaman yang difoto tidak cukup karakteristik</span>
                                </li>
                            </ul>
                            <a href="{{ route('detection.index') }}" 
                               class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                                Coba Lagi dengan Foto Baru
                            </a>
                        </div>

                    @else
                        <div class="text-center py-8">
                            <div class="animate-spin w-16 h-16 border-4 border-green-600 border-t-transparent rounded-full mx-auto mb-4"></div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Sedang Menganalisis...</h3>
                            <p class="text-gray-600 mb-4">AI kami sedang memproses foto Anda</p>
                            <p class="text-sm text-gray-500">Halaman ini akan otomatis diperbarui saat hasil sudah siap</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('detection.index') }}" 
                   class="inline-flex items-center justify-center gap-2 bg-white text-green-600 border-2 border-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-50 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Deteksi Tanaman Lain
                </a>
                @if($detection->detection_status === 'success' && $detection->plant)
                    <a href="{{ route('plants.index') }}" 
                       class="inline-flex items-center justify-center gap-2 bg-white text-green-600 border-2 border-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-50 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                        </svg>
                        Jelajahi Database Tanaman
                    </a>
                @endif
            </div>

            <!-- Related Recipes -->
            @if($detection->detection_status === 'success' && $detection->plant && $detection->plant->recipes->isNotEmpty())
            <div class="mt-12 bg-white rounded-xl shadow-md p-8">
                <div class="flex items-center gap-2 mb-6">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-800">Racikan yang Menggunakan Tanaman Ini</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($detection->plant->recipes->take(4) as $recipe)
                        <a href="{{ route('recipes.show', $recipe->id) }}" 
                           class="card-hover border-2 border-gray-200 rounded-lg p-4 hover:border-green-300 transition">
                            <h3 class="font-bold text-gray-800 mb-2">{{ $recipe->name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">Untuk: {{ $recipe->disease->name }}</p>
                            <p class="text-sm text-gray-500">{{ Str::limit($recipe->description, 80) }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

@if($detection->detection_status === 'pending')
@push('scripts')
<script>
    // Auto-refresh every 5 seconds if status is pending
    setTimeout(function() {
        location.reload();
    }, 5000);
</script>
@endpush
@endif
@endsection
