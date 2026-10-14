@extends('layouts.admin')

@section('page-title', 'Detail Penyakit')
@section('page-subtitle', $disease->name)

@section('content')<!-- Decorative Background Elements -->
<div class="fixed top-20 right-20 w-96 h-96 bg-green-100/20 rounded-full blur-3xl pointer-events-none -z-10"></div>
<div class="fixed bottom-20 left-20 w-80 h-80 bg-green-50/30 rounded-full blur-3xl pointer-events-none -z-10"></div>
<div class="max-w-5xl">
    <!-- Action Buttons -->
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('admin.diseases.index') }}" class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 hover:border-gray-300 transition-all shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.diseases.edit', $disease->id) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 rounded-xl text-white font-semibold hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all shadow-lg shadow-green-600/30">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
            <form method="POST" action="{{ route('admin.diseases.destroy', $disease->id) }}" onsubmit="return confirm('Yakin ingin menghapus penyakit ini beserta semua racikannya?');" class="inline">
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

    <!-- Main Information Card -->
    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 mb-6">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Image -->
            @if($disease->image_path)
            <div class="flex-shrink-0">
                <div class="relative">
                    <img src="{{ asset('storage/' . $disease->image_path) }}" 
                         alt="{{ $disease->name }}" 
                         class="w-64 h-64 rounded-2xl object-cover shadow-xl border-2 border-gray-200"
                         onerror="this.onerror=null; this.parentElement.parentElement.classList.add('hidden');">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/20 to-transparent rounded-2xl"></div>
                </div>
            </div>
            @endif

            <!-- Basic Info -->
            <div class="flex-1">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-3">{{ $disease->name }}</h1>
                        <div class="flex items-center space-x-3">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-sm font-semibold shadow-md {{ $disease->is_active ? 'bg-gradient-to-r from-green-500 to-green-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    @if($disease->is_active)
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    @else
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    @endif
                                </svg>
                                {{ $disease->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-sm font-semibold bg-green-50 text-green-700 border-2 border-green-200">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                                Urutan: {{ $disease->order }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="space-y-3 bg-gray-50 rounded-xl p-5 border-2 border-gray-200">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-gray-600 w-24">Slug:</span>
                        <span class="text-sm text-gray-900 font-mono bg-white px-3 py-1.5 rounded-lg border border-gray-200">{{ $disease->slug }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-gray-600 w-24">Dibuat:</span>
                        <span class="text-sm text-gray-900">{{ $disease->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span class="text-sm font-semibold text-gray-600 w-24">Diupdate:</span>
                        <span class="text-sm text-gray-900">{{ $disease->updated_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 mb-6">
        <div class="flex items-center gap-3 mb-3 pb-3 border-b-2 border-gray-200">
            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Deskripsi</h3>
        </div>
        <p class="text-gray-700 leading-relaxed">{{ $disease->description }}</p>
    </div>

    <!-- Details Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Symptoms -->
        @if($disease->symptoms)
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 hover:shadow-xl transition-all duration-200 border-l-4 border-green-500">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Gejala-gejala</h3>
            </div>
            <p class="text-sm text-gray-700 leading-relaxed">{{ $disease->symptoms }}</p>
        </div>
        @endif

        <!-- Causes -->
        @if($disease->causes)
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 hover:shadow-xl transition-all duration-200 border-l-4 border-green-500">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Penyebab</h3>
            </div>
            <p class="text-sm text-gray-700 leading-relaxed">{{ $disease->causes }}</p>
        </div>
        @endif

        <!-- Prevention -->
        @if($disease->prevention)
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 hover:shadow-xl transition-all duration-200 border-l-4 border-green-500">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Pencegahan</h3>
            </div>
            <p class="text-sm text-gray-700 leading-relaxed">{{ $disease->prevention }}</p>
        </div>
        @endif
    </div>

    <!-- Associated Recipes -->
    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Racikan Obat Herbal <span class="text-gray-500">({{ $disease->herbalRecipes->count() }})</span></h3>
            </div>
            <a href="{{ route('admin.recipes.create', ['disease_id' => $disease->id]) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 rounded-xl text-white text-sm font-semibold hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all shadow-md shadow-green-600/30">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Racikan
            </a>
        </div>

        @if($disease->herbalRecipes->count() > 0)
        <div class="space-y-3">
            @foreach($disease->herbalRecipes as $recipe)
            <div class="p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all border-2 border-gray-200 hover:border-green-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-1">
                            <h4 class="font-semibold text-gray-900">{{ $recipe->name }}</h4>
                            @if($recipe->is_recommended)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                Rekomendasi
                            </span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-600 mb-2">{{ Str::limit($recipe->description, 100) }}</p>
                        <div class="flex items-center space-x-3 text-xs text-gray-500">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $recipe->preparation_time ?? '-' }}
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                                {{ ucfirst($recipe->difficulty_level) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.recipes.show', $recipe->id) }}" class="p-2 text-green-600 hover:bg-green-100 rounded-xl transition-colors" title="Lihat Detail">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>
                        <a href="{{ route('admin.recipes.edit', $recipe->id) }}" class="p-2 text-green-600 hover:bg-green-100 rounded-xl transition-colors" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <p class="text-gray-500 text-sm mb-4">Belum ada racikan untuk penyakit ini</p>
            <a href="{{ route('admin.recipes.create', ['disease_id' => $disease->id]) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 rounded-xl text-white font-semibold hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all shadow-lg shadow-green-600/30">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Racikan Pertama
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
