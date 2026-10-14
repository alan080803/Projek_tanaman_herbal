@extends('layouts.admin')

@section('page-title', 'Daftar Racikan Obat Herbal')
@section('page-subtitle', 'Kelola resep racikan obat tradisional')

@section('content')
<!-- Decorative Background Elements -->
<div class="fixed top-20 right-20 w-96 h-96 bg-green-100/20 rounded-full blur-3xl pointer-events-none -z-10"></div>
<div class="fixed bottom-20 left-20 w-80 h-80 bg-green-50/30 rounded-full blur-3xl pointer-events-none -z-10"></div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="glass-card border-l-4 border-l-green-500 hover:shadow-soft-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wide">Total Racikan</p>
                <p class="text-3xl font-bold text-gray-900">{{ $recipes->total() }}</p>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center shadow-sm border-2 border-green-200">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="glass-card border-l-4 border-l-green-500 hover:shadow-soft-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wide">Aktif</p>
                <p class="text-3xl font-bold text-gray-900">{{ $recipes->where('is_active', true)->count() }}</p>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center shadow-sm border-2 border-green-200">
                <svg class="w-7 h-7 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="glass-card border-l-4 border-l-green-500 hover:shadow-soft-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wide">Untuk Penyakit</p>
                <p class="text-3xl font-bold text-gray-900">{{ $diseases->count() ?? 0 }}</p>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center shadow-sm border-2 border-green-200">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Daftar Racikan</h2>
            <p class="text-sm text-gray-600 mt-1">
                @if(request('search') || request('disease_id') || request('status'))
                    Menampilkan hasil filter
                @else
                    Kelola semua resep racikan obat herbal
                @endif
            </p>
        </div>
        <a href="{{ route('admin.recipes.create') }}" class="btn-primary">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Racikan
        </a>
    </div>

    <!-- Filters -->
    <div class="mb-6 space-y-4">
        <form method="GET" action="{{ route('admin.recipes.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-3">
            <div class="md:col-span-4">
                <label class="label">Pencarian</label>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari nama racikan atau deskripsi..." 
                    class="input"
                >
            </div>
            <div class="md:col-span-3">
                <label class="label">Penyakit</label>
                <select name="disease_id" class="input">
                    <option value="">Semua Penyakit</option>
                    @foreach($diseases ?? [] as $disease)
                    <option value="{{ $disease->id }}" {{ request('disease_id') == $disease->id ? 'selected' : '' }}>
                        {{ $disease->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="label">Status</label>
                <select name="status" class="input">
                    <option value="">Semua</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            <div class="md:col-span-3 flex items-end gap-2">
                <button type="submit" class="flex-1 inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Filter
                </button>
                @if(request()->hasAny(['search', 'disease_id', 'status']))
                <a href="{{ route('admin.recipes.index') }}" class="p-2.5 text-gray-700 bg-white border-2 border-gray-200 hover:border-gray-300 hover:bg-gray-50 rounded-xl transition-all duration-200" title="Reset Filter">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>
                @endif
            </div>
        </form>
        
        <!-- Active Filters -->
        @if(request()->hasAny(['search', 'disease_id', 'status']))
        <div class="flex flex-wrap items-center gap-2 p-4 bg-green-50 rounded-xl border-2 border-green-100">
            <span class="text-xs font-bold text-green-700 uppercase tracking-wide">Filter Aktif:</span>
            @if(request('search'))
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                Pencarian: "{{ request('search') }}"
                <a href="{{ route('admin.recipes.index', request()->except('search')) }}" class="ml-2 hover:text-green-900">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
            </span>
            @endif
            @if(request('disease_id'))
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                Penyakit: {{ $diseases->firstWhere('id', request('disease_id'))->name ?? 'Unknown' }}
                <a href="{{ route('admin.recipes.index', request()->except('disease_id')) }}" class="ml-2 hover:text-green-900">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
            </span>
            @endif
            @if(request('status'))
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                Status: {{ request('status') == 'active' ? 'Aktif' : 'Nonaktif' }}
                <a href="{{ route('admin.recipes.index', request()->except('status')) }}" class="ml-2 hover:text-green-900">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
            </span>
            @endif
        </div>
        @endif
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl border-2 border-gray-100">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                <tr class="border-b-2 border-gray-200">
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">No</th>
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Racikan</th>
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider hidden lg:table-cell">Penyakit</th>
                    <th class="text-center py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider hidden md:table-cell">Kesulitan</th>
                    <th class="text-center py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="text-center py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($recipes as $recipe)
                <tr class="hover:bg-green-50/30 transition-all duration-200">
                    <td class="py-4 px-4 whitespace-nowrap">
                        <span class="text-sm font-semibold text-gray-700">{{ $recipes->firstItem() + $loop->index }}</span>
                    </td>
                    <td class="py-4 px-4">
                        <div class="min-w-[200px]">
                            <p class="text-sm font-bold text-gray-900 mb-1">{{ $recipe->name }}</p>
                            <p class="text-xs text-gray-500 line-clamp-1">{{ Str::limit($recipe->description, 60) }}</p>
                        </div>
                    </td>
                    <td class="py-4 px-4 hidden lg:table-cell">
                        <span class="text-sm font-medium text-gray-700">{{ $recipe->disease->name ?? '-' }}</span>
                    </td>
                    <td class="py-4 px-4 text-center hidden md:table-cell">
                        @php
                            $difficultyColors = [
                                'easy' => 'bg-green-100 text-green-800 border-green-200',
                                'medium' => 'bg-green-100 text-green-800 border-green-200',
                                'hard' => 'bg-slate-100 text-slate-800 border-slate-200',
                            ];
                            $difficultyLabels = [
                                'easy' => 'Mudah',
                                'medium' => 'Sedang',
                                'hard' => 'Sulit',
                            ];
                        @endphp
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold border {{ $difficultyColors[$recipe->difficulty_level] ?? 'bg-gray-100 text-gray-800 border-gray-200' }} shadow-sm">
                            {{ $difficultyLabels[$recipe->difficulty_level] ?? $recipe->difficulty_level }}
                        </span>
                    </td>
                    <td class="py-4 px-4 text-center">
                        @if($recipe->is_active)
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200 shadow-sm">
                            <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Aktif
                        </span>
                        @else
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200 shadow-sm">
                            Nonaktif
                        </span>
                        @endif
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.recipes.show', $recipe->id) }}" class="p-2 text-green-600 hover:bg-green-50 rounded-xl transition-all duration-200 border-2 border-transparent hover:border-green-200" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('admin.recipes.edit', $recipe->id) }}" class="p-2 text-green-600 hover:bg-green-50 rounded-xl transition-all duration-200 border-2 border-transparent hover:border-green-200" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.recipes.destroy', $recipe->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus racikan ini?\n\nTindakan ini tidak dapat dibatalkan.');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit"
                                    class="p-2 text-gray-600 hover:bg-gray-50 rounded-xl transition-all duration-200 border-2 border-transparent hover:border-gray-200" 
                                    title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-16 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-24 h-24 bg-green-100 rounded-2xl flex items-center justify-center mb-4">
                                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                @if(request()->hasAny(['search', 'disease_id', 'status']))
                                    Tidak Ada Hasil
                                @else
                                    Belum Ada Racikan
                                @endif
                            </h3>
                            <p class="text-gray-500 text-sm mb-6 max-w-md">
                                @if(request('search'))
                                    Tidak ada racikan yang ditemukan dengan kata kunci "{{ request('search') }}".
                                @elseif(request('disease_id') || request('status'))
                                    Tidak ada racikan dengan filter yang dipilih.
                                @else
                                    Belum ada resep racikan obat herbal dalam sistem.
                                @endif
                            </p>
                            @if(!request()->hasAny(['search', 'disease_id', 'status']))
                            <a href="{{ route('admin.recipes.create') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Racikan Pertama
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($recipes->hasPages())
    <div class="mt-6 pt-6 border-t-2 border-gray-100">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-bold text-gray-900">{{ $recipes->firstItem() }}</span> 
                sampai <span class="font-bold text-gray-900">{{ $recipes->lastItem() }}</span> 
                dari <span class="font-bold text-gray-900">{{ $recipes->total() }}</span> data
            </div>
            <div>
                {{ $recipes->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
