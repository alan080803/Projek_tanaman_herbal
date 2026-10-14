@extends('layouts.admin')

@section('page-title', 'Detail Deteksi')
@section('page-subtitle', 'Informasi lengkap hasil deteksi tanaman')

@section('content')<!-- Decorative Background Elements -->
<div class="fixed top-20 right-20 w-96 h-96 bg-green-100/20 rounded-full blur-3xl pointer-events-none -z-10"></div>
<div class="fixed bottom-20 left-20 w-80 h-80 bg-green-50/30 rounded-full blur-3xl pointer-events-none -z-10"></div>
<div class="max-w-5xl">
    <!-- Action Buttons -->
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('admin.detections.index') }}" class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 hover:border-gray-300 transition-all shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
        <div class="flex items-center space-x-3">
            <form method="POST" action="{{ route('admin.detections.destroy', $detection->id) }}" onsubmit="return confirm('Yakin ingin menghapus deteksi ini?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 rounded-xl text-white font-semibold hover:from-gray-600 hover:to-gray-700 transform hover:scale-105 transition-all shadow-lg shadow-gray-600/30">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Image Section -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                <div class="w-8 h-8 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                Gambar yang Dideteksi
            </h3>
            @if($detection->uploaded_image_path)
            <div class="relative group">
                <img src="{{ asset('storage/' . $detection->uploaded_image_path) }}" 
                     alt="Deteksi" 
                     class="w-full rounded-xl shadow-lg transition-transform duration-200 group-hover:scale-[1.02]"
                     onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'p-8 text-center bg-gray-100 rounded-xl text-gray-500\'><p class=\'text-sm font-medium\'>Foto tidak dapat dimuat</p></div>';">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/30 to-transparent rounded-xl pointer-events-none"></div>
                <div class="absolute top-3 right-3">
                    @if($detection->detection_status === 'success')
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gradient-to-r from-green-600 to-green-700 text-white shadow-lg">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Berhasil
                    </span>
                    @elseif($detection->detection_status === 'no_leaf')
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-lg">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        Tidak Ada Daun
                    </span>
                    @elseif($detection->detection_status === 'pending')
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gradient-to-r from-slate-500 to-slate-600 text-white shadow-lg">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        Pending
                    </span>
                    @else
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gradient-to-r from-gray-500 to-gray-600 text-white shadow-lg">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        Gagal
                    </span>
                    @endif
                </div>
            </div>
            @else
            <div class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center">
                <div class="text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-gray-500 text-sm">Gambar tidak tersedia</p>
                </div>
            </div>
            @endif

            <!-- Detection Metadata -->
            <div class="mt-4 space-y-2 bg-gray-50 rounded-xl p-4 border-2 border-gray-200">
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Tanggal Deteksi:
                    </div>
                    <span class="font-medium text-gray-900">{{ $detection->created_at->format('d M Y, H:i') }}</span>
                </div>
                @if($detection->detection_method)
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                        </svg>
                        Metode:
                    </div>
                    <span class="font-medium text-gray-900">{{ $detection->detection_method }}</span>
                </div>
                @endif
                @if($detection->processing_time)
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Waktu Proses:
                    </div>
                    <span class="font-medium text-gray-900">{{ $detection->processing_time }} detik</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Detection Result Section -->
        <div class="space-y-6">
            <!-- Detected Plant -->
            <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    Hasil Deteksi
                </h3>
                
                @if($detection->plant)
                <div class="flex items-start space-x-4 mb-4">
                    @if($detection->plant->image_path)
                    <img src="{{ asset('storage/' . $detection->plant->image_path) }}" alt="{{ $detection->plant->name }}" class="w-20 h-20 rounded-xl object-cover shadow-md border-2 border-gray-200">
                    @else
                    <div class="w-20 h-20 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center border-2 border-green-300">
                        <span class="text-xl font-bold text-green-700">{{ substr($detection->plant->name, 0, 1) }}</span>
                    </div>
                    @endif
                    <div class="flex-1">
                        <h4 class="text-lg font-bold text-gray-900 mb-1">{{ $detection->plant->name }}</h4>
                        @if($detection->plant->local_name)
                        <p class="text-sm text-gray-600 mb-2">{{ $detection->plant->local_name }}</p>
                        @endif
                        @if($detection->plant->scientific_name)
                        <p class="text-xs text-gray-500 italic">{{ $detection->plant->scientific_name }}</p>
                        @endif
                    </div>
                </div>

                <!-- Confidence Score -->
                @if($detection->confidence_score)
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700">Tingkat Kepercayaan</span>
                        <span class="text-lg font-bold text-green-600">{{ number_format($detection->confidence_score, 1) }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden shadow-inner">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 h-4 rounded-full transition-all duration-500 shadow-sm" style="width: {{ $detection->confidence_score }}%"></div>
                    </div>
                    <div class="flex items-center mt-2">
                        @if($detection->confidence_score >= 80)
                        <div class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Sangat Tinggi
                        </div>
                        @elseif($detection->confidence_score >= 60)
                        <div class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Tinggi
                        </div>
                        @elseif($detection->confidence_score >= 40)
                        <div class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                            </svg>
                            Sedang
                        </div>
                        @else
                        <div class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            Rendah
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Plant Actions -->
                <div class="flex gap-3">
                    <a href="{{ route('admin.plants.show', $detection->plant->id) }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 rounded-xl text-white font-semibold hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all shadow-lg shadow-green-600/30">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Lihat Detail Tanaman
                    </a>
                </div>
                @else
                <div class="text-center py-8">
                    @if($detection->detection_status === 'no_leaf')
                    <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <p class="text-gray-900 font-semibold text-base mb-1">Tidak Ada Objek Daun Terdeteksi</p>
                    <p class="text-gray-500 text-sm max-w-sm mx-auto">Sistem memeriksa gambar terlebih dahulu dan tidak menemukan objek daun.</p>
                    @else
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-500 text-sm">Tanaman belum teridentifikasi</p>
                    @if($detection->error_message)
                    <p class="text-xs text-gray-600 mt-2">{{ $detection->error_message }}</p>
                    @endif
                    @endif
                </div>
                @endif
            </div>

            <!-- User Information (if available) -->
            @if($detection->user)
            <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    Informasi Pengguna
                </h3>
                <div class="space-y-2 bg-gray-50 rounded-xl p-4 border-2 border-gray-200">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 font-medium">Nama:</span>
                        <span class="font-semibold text-gray-900">{{ $detection->user->name }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 font-medium">Email:</span>
                        <span class="font-semibold text-gray-900">{{ $detection->user->email }}</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Additional Information -->
    @if($detection->notes || $detection->location)
    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 mt-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
            <div class="w-8 h-8 bg-gradient-to-br from-amber-100 to-amber-200 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            Informasi Tambahan
        </h3>
        <div class="space-y-3 bg-gray-50 rounded-xl p-4 border-2 border-gray-200">
            @if($detection->location)
            <div>
                <span class="text-sm font-medium text-gray-700">Lokasi:</span>
                <p class="text-sm text-gray-900 mt-1 font-semibold">{{ $detection->location }}</p>
            </div>
            @endif
            @if($detection->notes)
            <div>
                <span class="text-sm font-medium text-gray-700">Catatan:</span>
                <p class="text-sm text-gray-900 mt-1">{{ $detection->notes }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Detection History Timeline -->
    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 mt-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
            <div class="w-8 h-8 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            Riwayat Proses
        </h3>
        <div class="space-y-4 bg-gray-50 rounded-xl p-4 border-2 border-gray-200">
            <div class="flex items-start">
                <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900">Deteksi dibuat</p>
                    <p class="text-xs text-gray-600 mt-1">{{ $detection->created_at->format('d M Y, H:i:s') }}</p>
                </div>
            </div>
            @if($detection->updated_at != $detection->created_at)
            <div class="flex items-start">
                <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-slate-100 to-slate-200 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                    <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900">Terakhir diperbarui</p>
                    <p class="text-xs text-gray-600 mt-1">{{ $detection->updated_at->format('d M Y, H:i:s') }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
