@extends('layouts.app')

@section('title', $disease->name . ' - Racikan Herbal')

@section('content')
<!-- Disease Header -->
<section class="bg-gradient-to-r from-green-600 to-emerald-700 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <nav class="text-sm mb-6 flex items-center gap-2">
                <a href="{{ route('home') }}" class="text-green-100 hover:text-white transition-colors">Beranda</a>
                <svg class="w-4 h-4 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('diseases.index') }}" class="text-green-100 hover:text-white transition-colors">Penyakit</a>
                <svg class="w-4 h-4 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-white font-medium">{{ $disease->name }}</span>
            </nav>
            
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-4">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-sm font-semibold">Informasi Penyakit Terverifikasi</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold mb-5 leading-tight">{{ $disease->name }}</h1>
            <p class="text-xl text-green-100 leading-relaxed">{{ $disease->description }}</p>
        </div>
    </div>
</section>

<!-- Disease Information -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Symptoms -->
                @if($disease->symptoms)
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 hover:shadow-lg hover:border-green-200 transition-all duration-200">
                    <div class="flex items-center gap-3 mb-4 pb-3 border-b-2 border-gray-100">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Gejala</h3>
                    </div>
                    <div class="text-gray-700 text-sm leading-relaxed">
                        {!! nl2br(e($disease->symptoms)) !!}
                    </div>
                </div>
                @endif

                <!-- Causes -->
                @if($disease->causes)
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 hover:shadow-lg hover:border-green-200 transition-all duration-200">
                    <div class="flex items-center gap-3 mb-4 pb-3 border-b-2 border-gray-100">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Penyebab</h3>
                    </div>
                    <div class="text-gray-700 text-sm leading-relaxed">
                        {!! nl2br(e($disease->causes)) !!}
                    </div>
                </div>
                @endif

                <!-- Prevention -->
                @if($disease->prevention)
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 hover:shadow-lg hover:border-green-200 transition-all duration-200">
                    <div class="flex items-center gap-3 mb-4 pb-3 border-b-2 border-gray-100">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Pencegahan</h3>
                    </div>
                    <div class="text-gray-700 text-sm leading-relaxed">
                        {!! nl2br(e($disease->prevention)) !!}
                    </div>
                </div>
                @endif
            </div>

            <!-- Herbal Recipes Section -->
            <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-8 pb-4 border-b-2 border-gray-100">
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Racikan Herbal untuk {{ $disease->name }}</h2>
                        <p class="text-gray-600 mt-1">Resep tradisional yang telah terbukti berkhasiat</p>
                    </div>
                </div>

                @if($disease->herbalRecipes->isEmpty())
                    <div class="text-center py-16">
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-2xl mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <p class="text-gray-600 text-lg">Belum ada racikan herbal untuk penyakit ini</p>
                    </div>
                @else
                    <div class="space-y-10">
                        @foreach($disease->herbalRecipes as $recipe)
                        <div class="bg-gray-50 border-2 border-gray-200 rounded-2xl p-8 hover:border-green-300 hover:shadow-lg transition-all duration-200" id="recipe-{{ $recipe->id }}">
                            <!-- Recipe Header -->
                            <div class="flex items-start justify-between mb-6 pb-5 border-b-2 border-gray-200">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        <h3 class="text-2xl font-bold text-gray-900">{{ $recipe->name }}</h3>
                                    </div>
                                    @if($recipe->description)
                                        <p class="text-gray-600 leading-relaxed">{{ $recipe->description }}</p>
                                    @endif
                                </div>
                                <div class="ml-6 flex-shrink-0">
                                    @php
                                        $difficultyColors = [
                                            'easy' => 'from-emerald-500 to-green-600',
                                            'medium' => 'from-green-500 to-emerald-600',
                                            'hard' => 'from-red-500 to-rose-600'
                                        ];
                                        $difficultyLabels = [
                                            'easy' => 'Mudah',
                                            'medium' => 'Sedang',
                                            'hard' => 'Sulit'
                                        ];
                                    @endphp
                                    <span class="inline-block bg-gradient-to-r {{ $difficultyColors[$recipe->difficulty_level] ?? 'from-green-500 to-emerald-600' }} text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                        {{ $difficultyLabels[$recipe->difficulty_level] ?? 'Sedang' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Quick Info -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-5 border-2 border-green-100">
                                @if($recipe->preparation_time)
                                <div class="text-center p-2">
                                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div class="text-xs font-semibold text-gray-600 mb-1">Waktu Persiapan</div>
                                    <div class="font-bold text-gray-900">{{ $recipe->preparation_time }}</div>
                                </div>
                                @endif
                                <div class="text-center p-2">
                                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                    </svg>
                                    <div class="text-xs font-semibold text-gray-600 mb-1">Dosis</div>
                                    <div class="font-bold text-gray-900">{{ $recipe->dosage }}</div>
                                </div>
                                @if($recipe->duration)
                                <div class="text-center p-2">
                                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div class="text-xs font-semibold text-gray-600 mb-1">Durasi</div>
                                    <div class="font-bold text-gray-900">{{ $recipe->duration }}</div>
                                </div>
                                @endif
                                <div class="text-center p-2">
                                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <div class="text-xs font-semibold text-gray-600 mb-1">Porsi</div>
                                    <div class="font-bold text-gray-900">{{ $recipe->servings }}x konsumsi</div>
                                </div>
                            </div>

                            <!-- Ingredients Section -->
                            <div class="mb-8">
                                <div class="flex items-center gap-3 mb-5 pb-3 border-b-2 border-gray-200">
                                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-bold text-gray-900">Bahan-bahan & Takaran</h4>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    @foreach($recipe->ingredients as $ingredient)
                                    <div class="flex items-start bg-white rounded-xl p-5 border-2 border-gray-200 hover:border-emerald-400 hover:shadow-lg transition-all duration-200">
                                        <!-- Plant Image -->
                                        <div class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0 bg-gradient-to-br from-emerald-50 to-green-100 border-2 border-emerald-200">
                                            @if($ingredient->plant->primaryImage)
                                                <img src="{{ asset('storage/' . $ingredient->plant->primaryImage->image_path) }}" 
                                                     alt="{{ $ingredient->plant->name }}"
                                                     class="w-full h-full object-cover"
                                                     onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center\'><svg class=\'w-12 h-12 text-emerald-400\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9\'></path></svg></div>';">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-12 h-12 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Ingredient Details -->
                                        <div class="ml-4 flex-1">
                                            <h5 class="font-bold text-gray-900 mb-1 text-lg">{{ $ingredient->plant->name }}</h5>
                                            @if($ingredient->plant->local_name)
                                                <p class="text-sm text-gray-500 mb-3 italic">({{ $ingredient->plant->local_name }})</p>
                                            @endif
                                            
                                            <div class="space-y-2 text-sm">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-semibold text-gray-700">Takaran:</span>
                                                    <span class="bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 px-3 py-1 rounded-full font-bold border border-green-200">
                                                        {{ $ingredient->quantity }} {{ $ingredient->unit }}
                                                    </span>
                                                </div>
                                                
                                                @php
                                                    $partLabels = [
                                                        'leaf' => 'Daun',
                                                        'root' => 'Akar',
                                                        'stem' => 'Batang',
                                                        'flower' => 'Bunga',
                                                        'fruit' => 'Buah',
                                                        'seed' => 'Biji',
                                                        'bark' => 'Kulit Kayu',
                                                        'rhizome' => 'Rimpang',
                                                        'whole_plant' => 'Seluruh Tanaman'
                                                    ];
                                                @endphp
                                                <div class="text-gray-700">
                                                    <span class="font-semibold">Bagian:</span> <span class="text-emerald-700 font-medium">{{ $partLabels[$ingredient->part_used] ?? $ingredient->part_used }}</span>
                                                </div>
                                                
                                                @if($ingredient->preparation_notes)
                                                    <div class="text-gray-600 mt-2 pt-2 border-t border-gray-200">
                                                        <span class="font-semibold">Catatan:</span> {{ $ingredient->preparation_notes }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Preparation Steps -->
                            @if($recipe->steps->isNotEmpty())
                            <div class="mb-8">
                                <div class="flex items-center gap-3 mb-5 pb-3 border-b-2 border-gray-200">
                                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-bold text-gray-900">Cara Pembuatan</h4>
                                </div>
                                
                                <div class="space-y-5">
                                    @foreach($recipe->steps as $step)
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-emerald-600 to-green-700 text-white rounded-xl flex items-center justify-center font-bold text-lg shadow-lg shadow-green-600/30">
                                            {{ $step->step_number }}
                                        </div>
                                        <div class="flex-1 bg-white rounded-xl p-5 border-2 border-gray-200">
                                            @if($step->title)
                                                <h5 class="font-bold text-gray-900 mb-2 text-lg">{{ $step->title }}</h5>
                                            @endif
                                            <p class="text-gray-700 leading-relaxed">{{ $step->instruction }}</p>
                                            
                                            <div class="flex items-center gap-4 mt-3 pt-3 border-t border-gray-100 text-sm">
                                                @if($step->duration)
                                                    <span class="flex items-center gap-1 text-gray-700">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        <span class="font-semibold">Durasi:</span> 
                                                        <span class="bg-gray-100 px-2 py-1 rounded-lg">{{ $step->duration }}</span>
                                                    </span>
                                                @endif
                                                @if($step->tips)
                                                    <span class="flex items-center gap-1 text-green-700">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                                        </svg>
                                                        <span class="font-semibold">Tips:</span> 
                                                        <span>{{ $step->tips }}</span>
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            @if($step->image_path)
                                                <img src="{{ asset('storage/' . $step->image_path) }}" 
                                                     alt="Step {{ $step->step_number }}"
                                                     class="mt-4 rounded-xl max-w-md border-2 border-gray-200"
                                                     onerror="this.onerror=null; this.classList.add('hidden');">
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Warnings and Side Effects -->
                            @if($recipe->warnings || $recipe->side_effects)
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 p-6 rounded-r-2xl shadow-sm">
                                <div class="flex items-center gap-2 mb-4">
                                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <h4 class="font-bold text-gray-900 text-lg">Perhatian Penting</h4>
                                </div>
                                
                                @if($recipe->warnings)
                                    <div class="mb-4 p-4 bg-white/50 rounded-xl">
                                        <p class="font-semibold text-gray-900 mb-2 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            Peringatan:
                                        </p>
                                        <p class="text-gray-700 text-sm leading-relaxed">{!! nl2br(e($recipe->warnings)) !!}</p>
                                    </div>
                                @endif
                                
                                @if($recipe->side_effects)
                                    <div class="p-4 bg-white/50 rounded-xl">
                                        <p class="font-semibold text-gray-900 mb-2 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            Efek Samping yang Mungkin Terjadi:
                                        </p>
                                        <p class="text-gray-700 text-sm leading-relaxed">{!! nl2br(e($recipe->side_effects)) !!}</p>
                                    </div>
                                @endif
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Medical Disclaimer -->
            <div class="mt-10 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-8 rounded-r-2xl shadow-lg">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-600 to-green-700 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-xl">Disclaimer Medis</h3>
                </div>
                <div class="bg-white/70 rounded-xl p-5">
                    <p class="text-gray-800 leading-relaxed">
                        Informasi racikan herbal ini bersifat <span class="font-semibold text-green-700">edukatif</span> dan berdasarkan pengetahuan tradisional. 
                        <strong class="text-green-900">Tidak dimaksudkan sebagai pengganti konsultasi medis profesional.</strong> 
                        Selalu konsultasikan dengan dokter atau tenaga kesehatan yang berkompeten sebelum menggunakan 
                        obat herbal, terutama jika Anda sedang mengonsumsi obat medis, sedang hamil, menyusui, 
                        atau memiliki kondisi kesehatan khusus. <strong class="text-green-900">Hentikan penggunaan dan segera hubungi dokter jika 
                        terjadi reaksi yang tidak diinginkan.</strong>
                    </p>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Actions -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Mungkin Anda Juga Tertarik</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('diseases.index') }}" class="card-hover bg-gradient-to-br from-green-50 to-white p-6 rounded-xl border-2 border-gray-200 text-center group">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-3 group-hover:text-green-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <h4 class="font-bold text-lg mb-2">Lihat Penyakit Lain</h4>
                    <p class="text-gray-600 text-sm">Eksplorasi 20 jenis penyakit dengan racikan herbalnya</p>
                </a>
                
                <a href="{{ route('detection.index') }}" class="card-hover bg-gradient-to-br from-green-50 to-white p-6 rounded-xl border-2 border-gray-200 text-center group">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-3 group-hover:text-green-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h4 class="font-bold text-lg mb-2">Deteksi Tanaman</h4>
                    <p class="text-gray-600 text-sm">Identifikasi tanaman herbal dengan AI</p>
                </a>
                
                <a href="{{ route('plants.index') }}" class="card-hover bg-gradient-to-br from-green-50 to-white p-6 rounded-xl border-2 border-gray-200 text-center group">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-3 group-hover:text-green-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                    </svg>
                    <h4 class="font-bold text-lg mb-2">Database Tanaman</h4>
                    <p class="text-gray-600 text-sm">Lihat koleksi lengkap tanaman herbal</p>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
