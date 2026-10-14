@extends('layouts.app')

@section('title', $recipe->name . ' - Racikan Herbal')

@section('content')
<!-- Breadcrumb -->
<section class="bg-white py-4 border-b border-gray-100">
    <div class="container mx-auto px-4">
        <nav class="text-sm flex items-center gap-2 text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-green-600 transition-colors">Beranda</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('recipes.index') }}" class="hover:text-green-600 transition-colors">Racikan Herbal</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900 font-medium">{{ $recipe->name }}</span>
        </nav>
    </div>
</section>

<!-- Recipe Header -->
<section class="bg-gradient-to-r from-green-600 to-green-700 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <!-- Disease Link -->
                <a href="{{ route('diseases.show', $recipe->disease->slug) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="text-sm font-semibold">{{ $recipe->disease->name }}</span>
                </a>

                <!-- Difficulty Badge -->
                @if($recipe->difficulty_level === 'easy')
                    <span class="px-3 py-1.5 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">Mudah</span>
                @elseif($recipe->difficulty_level === 'medium')
                    <span class="px-3 py-1.5 bg-yellow-100 text-yellow-700 text-sm font-semibold rounded-lg">Sedang</span>
                @else
                    <span class="px-3 py-1.5 bg-red-100 text-red-700 text-sm font-semibold rounded-lg">Sulit</span>
                @endif
            </div>

            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $recipe->name }}</h1>
            
            @if($recipe->description)
                <p class="text-lg text-green-50 leading-relaxed max-w-3xl">{{ $recipe->description }}</p>
            @endif
        </div>
    </div>
</section>

