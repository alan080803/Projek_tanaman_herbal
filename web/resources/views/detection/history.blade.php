@extends('layouts.app')

@section('title', 'Riwayat Deteksi')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-green-600 to-emerald-700 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center gap-3 mb-4">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h1 class="text-4xl md:text-5xl font-bold">Riwayat Deteksi</h1>
            </div>
            <p class="text-xl text-green-100">Lihat semua deteksi tanaman yang pernah Anda lakukan</p>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="bg-white py-6 shadow-sm">
    <div class="container mx-auto px-4">
        <form method="GET" action="{{ route('detection.history') }}" class="max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row gap-4">
                <select name="status" 
                        class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-green-500 focus:outline-none"
                        onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>✅ Berhasil</option>
                    <option value="no_leaf" {{ request('status') === 'no_leaf' ? 'selected' : '' }}>🍂 Tidak Ada Daun</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                    <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>❌ Gagal</option>
                </select>
                
                <a href="{{ route('detection.history') }}" 
                   class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition text-center">
                    Reset Filter
                </a>
            </div>
        </form>
    </div>
</section>

<!-- Detections List -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            @if($detections->isEmpty())
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Riwayat Deteksi</h3>
                    <p class="text-gray-600 mb-6">Mulai deteksi tanaman pertama Anda untuk melihat riwayat di sini</p>
                    <a href="{{ route('detection.index') }}" 
                       class="inline-flex items-center justify-center gap-2 bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                        </svg>
                        Mulai Deteksi Sekarang
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($detections as $detection)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="md:flex">
                            <!-- Image -->
                            <div class="md:w-64 h-48 md:h-auto bg-gray-100 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                @if($detection->uploaded_image_path)
                                    <img src="{{ asset('storage/' . $detection->uploaded_image_path) }}" 
                                         alt="Detection"
                                         class="w-full h-full object-cover"
                                         onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center text-gray-400 bg-gray-100 min-h-[192px]\'><svg class=\'w-8 h-8 text-gray-300\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg></div>';">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100 min-h-[192px]">
                                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Content -->
                            <div class="p-6 flex-1">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        @if($detection->detection_status === 'success' && $detection->plant)
                                            <h3 class="text-xl font-bold text-gray-800 mb-1">
                                                {{ $detection->plant->name }}
                                            </h3>
                                            @if($detection->plant->local_name)
                                                <p class="text-gray-600 text-sm mb-2">({{ $detection->plant->local_name }})</p>
                                            @endif
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">
                                                    ✅ Berhasil
                                                </span>
                                                <span class="text-sm text-gray-600">
                                                    Kepercayaan: <span class="font-bold text-green-600">{{ number_format($detection->confidence_score, 1) }}%</span>
                                                </span>
                                            </div>
                                        @elseif($detection->detection_status === 'no_leaf')
                                            <h3 class="text-xl font-bold text-gray-800 mb-2">
                                                Objek Daun Tidak Ditemukan
                                            </h3>
                                            <span class="bg-amber-100 text-amber-800 text-xs font-semibold px-3 py-1 rounded-full">
                                                🍂 Tidak Ada Daun
                                            </span>
                                        @elseif($detection->detection_status === 'failed')
                                            <h3 class="text-xl font-bold text-gray-800 mb-2">
                                                Deteksi Gagal
                                            </h3>
                                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">
                                                ❌ Tidak Teridentifikasi
                                            </span>
                                        @else
                                            <h3 class="text-xl font-bold text-gray-800 mb-2">
                                                Sedang Diproses
                                            </h3>
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">
                                                ⏳ Pending
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="text-right text-sm text-gray-500 ml-4">
                                        <p>{{ $detection->created_at->format('d M Y') }}</p>
                                        <p>{{ $detection->created_at->format('H:i') }}</p>
                                    </div>
                                </div>

                                @if($detection->notes)
                                    <div class="mb-3 text-sm">
                                        <span class="font-semibold text-gray-700">Catatan:</span>
                                        <span class="text-gray-600">{{ Str::limit($detection->notes, 100) }}</span>
                                    </div>
                                @endif

                                @if($detection->detection_status === 'success' && $detection->plant)
                                    <p class="text-gray-600 text-sm mb-4">
                                        {{ Str::limit($detection->plant->description, 120) }}
                                    </p>
                                @endif

                                <div class="flex gap-3">
                                    <a href="{{ route('detection.result', $detection->id) }}" 
                                       class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                                        Lihat Detail
                                    </a>
                                    
                                    @if($detection->detection_status === 'success' && $detection->plant)
                                        <a href="{{ route('plants.show', $detection->plant->id) }}" 
                                           class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                                           Info Tanaman
                                        </a>
                                    @elseif($detection->detection_status === 'failed' || $detection->detection_status === 'no_leaf')
                                        <a href="{{ route('detection.index') }}" 
                                           class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                                           Coba Lagi
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $detections->links() }}
                </div>

                <!-- Statistics -->
                <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white rounded-xl shadow-md p-6 text-center border-t-4 border-gray-400">
                        <svg class="w-12 h-12 text-gray-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <div class="text-3xl font-bold text-gray-800 mb-1">{{ $totalDetections ?? $detections->total() }}</div>
                        <div class="text-gray-600 text-sm">Total Deteksi</div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md p-6 text-center border-t-4 border-green-500">
                        <svg class="w-12 h-12 text-green-600 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="text-3xl font-bold text-green-600 mb-1">
                            {{ $successfulCount ?? 0 }}
                        </div>
                        <div class="text-gray-600 text-sm">Berhasil</div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md p-6 text-center border-t-4 border-amber-500">
                        <svg class="w-12 h-12 text-amber-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div class="text-3xl font-bold text-amber-600 mb-1">
                            {{ $noLeafCount ?? 0 }}
                        </div>
                        <div class="text-gray-600 text-sm">Tidak Ada Daun</div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md p-6 text-center border-t-4 border-emerald-500">
                        <svg class="w-12 h-12 text-emerald-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                        </svg>
                        <div class="text-3xl font-bold text-emerald-600 mb-1">
                            {{ $uniquePlantsCount ?? 0 }}
                        </div>
                        <div class="text-gray-600 text-sm">Jenis Tanaman</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-green-600 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Temukan Tanaman Herbal Lainnya</h2>
        <p class="text-xl mb-6 text-green-100">Deteksi tanaman baru dan perluas pengetahuan herbal Anda</p>
        <a href="{{ route('detection.index') }}" 
           class="inline-flex items-center justify-center gap-2 bg-white text-green-600 px-8 py-3 rounded-lg font-bold hover:bg-green-50 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            Deteksi Tanaman Baru
        </a>
    </div>
</section>
@endsection
