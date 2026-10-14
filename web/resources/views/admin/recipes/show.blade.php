@extends('layouts.admin')

@section('page-title', 'Detail Racikan')
@section('page-subtitle', $recipe->name)

@section('content')<!-- Decorative Background Elements -->
<div class="fixed top-20 right-20 w-96 h-96 bg-green-100/20 rounded-full blur-3xl pointer-events-none -z-10"></div>
<div class="fixed bottom-20 left-20 w-80 h-80 bg-green-50/30 rounded-full blur-3xl pointer-events-none -z-10"></div>
<div class="max-w-5xl">
    <!-- Action Buttons -->
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('admin.recipes.index') }}" class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 hover:border-gray-300 transition-all shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.recipes.edit', $recipe->id) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 rounded-xl text-white font-semibold hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all shadow-lg shadow-green-600/30">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
            <form method="POST" action="{{ route('admin.recipes.destroy', $recipe->id) }}" onsubmit="return confirm('Yakin ingin menghapus racikan ini?');" class="inline">
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

    <!-- Main Info Card -->
    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 mb-6">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <div class="mb-3">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $recipe->name }}</h1>
                </div>
                <div class="flex items-center text-gray-600 mb-3">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <span class="text-sm">Untuk penyakit: <a href="{{ route('admin.diseases.show', $recipe->disease->id) }}" class="font-semibold text-green-600 hover:text-green-700 transition-colors">{{ $recipe->disease->name }}</a></span>
                </div>
                @if($recipe->description)
                <p class="text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-xl">{{ $recipe->description }}</p>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t border-gray-200">
            <div class="text-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                <p class="text-xs text-gray-500 mb-1">Tingkat Kesulitan</p>
                <p class="text-sm font-bold text-gray-900 capitalize">{{ ucfirst($recipe->difficulty_level) }}</p>
            </div>
            <div class="text-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-xs text-gray-500 mb-1">Waktu Persiapan</p>
                <p class="text-sm font-bold text-gray-900">{{ $recipe->preparation_time ?? '-' }}</p>
            </div>
            <div class="text-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <p class="text-xs text-gray-500 mb-1">Porsi</p>
                <p class="text-sm font-bold text-gray-900">{{ $recipe->servings }} porsi</p>
            </div>
            <div class="text-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-xs text-gray-500 mb-1">Status</p>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $recipe->is_active ? 'bg-gradient-to-r from-green-600 to-green-700 text-white' : 'bg-gray-200 text-gray-700' }}">
                    {{ $recipe->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Dosage & Duration -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
            <div class="flex items-center mb-4">
                <div class="w-8 h-8 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center mr-3">
                    <span class="text-2xl">💊</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Dosis & Durasi</h3>
            </div>
            <div class="space-y-3">
                <div class="bg-gray-50 p-3 rounded-lg">
                    <div class="flex items-center mb-1">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-600">Dosis:</span>
                    </div>
                    <p class="text-sm text-gray-900 ml-6">{{ $recipe->dosage }}</p>
                </div>
                @if($recipe->duration)
                <div class="bg-gray-50 p-3 rounded-lg">
                    <div class="flex items-center mb-1">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-600">Durasi Penggunaan:</span>
                    </div>
                    <p class="text-sm text-gray-900 ml-6">{{ $recipe->duration }}</p>
                </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
            <div class="flex items-center mb-4">
                <div class="w-8 h-8 bg-gradient-to-br from-slate-100 to-slate-200 rounded-lg flex items-center justify-center mr-3">
                    <span class="text-2xl">⚠️</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Peringatan</h3>
            </div>
            @if($recipe->warnings || $recipe->side_effects)
            <div class="space-y-3">
                @if($recipe->warnings)
                <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
                    <p class="text-sm text-red-900">{{ $recipe->warnings }}</p>
                </div>
                @endif
                @if($recipe->side_effects)
                <div class="bg-orange-50 p-3 rounded-lg border border-orange-100">
                    <p class="text-xs font-medium text-orange-900 mb-1">Efek Samping:</p>
                    <p class="text-sm text-orange-800">{{ $recipe->side_effects }}</p>
                </div>
                @endif
            </div>
            @else
            <div class="text-center py-6">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm text-gray-500">Tidak ada peringatan khusus</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Ingredients -->
    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 mb-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">🌿 Bahan-bahan ({{ $recipe->ingredients->count() }})</h3>
        
        @if($recipe->ingredients->count() > 0)
        <div class="space-y-3">
            @foreach($recipe->ingredients as $ingredient)
            <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all border-2 border-gray-200 hover:border-green-300">
                <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                    <span class="text-sm font-bold text-green-700">{{ $loop->iteration }}</span>
                </div>
                @if($ingredient->plant && $ingredient->plant->image_path)
                <img src="{{ asset('storage/' . $ingredient->plant->image_path) }}" alt="{{ $ingredient->plant->name }}" class="w-12 h-12 rounded-lg object-cover mr-3">
                @endif
                <div class="flex-1">
                    <p class="font-semibold text-gray-900">{{ $ingredient->plant->name ?? 'Unknown' }}</p>
                    <p class="text-sm text-gray-600">
                        <span class="font-medium">{{ $ingredient->quantity }} {{ $ingredient->unit }}</span> 
                        ({{ $ingredient->part_used_label }})
                    </p>
                    @if($ingredient->preparation_notes)
                    <p class="text-xs text-gray-500 mt-1">{{ $ingredient->preparation_notes }}</p>
                    @endif
                </div>
                @if($ingredient->plant)
                <a href="{{ route('admin.plants.show', $ingredient->plant->id) }}" class="p-2 text-green-600 hover:bg-green-100 rounded-xl transition-colors" title="Lihat Tanaman">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </a>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-gray-500 text-sm py-6">Belum ada bahan yang ditambahkan</p>
        @endif
    </div>

    <!-- Instructions -->
    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 mb-6">
        <h3 class="text-lg font-bold text-gray-900 mb-3">📝 Cara Pembuatan</h3>
        <div class="prose prose-sm max-w-none">
            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $recipe->instructions }}</p>
        </div>
    </div>

    <!-- Steps -->
    @if($recipe->steps->count() > 0)
    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">📋 Langkah-langkah Detail ({{ $recipe->steps->count() }})</h3>
        
        <div class="space-y-4">
            @foreach($recipe->steps as $step)
            <div class="flex items-start">
                <div class="flex-shrink-0 w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center mr-4">
                    <span class="text-sm font-bold">{{ $step->step_number }}</span>
                </div>
                <div class="flex-1">
                    @if($step->title)
                    <h4 class="font-semibold text-gray-900 mb-1">{{ $step->title }}</h4>
                    @endif
                    <p class="text-sm text-gray-700 mb-2">{{ $step->instruction }}</p>
                    <div class="flex items-center space-x-4 text-xs text-gray-500">
                        @if($step->duration)
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $step->duration }}
                        </span>
                        @endif
                        @if($step->tips)
                        <span class="flex items-center text-green-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                            Tips: {{ $step->tips }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
