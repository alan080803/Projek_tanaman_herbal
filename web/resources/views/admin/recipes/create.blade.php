@extends('layouts.admin')

@section('page-title', 'Tambah Racikan Obat Herbal')
@section('page-subtitle', 'Buat resep racikan baru')

@section('content')
<!-- Decorative Background Elements -->
<div class="fixed top-20 right-20 w-96 h-96 bg-green-100/20 rounded-full blur-3xl pointer-events-none -z-10"></div>
<div class="fixed bottom-20 left-20 w-80 h-80 bg-green-50/30 rounded-full blur-3xl pointer-events-none -z-10"></div>

<div class="max-w-4xl">
    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-xl">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-green-600 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="text-sm text-green-800">
                <p class="font-semibold mb-1">Catatan Pembuatan Racikan</p>
                <p>Anda dapat menambahkan bahan-bahan dan langkah-langkah pembuatan langsung saat membuat racikan baru. Form ini akan menyimpan semua informasi sekaligus.</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.recipes.store') }}" class="space-y-6">
        @csrf

        <!-- Basic Information -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
            <div class="flex items-center gap-3 mb-4 pb-3 border-b-2 border-gray-200">
                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Informasi Dasar</h3>
            </div>
            
            <div class="space-y-5">
                <!-- Disease -->
                <div>
                    <label for="disease_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Untuk Penyakit <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="disease_id" 
                        name="disease_id" 
                        required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all @error('disease_id') border-red-500 ring-2 ring-red-500/20 @enderror"
                    >
                        <option value="">Pilih Penyakit</option>
                        @foreach($diseases ?? [] as $disease)
                        <option value="{{ $disease->id }}" {{ old('disease_id', request('disease_id')) == $disease->id ? 'selected' : '' }}>
                            {{ $disease->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('disease_id')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Racikan <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all @error('name') border-red-500 ring-2 ring-red-500/20 @enderror"
                        placeholder="Contoh: Ramuan Jahe Madu untuk Batuk"
                    >
                    @error('name')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi Singkat
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="2"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all @error('description') border-red-500 ring-2 ring-red-500/20 @enderror"
                        placeholder="Deskripsi singkat racikan..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Instructions -->
                <div>
                    <label for="instructions" class="block text-sm font-semibold text-gray-700 mb-2">
                        Cara Pembuatan <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="instructions" 
                        name="instructions" 
                        rows="6"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all @error('instructions') border-red-500 ring-2 ring-red-500/20 @enderror"
                        placeholder="Jelaskan cara pembuatan racikan secara lengkap..."
                    >{{ old('instructions') }}</textarea>
                    @error('instructions')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Dosage & Duration -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
            <div class="flex items-center gap-3 mb-4 pb-3 border-b-2 border-gray-200">
                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Dosis & Durasi</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="dosage" class="block text-sm font-semibold text-gray-700 mb-2">
                        Dosis Penggunaan <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="dosage" 
                        name="dosage" 
                        value="{{ old('dosage') }}"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all @error('dosage') border-red-500 ring-2 ring-red-500/20 @enderror"
                        placeholder="Contoh: 2-3 kali sehari, 1 gelas"
                    >
                    @error('dosage')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label for="duration" class="block text-sm font-semibold text-gray-700 mb-2">
                        Durasi Penggunaan
                    </label>
                    <input 
                        type="text" 
                        id="duration" 
                        name="duration" 
                        value="{{ old('duration') }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all @error('duration') border-red-500 ring-2 ring-red-500/20 @enderror"
                        placeholder="Contoh: 3-5 hari"
                    >
                    @error('duration')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            <div class="mt-5 space-y-5">
                <div>
                    <label for="warnings" class="block text-sm font-semibold text-gray-700 mb-2">
                        Peringatan & Kontraindikasi
                    </label>
                    <textarea 
                        id="warnings" 
                        name="warnings" 
                        rows="2"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all @error('warnings') border-red-500 ring-2 ring-red-500/20 @enderror"
                        placeholder="Peringatan penggunaan..."
                    >{{ old('warnings') }}</textarea>
                    @error('warnings')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label for="side_effects" class="block text-sm font-semibold text-gray-700 mb-2">
                        Efek Samping
                    </label>
                    <textarea 
                        id="side_effects" 
                        name="side_effects" 
                        rows="2"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all @error('side_effects') border-red-500 ring-2 ring-red-500/20 @enderror"
                        placeholder="Efek samping yang mungkin terjadi..."
                    >{{ old('side_effects') }}</textarea>
                    @error('side_effects')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Ingredients Management -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4 pb-3 border-b-2 border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Bahan-bahan <span class="ml-2 inline-flex items-center justify-center w-8 h-8 text-xs font-bold text-green-700 bg-green-100 rounded-full" id="ingredient-count">0</span></h3>
                </div>
                <button type="button" onclick="addIngredient()" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold rounded-lg transition-all shadow-md hover:shadow-lg">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Bahan
                </button>
            </div>

            <div id="ingredients-container" class="space-y-4">
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <p class="font-medium">Belum ada bahan yang ditambahkan</p>
                    <p class="text-sm mt-1">Klik tombol "Tambah Bahan" untuk menambahkan bahan pertama</p>
                </div>
            </div>
        </div>

        <!-- Steps Management -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4 pb-3 border-b-2 border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Langkah-langkah Pembuatan <span class="ml-2 inline-flex items-center justify-center w-8 h-8 text-xs font-bold text-green-700 bg-green-100 rounded-full" id="step-count">0</span></h3>
                </div>
                <button type="button" onclick="addStep()" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold rounded-lg transition-all shadow-md hover:shadow-lg">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Langkah
                </button>
            </div>

            <div id="steps-container" class="space-y-4">
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <p class="font-medium">Belum ada langkah pembuatan yang ditambahkan</p>
                    <p class="text-sm mt-1">Klik tombol "Tambah Langkah" untuk menambahkan langkah pertama</p>
                </div>
            </div>
        </div>

        <!-- Settings -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
            <div class="flex items-center gap-3 mb-4 pb-3 border-b-2 border-gray-200">
                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Pengaturan</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label for="preparation_time" class="block text-sm font-semibold text-gray-700 mb-2">
                        Waktu Persiapan
                    </label>
                    <input 
                        type="text" 
                        id="preparation_time" 
                        name="preparation_time" 
                        value="{{ old('preparation_time') }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all @error('preparation_time') border-red-500 ring-2 ring-red-500/20 @enderror"
                        placeholder="15 menit"
                    >
                    @error('preparation_time')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label for="difficulty_level" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tingkat Kesulitan <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="difficulty_level" 
                        name="difficulty_level" 
                        required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all @error('difficulty_level') border-red-500 ring-2 ring-red-500/20 @enderror"
                    >
                        <option value="easy" {{ old('difficulty_level') == 'easy' ? 'selected' : '' }}>Mudah</option>
                        <option value="medium" {{ old('difficulty_level', 'medium') == 'medium' ? 'selected' : '' }}>Sedang</option>
                        <option value="hard" {{ old('difficulty_level') == 'hard' ? 'selected' : '' }}>Sulit</option>
                    </select>
                    @error('difficulty_level')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label for="servings" class="block text-sm font-semibold text-gray-700 mb-2">
                        Porsi
                    </label>
                    <input 
                        type="number" 
                        id="servings" 
                        name="servings" 
                        value="{{ old('servings', 1) }}"
                        min="1"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all @error('servings') border-red-500 ring-2 ring-red-500/20 @enderror"
                    >
                    @error('servings')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            <div class="mt-5">
                <label class="inline-flex items-center cursor-pointer group">
                    <input 
                        type="checkbox" 
                        name="is_active" 
                        value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-5 h-5 text-green-600 bg-gray-100 border-2 border-gray-300 rounded focus:ring-2 focus:ring-green-500 transition-all"
                    >
                    <span class="ml-3 text-sm font-medium text-gray-700 group-hover:text-green-600 transition-colors">Aktifkan racikan ini</span>
                </label>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end space-x-3 pt-2">
            <a href="{{ route('admin.recipes.index') }}" class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 hover:border-gray-300 transition-all shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Batal
            </a>
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 rounded-xl text-white font-semibold hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all shadow-lg shadow-green-600/30">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Racikan
            </button>
        </div>
    </form>
</div>

<script>
let ingredientIndex = 0;
let stepIndex = 0;

function addIngredient() {
    const container = document.getElementById('ingredients-container');
    const emptyState = container.querySelector('.text-center');
    if (emptyState) {
        emptyState.remove();
    }
    
    const html = `
        <div class="ingredient-item bg-gray-50 border-2 border-gray-200 rounded-xl p-4">
            <div class="flex items-start justify-between mb-3">
                <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">
                    Bahan #${ingredientIndex + 1}
                </span>
                <button type="button" onclick="removeIngredient(this)" class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanaman <span class="text-red-500">*</span></label>
                    <select name="ingredients[${ingredientIndex}][plant_id]" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
                        <option value="">Pilih Tanaman</option>
                        @foreach($plants as $plant)
                        <option value="{{ $plant->id }}">{{ $plant->name }} ({{ $plant->scientific_name }})</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah</label>
                    <input type="text" name="ingredients[${ingredientIndex}][quantity]" placeholder="100" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Satuan</label>
                    <input type="text" name="ingredients[${ingredientIndex}][unit]" placeholder="gram" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Bagian yang Digunakan</label>
                    <select name="ingredients[${ingredientIndex}][part_used]" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
                        <option value="leaf">Daun</option>
                        <option value="root">Akar</option>
                        <option value="stem">Batang</option>
                        <option value="flower">Bunga</option>
                        <option value="fruit">Buah</option>
                        <option value="seed">Biji</option>
                        <option value="bark">Kulit Kayu</option>
                        <option value="rhizome">Rimpang</option>
                        <option value="whole_plant">Seluruh Bagian</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan Persiapan</label>
                    <input type="text" name="ingredients[${ingredientIndex}][preparation_notes]" placeholder="Contoh: dicuci bersih, dipotong kecil" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', html);
    ingredientIndex++;
    updateIngredientCount();
}

function removeIngredient(button) {
    const item = button.closest('.ingredient-item');
    item.remove();
    
    const container = document.getElementById('ingredients-container');
    if (container.querySelectorAll('.ingredient-item').length === 0) {
        container.innerHTML = `
            <div class="text-center py-8 text-gray-500">
                <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <p class="font-medium">Belum ada bahan yang ditambahkan</p>
                <p class="text-sm mt-1">Klik tombol "Tambah Bahan" untuk menambahkan bahan pertama</p>
            </div>
        `;
    }
    updateIngredientCount();
}

function addStep() {
    const container = document.getElementById('steps-container');
    const emptyState = container.querySelector('.text-center');
    if (emptyState) {
        emptyState.remove();
    }
    
    const html = `
        <div class="step-item bg-gray-50 border-2 border-gray-200 rounded-xl p-4">
            <div class="flex items-start justify-between mb-3">
                <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-lg">
                    Langkah #${stepIndex + 1}
                </span>
                <button type="button" onclick="removeStep(this)" class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Langkah</label>
                    <input type="text" name="steps[${stepIndex}][title]" placeholder="Contoh: Persiapan Bahan" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Instruksi <span class="text-red-500">*</span></label>
                    <textarea name="steps[${stepIndex}][instruction]" rows="3" required placeholder="Jelaskan langkah ini secara detail..." class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all"></textarea>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Durasi</label>
                        <input type="text" name="steps[${stepIndex}][duration]" placeholder="Contoh: 10 menit" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tips</label>
                        <input type="text" name="steps[${stepIndex}][tips]" placeholder="Tips untuk langkah ini..." class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
                    </div>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', html);
    stepIndex++;
    updateStepCount();
}

function removeStep(button) {
    const item = button.closest('.step-item');
    item.remove();
    
    const container = document.getElementById('steps-container');
    if (container.querySelectorAll('.step-item').length === 0) {
        container.innerHTML = `
            <div class="text-center py-8 text-gray-500">
                <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <p class="font-medium">Belum ada langkah pembuatan yang ditambahkan</p>
                <p class="text-sm mt-1">Klik tombol "Tambah Langkah" untuk menambahkan langkah pertama</p>
            </div>
        `;
    }
    updateStepCount();
}

function updateIngredientCount() {
    const count = document.querySelectorAll('.ingredient-item').length;
    const badge = document.getElementById('ingredient-count');
    if (badge) {
        badge.textContent = count;
    }
}

function updateStepCount() {
    const count = document.querySelectorAll('.step-item').length;
    const badge = document.getElementById('step-count');
    if (badge) {
        badge.textContent = count;
    }
}
</script>
@endsection