<!-- Quick Info Cards -->
<section class="py-8 bg-gray-50 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Preparation Time -->
            @if($recipe->preparation_time)
                <div class="bg-white rounded-xl p-4 text-center border-2 border-gray-100 hover:border-green-200 transition-colors">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-gray-900 mb-1">{{ $recipe->preparation_time }}</p>
                    <p class="text-sm text-gray-600">Menit</p>
                </div>
            @endif

            <!-- Dosage -->
            @if($recipe->dosage)
                <div class="bg-white rounded-xl p-4 text-center border-2 border-gray-100 hover:border-green-200 transition-colors">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-gray-900 mb-1">{{ $recipe->dosage }}</p>
                    <p class="text-sm text-gray-600">Dosis</p>
                </div>
            @endif

            <!-- Duration -->
            @if($recipe->duration)
                <div class="bg-white rounded-xl p-4 text-center border-2 border-gray-100 hover:border-green-200 transition-colors">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-gray-900 mb-1">{{ $recipe->duration }}</p>
                    <p class="text-sm text-gray-600">Durasi Konsumsi</p>
                </div>
            @endif

            <!-- Servings -->
            @if($recipe->servings)
                <div class="bg-white rounded-xl p-4 text-center border-2 border-gray-100 hover:border-green-200 transition-colors">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-gray-900 mb-1">{{ $recipe->servings }}</p>
                    <p class="text-sm text-gray-600">Porsi</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Ingredients Section -->
            <div class="mb-12">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b-2 border-gray-200">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Bahan-Bahan</h2>
                </div>

                <div class="space-y-4">
                    @foreach($recipe->ingredients as $ingredient)
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl border-2 border-gray-100 hover:border-green-200 transition-all duration-200">
                            <!-- Plant Image -->
                            <div class="flex-shrink-0">
                                @if($ingredient->plant->primaryImage)
                                    <img src="{{ asset('storage/' . $ingredient->plant->primaryImage->image_path) }}" 
                                         alt="{{ $ingredient->plant->name }}"
                                         class="w-20 h-20 rounded-lg object-cover border-2 border-white shadow-md"
                                         onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-20 h-20 rounded-lg bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center border-2 border-white shadow-md\'><svg class=\'w-10 h-10 text-green-600\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9\'/></svg></div>';">
                                @elseif($ingredient->plant->image_path)
                                    <img src="{{ asset('storage/' . $ingredient->plant->image_path) }}" 
                                         alt="{{ $ingredient->plant->name }}"
                                         class="w-20 h-20 rounded-lg object-cover border-2 border-white shadow-md"
                                         onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-20 h-20 rounded-lg bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center border-2 border-white shadow-md\'><svg class=\'w-10 h-10 text-green-600\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9\'/></svg></div>';">
                                @else
                                    <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center border-2 border-white shadow-md">
                                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Ingredient Details -->
                            <div class="flex-grow">
                                <div class="flex items-start justify-between gap-4 mb-2">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">{{ $ingredient->plant->name }}</h3>
                                        @if($ingredient->plant->local_name)
                                            <p class="text-sm text-gray-600">{{ $ingredient->plant->local_name }}</p>
                                        @endif
                                    </div>
                                    <span class="px-3 py-1.5 bg-green-600 text-white text-sm font-bold rounded-lg whitespace-nowrap">
                                        {{ $ingredient->quantity }} {{ $ingredient->unit }}
                                    </span>
                                </div>

                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        {{ $ingredient->part_used_label }}
                                    </span>
                                </div>

                                @if($ingredient->preparation_notes)
                                    <p class="text-sm text-gray-700 leading-relaxed">
                                        <span class="font-semibold text-gray-900">Catatan:</span> {{ $ingredient->preparation_notes }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Preparation Steps Section -->
            <div class="mb-12">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b-2 border-gray-200">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Cara Pembuatan</h2>
                </div>

                <div class="space-y-6">
                    @foreach($recipe->steps as $step)
                        <div class="flex items-start gap-4">
                            <!-- Step Number -->
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center shadow-lg">
                                    <span class="text-xl font-bold text-white">{{ $step->step_number }}</span>
                                </div>
                            </div>

                            <!-- Step Content -->
                            <div class="flex-grow bg-gray-50 rounded-xl p-6 border-2 border-gray-100">
                                @if($step->title)
                                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $step->title }}</h3>
                                @endif

                                <p class="text-gray-700 leading-relaxed mb-4">{{ $step->instruction }}</p>

                                @if($step->image_path)
                                    <div class="mb-4">
                                        <img src="{{ asset('storage/' . $step->image_path) }}" 
                                             alt="Langkah {{ $step->step_number }}"
                                             class="rounded-lg border-2 border-gray-200 max-w-md"
                                             onerror="this.onerror=null; this.parentElement.classList.add('hidden');">
                                    </div>
                                @endif

                                <div class="flex flex-wrap items-center gap-3">
                                    @if($step->duration)
                                        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white rounded-lg border border-gray-200">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span class="text-sm font-semibold text-gray-700">{{ $step->duration }}</span>
                                        </div>
                                    @endif
                                </div>

                                @if($step->tips)
                                    <div class="mt-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
                                        <div class="flex items-start gap-2">
                                            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                            </svg>
                                            <div>
                                                <p class="text-sm font-semibold text-green-900 mb-1">Tips:</p>
                                                <p class="text-sm text-green-800">{{ $step->tips }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- General Instructions -->
            @if($recipe->instructions)
                <div class="mb-12">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b-2 border-gray-200">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Petunjuk Umum</h2>
                    </div>
                    <div class="bg-green-50 p-6 rounded-xl border-2 border-green-100">
                        <p class="text-gray-700 leading-relaxed">{{ $recipe->instructions }}</p>
                    </div>
                </div>
            @endif

            <!-- Warnings & Side Effects -->
            @if($recipe->warnings || $recipe->side_effects)
                <div class="mb-12">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b-2 border-gray-200">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Peringatan Penting</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($recipe->warnings)
                            <div class="bg-red-50 p-6 rounded-xl border-2 border-red-200">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <h3 class="text-lg font-bold text-red-900">Peringatan</h3>
                                </div>
                                <p class="text-sm text-red-800 leading-relaxed">{{ $recipe->warnings }}</p>
                            </div>
                        @endif

                        @if($recipe->side_effects)
                            <div class="bg-yellow-50 p-6 rounded-xl border-2 border-yellow-200">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <h3 class="text-lg font-bold text-yellow-900">Efek Samping</h3>
                                </div>
                                <p class="text-sm text-yellow-800 leading-relaxed">{{ $recipe->side_effects }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center pt-8 border-t-2 border-gray-200">
                <a href="{{ route('recipes.index') }}" 
                   class="inline-flex items-center justify-center gap-2 bg-white text-green-600 border-2 border-green-600 px-8 py-3 rounded-xl font-semibold hover:bg-green-50 transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Racikan
                </a>
                <a href="{{ route('diseases.show', $recipe->disease->slug) }}" 
                   class="inline-flex items-center justify-center gap-2 bg-green-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-green-700 transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Lihat Info Penyakit: {{ $recipe->disease->name }}
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Related Recipes -->
@php
    $relatedRecipes = \App\Models\HerbalRecipe::where('disease_id', $recipe->disease_id)
        ->where('id', '!=', $recipe->id)
        ->active()
        ->with(['disease', 'ingredients.plant'])
        ->take(3)
        ->get();
@endphp

@if($relatedRecipes->isNotEmpty())
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Racikan Herbal Lainnya</h2>
                    <p class="text-gray-600">Resep alternatif untuk {{ $recipe->disease->name }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedRecipes as $relatedRecipe)
                        <div class="bg-white rounded-xl shadow-sm border-2 border-gray-100 hover:shadow-lg hover:border-green-200 transition-all duration-300 overflow-hidden">
                            <div class="p-6">
                                <!-- Difficulty Badge -->
                                <div class="mb-3">
                                    @if($relatedRecipe->difficulty_level === 'easy')
                                        <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-lg">Mudah</span>
                                    @elseif($relatedRecipe->difficulty_level === 'medium')
                                        <span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-lg">Sedang</span>
                                    @else
                                        <span class="px-2.5 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-lg">Sulit</span>
                                    @endif
                                </div>

                                <!-- Recipe Name -->
                                <h3 class="text-lg font-bold text-gray-900 mb-2 hover:text-green-600 transition-colors">
                                    {{ $relatedRecipe->name }}
                                </h3>

                                <!-- Description -->
                                <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">
                                    {{ $relatedRecipe->description }}
                                </p>

                                <!-- Ingredients Count -->
                                <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                                    </svg>
                                    <span>{{ $relatedRecipe->ingredients->count() }} bahan herbal</span>
                                </div>

                                <!-- CTA Button -->
                                <a href="{{ route('recipes.show', $relatedRecipe->id) }}" 
                                   class="block w-full text-center bg-green-600 text-white py-2.5 rounded-lg font-semibold hover:bg-green-700 transition-colors text-sm">
                                    Lihat Resep →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
@endsection
