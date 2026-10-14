@extends('layouts.admin')

@section('page-title', 'Edit Tanaman Herbal')
@section('page-subtitle', 'Perbarui informasi tanaman herbal')

@section('content')
<!-- Decorative Background Elements -->
<div class="fixed top-20 right-20 w-96 h-96 bg-green-100/20 rounded-full blur-3xl pointer-events-none -z-10"></div>
<div class="fixed bottom-20 left-20 w-80 h-80 bg-green-50/30 rounded-full blur-3xl pointer-events-none -z-10"></div>

<div class="max-w-4xl">
    <form method="POST" action="{{ route('admin.plants.update', $plant->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Basic Information Card -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
            <div class="flex items-center gap-3 mb-4 pb-3 border-b-2 border-gray-200">
                <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-green-700 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Informasi Dasar</h3>
            </div>
            
            <div class="space-y-5">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Tanaman <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $plant->name) }}"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all @error('name') border-red-500 ring-2 ring-red-500/20 @enderror"
                        placeholder="Contoh: Jahe"
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Local Name -->
                    <div>
                        <label for="local_name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lokal/Daerah
                        </label>
                        <input 
                            type="text" 
                            id="local_name" 
                            name="local_name" 
                            value="{{ old('local_name', $plant->local_name) }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all @error('local_name') border-red-500 ring-2 ring-red-500/20 @enderror"
                            placeholder="Contoh: Jahe Merah"
                        >
                        @error('local_name')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Scientific Name -->
                    <div>
                        <label for="scientific_name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Ilmiah (Latin)
                        </label>
                        <input 
                            type="text" 
                            id="scientific_name" 
                            name="scientific_name" 
                            value="{{ old('scientific_name', $plant->scientific_name) }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all @error('scientific_name') border-red-500 ring-2 ring-red-500/20 @enderror"
                            placeholder="Contoh: Zingiber officinale"
                        >
                        @error('scientific_name')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <!-- Image Upload -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                        Gambar Utama
                    </label>
                    
                    @if($plant->image_path)
                    <div class="mb-4 p-4 bg-gray-50 rounded-xl border-2 border-gray-200">
                        <p class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Gambar saat ini:
                        </p>
                        <img src="{{ asset('storage/' . $plant->image_path) }}" alt="{{ $plant->name }}" class="w-32 h-32 rounded-xl object-cover shadow-lg border-2 border-gray-200">
                    </div>
                    @endif

                    <div class="flex items-center space-x-4">
                        <label for="image" class="cursor-pointer">
                            <div class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-2xl flex items-center justify-center hover:border-green-600 hover:bg-green-50/30 transition-all duration-200 bg-gray-50">
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center mx-auto mb-2">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium text-gray-600">Upload Baru</span>
                                </div>
                            </div>
                        </label>
                        <div class="flex-1">
                            <input 
                                type="file" 
                                id="image" 
                                name="image" 
                                accept="image/*"
                                class="hidden"
                                onchange="previewImage(event)"
                            >
                            <p class="text-sm font-medium text-gray-600 mb-1">Format: JPG, PNG, GIF (Max 2MB)</p>
                            <p class="text-xs text-gray-500">Upload gambar baru untuk mengganti yang lama</p>
                        </div>
                    </div>
                    <div id="image-preview" class="mt-3 hidden">
                        <p class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Preview gambar baru:
                        </p>
                        <img id="preview" class="w-32 h-32 rounded-xl object-cover shadow-lg border-2 border-gray-200">
                    </div>
                    @error('image')
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

        <!-- Description & Details Card -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
            <div class="flex items-center gap-3 mb-4 pb-3 border-b-2 border-gray-200">
                <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-green-700 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Deskripsi & Detail</h3>
            </div>
            
            <div class="space-y-5">
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi Umum <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all @error('description') border-red-500 ring-2 ring-red-500/20 @enderror"
                        placeholder="Deskripsi umum tentang tanaman ini..."
                    >{{ old('description', $plant->description) }}</textarea>
                    @error('description')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Characteristics -->
                <div>
                    <label for="characteristics" class="block text-sm font-semibold text-gray-700 mb-2">
                        Karakteristik Fisik
                    </label>
                    <textarea 
                        id="characteristics" 
                        name="characteristics" 
                        rows="3"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all @error('characteristics') border-red-500 ring-2 ring-red-500/20 @enderror"
                        placeholder="Ciri-ciri fisik tanaman..."
                    >{{ old('characteristics', $plant->characteristics) }}</textarea>
                    @error('characteristics')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Benefits -->
                <div>
                    <label for="benefits" class="block text-sm font-semibold text-gray-700 mb-2">
                        Khasiat & Manfaat <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="benefits" 
                        name="benefits" 
                        rows="3"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all @error('benefits') border-red-500 ring-2 ring-red-500/20 @enderror"
                        placeholder="Khasiat dan manfaat tanaman untuk kesehatan..."
                    >{{ old('benefits', $plant->benefits) }}</textarea>
                    @error('benefits')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Usage Notes -->
                <div>
                    <label for="usage_notes" class="block text-sm font-semibold text-gray-700 mb-2">
                        Catatan Penggunaan
                    </label>
                    <textarea 
                        id="usage_notes" 
                        name="usage_notes" 
                        rows="3"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all @error('usage_notes') border-red-500 ring-2 ring-red-500/20 @enderror"
                        placeholder="Cara penggunaan, dosis, peringatan, dll..."
                    >{{ old('usage_notes', $plant->usage_notes) }}</textarea>
                    @error('usage_notes')
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

        <!-- Settings Card -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
            <div class="flex items-center gap-3 mb-4 pb-3 border-b-2 border-gray-200">
                <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-green-700 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Pengaturan</h3>
            </div>
            
            <div class="flex items-center space-x-3">
                <label class="inline-flex items-center cursor-pointer group">
                    <input 
                        type="checkbox" 
                        name="is_active" 
                        value="1"
                        {{ old('is_active', $plant->is_active) ? 'checked' : '' }}
                        class="w-5 h-5 text-green-600 bg-gray-100 border-2 border-gray-300 rounded focus:ring-2 focus:ring-green-500 transition-all"
                    >
                    <span class="ml-3 text-sm font-medium text-gray-700 group-hover:text-green-600 transition-colors">Aktifkan tanaman ini</span>
                </label>
            </div>
            <p class="mt-2 text-xs text-gray-500">Nonaktif = tidak ditampilkan di website</p>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('admin.plants.index') }}" class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 hover:border-gray-300 transition-all shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.plants.show', $plant->id) }}" class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 hover:border-gray-300 transition-all shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Lihat Detail
                </a>
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 rounded-xl text-white font-semibold hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all shadow-lg shadow-green-600/30">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Tanaman
                </button>
            </div>
        </div>
    </form>

    <!-- Gallery Management -->
    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 mt-8">
        <div class="flex items-center gap-3 mb-4 pb-3 border-b-2 border-gray-200">
            <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-green-700 rounded-xl flex items-center justify-center shadow-lg shadow-green-600/20">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Galeri Gambar <span class="ml-2 inline-flex items-center justify-center w-8 h-8 text-xs font-bold text-green-700 bg-green-100 rounded-full">{{ $plant->images->count() }}</span></h3>
        </div>

        @if($plant->images->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
            @foreach($plant->images as $image)
            <div class="relative group bg-gray-50 border-2 border-gray-200 rounded-xl overflow-hidden hover:border-green-600 transition-all">
                <div class="aspect-square overflow-hidden">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                
                <div class="absolute top-2 right-2 flex items-center gap-2">
                    @if($image->is_primary)
                    <span class="px-2 py-1 bg-green-600 text-white text-xs font-bold rounded-lg shadow-lg">
                        Primary
                    </span>
                    @endif
                    <span class="px-2 py-1 bg-gray-900/80 text-white text-xs font-semibold rounded-lg backdrop-blur-sm">
                        {{ ucfirst(str_replace('_', ' ', $image->image_type)) }}
                    </span>
                </div>

                <div class="p-3 bg-white">
                    @if($image->title)
                    <p class="font-semibold text-sm text-gray-900 mb-1">{{ $image->title }}</p>
                    @endif
                    @if($image->description)
                    <p class="text-xs text-gray-600 mb-2 line-clamp-2">{{ $image->description }}</p>
                    @endif
                    
                    <form action="{{ route('admin.plants.images.destroy', [$plant->id, $image->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-50 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-600 hover:text-white transition-all">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8 mb-6">
            <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p class="font-medium text-gray-500">Belum ada gambar tambahan</p>
            <p class="text-sm text-gray-400 mt-1">Tambahkan gambar detail tanaman di bawah ini</p>
        </div>
        @endif

        <!-- Upload New Image Form -->
        <div class="border-t-2 border-gray-200 pt-6">
            <h4 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Gambar Baru
            </h4>
            
            <form action="{{ route('admin.plants.images.store', $plant->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Image Upload -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Gambar <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="file" 
                            name="image" 
                            accept="image/*"
                            required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                        >
                        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF (Max 2MB)</p>
                    </div>

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Gambar
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            placeholder="Contoh: Bunga Jahe"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all"
                        >
                    </div>

                    <!-- Image Type -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tipe Gambar <span class="text-red-500">*</span>
                        </label>
                        <select 
                            name="image_type" 
                            required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all"
                        >
                            <option value="">Pilih Tipe</option>
                            <option value="main">Gambar Utama</option>
                            <option value="leaf">Daun</option>
                            <option value="flower">Bunga</option>
                            <option value="fruit">Buah</option>
                            <option value="root">Akar</option>
                            <option value="stem">Batang</option>
                            <option value="habitat">Habitat</option>
                            <option value="processed">Olahan</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea 
                            name="description" 
                            rows="2"
                            placeholder="Deskripsi detail tentang gambar ini..."
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all"
                        ></textarea>
                    </div>

                    <!-- Is Primary -->
                    <div class="md:col-span-2">
                        <label class="inline-flex items-center cursor-pointer group">
                            <input 
                                type="checkbox" 
                                name="is_primary" 
                                value="1"
                                class="w-5 h-5 text-green-600 bg-gray-100 border-2 border-gray-300 rounded focus:ring-2 focus:ring-green-500 transition-all"
                            >
                            <span class="ml-3 text-sm font-medium text-gray-700 group-hover:text-green-600 transition-colors">Jadikan sebagai gambar utama galeri</span>
                        </label>
                        <p class="mt-1 ml-8 text-xs text-gray-500">Jika dicentang, gambar ini akan menjadi gambar utama di galeri (gambar primary lainnya akan otomatis dinonaktifkan)</p>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 rounded-xl text-white font-semibold hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all shadow-lg shadow-green-600/30">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Upload Gambar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
