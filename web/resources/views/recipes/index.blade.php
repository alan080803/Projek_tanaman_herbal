@extends('layouts.app')

@section('title', 'Racikan Herbal')

@section('content')
<!-- Page Header -->
<section class="relative overflow-hidden bg-gradient-to-br from-green-50 via-white to-green-50/30 py-16 lg:py-24">
    <!-- Decorative Elements -->
    <div class="absolute top-10 right-10 w-64 h-64 bg-green-100/30 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-80 h-80 bg-green-50/40 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm border border-green-100 mb-6">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span class="text-sm font-semibold text-gray-700">Koleksi Resep Tradisional</span>
            </div>
            
            <!-- Title -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight tracking-tight">
                Racikan Herbal
                <span class="block mt-2 bg-gradient-to-r from-green-600 to-green-500 bg-clip-text text-transparent">
                    Tradisional
                </span>
            </h1>
            
            <!-- Subtitle -->
            <p class="text-lg md:text-xl text-gray-600 leading-relaxed font-light">
                Resep racikan herbal lengkap dengan bahan, dosis, dan panduan pembuatan untuk berbagai penyakit
            </p>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="bg-white py-8 border-b border-gray-100">
    <div class="container mx-auto px-4">
        <form method="GET" action="{{ route('recipes.index') }}" class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search -->
                <div class="md:col-span-3">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari racikan herbal..." 
                               class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/10 focus:outline-none transition-all duration-200 text-gray-900 placeholder-gray-400">
                    </div>
                </div>

                <!-- Disease Filter -->
                <div>
                    <select name="disease_id" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/10 focus:outline-none transition-all duration-200 text-gray-900">
                        <option value="">Semua Penyakit</option>
                        @foreach($diseases ?? \App\Models\Disease::active()->ordered()->get() as $disease)
                            <option value="{{ $disease->id }}" {{ request('disease_id') == $disease->id ? 'selected' : '' }}>
                                {{ $disease->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Difficulty Filter -->
                <div>
                    <select name="difficulty" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/10 focus:outline-none transition-all duration-200 text-gray-900">
                        <option value="">Semua Tingkat Kesulitan</option>
                        <option value="easy" {{ request('difficulty') == 'easy' ? 'selected' : '' }}>Mudah</option>
                        <option value="medium" {{ request('difficulty') == 'medium' ? 'selected' : '' }}>Sedang</option>
                        <option value="hard" {{ request('difficulty') == 'hard' ? 'selected' : '' }}>Sulit</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                            class="w-full bg-green-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-green-700 transition-colors duration-200 shadow-sm">
                        Terapkan Filter
                    </button>
                </div>
            </div>

            <!-- Active Filters -->
            @if(request()->hasAny(['search', 'disease_id', 'difficulty']))
                <div class="mt-4 flex flex-wrap gap-2">
                    @if(request('search'))
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-green-50 text-green-700 rounded-lg text-sm border border-green-100">
                            <span>Pencarian: "{{ request('search') }}"</span>
                            <a href="{{ route('recipes.index', request()->except('search')) }}" class="hover:text-green-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        </span>
                    @endif
                    @if(request('disease_id'))
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-green-50 text-green-700 rounded-lg text-sm border border-green-100">
                            <span>Penyakit: {{ \App\Models\Disease::find(request('disease_id'))->name }}</span>
                            <a href="{{ route('recipes.index', request()->except('disease_id')) }}" class="hover:text-green-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        </span>
                    @endif
                    @if(request('difficulty'))
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-green-50 text-green-700 rounded-lg text-sm border border-green-100">
                            <span>Tingkat: {{ ucfirst(request('difficulty')) }}</span>
                            <a href="{{ route('recipes.index', request()->except('difficulty')) }}" class="hover:text-green-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        </span>
                    @endif
                    <a href="{{ route('recipes.index') }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-gray-600 hover:text-gray-900 text-sm font-medium">
                        Reset Semua Filter
                    </a>
                </div>
            @endif
        </form>
    </div>
</section>

<!-- Recipes Grid -->
<section class="py-16 lg:py-20 bg-gradient-to-b from-gray-50/50 to-white">
    <div class="container mx-auto px-4">
        @if($recipes->isEmpty())
            <!-- Empty State -->
            <div class="max-w-md mx-auto text-center py-16">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Tidak ada racikan ditemukan</h3>
                <p class="text-gray-600 mb-6">Coba filter lain atau lihat semua racikan</p>
                <a href="{{ route('recipes.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <span>Lihat Semua Racikan</span>
                </a>
            </div>
        @else
            <!-- Results Count -->
            <div class="max-w-7xl mx-auto mb-8">
                <p class="text-gray-600">
                    Menampilkan <span class="font-semibold text-gray-900">{{ $recipes->count() }}</span> dari 
                    <span class="font-semibold text-gray-900">{{ $recipes->total() }}</span> racikan herbal
                </p>
            </div>

            <!-- Recipe Cards Grid -->
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recipes as $recipe)
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 hover:shadow-lg hover:border-green-200 transition-all duration-300 overflow-hidden group">
                        <!-- Recipe Header -->
                        <div class="p-6">
                            <!-- Disease Badge & Difficulty -->
                            <div class="flex items-center justify-between mb-3">
                                <a href="{{ route('diseases.show', $recipe->disease->slug) }}" 
                                   class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 rounded-lg text-sm font-semibold hover:bg-green-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    {{ $recipe->disease->name }}
                                </a>
                                
                                @if($recipe->difficulty_level === 'easy')
                                    <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-lg">Mudah</span>
                                @elseif($recipe->difficulty_level === 'medium')
                                    <span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-lg">Sedang</span>
                                @else
                                    <span class="px-2.5 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-lg">Sulit</span>
                                @endif
                            </div>

                            <!-- Recipe Name -->
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">
                                {{ $recipe->name }}
                            </h3>

                            <!-- Description -->
                            <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">
                                {{ $recipe->description }}
                            </p>

                            <!-- Quick Info -->
                            <div class="flex flex-wrap gap-3 mb-4">
                                @if($recipe->preparation_time)
                                    <div class="flex items-center gap-1.5 text-gray-600 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ $recipe->preparation_time }} menit</span>
                                    </div>
                                @endif
                                @if($recipe->servings)
                                    <div class="flex items-center gap-1.5 text-gray-600 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                        <span>{{ $recipe->servings }} porsi</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Ingredients Preview -->
                            <div class="mb-4">
                                <p class="text-xs font-semibold text-gray-500 mb-2">BAHAN-BAHAN:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($recipe->ingredients->take(3) as $ingredient)
                                        <span class="px-2.5 py-1 bg-gray-100 text-gray-700 text-xs rounded-lg">
                                            {{ $ingredient->plant->name }}
                                        </span>
                                    @endforeach
                                    @if($recipe->ingredients->count() > 3)
                                        <span class="px-2.5 py-1 bg-gray-100 text-gray-500 text-xs rounded-lg">
                                            +{{ $recipe->ingredients->count() - 3 }} lainnya
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- CTA Button -->
                            <a href="{{ route('recipes.show', $recipe->id) }}" 
                               class="block w-full text-center bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                Lihat Detail Resep →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 max-w-7xl mx-auto">
                {{ $recipes->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
