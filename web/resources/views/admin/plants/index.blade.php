@extends('layouts.admin')

@section('page-title', 'Daftar Tanaman Herbal')
@section('page-subtitle', 'Kelola data tanaman herbal Indonesia')

@section('content')
<!-- Decorative Background Elements -->
<div class="fixed top-20 right-20 w-96 h-96 bg-green-100/20 rounded-full blur-3xl pointer-events-none -z-10"></div>
<div class="fixed bottom-20 left-20 w-80 h-80 bg-green-50/30 rounded-full blur-3xl pointer-events-none -z-10"></div>

<div class="glass-card">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Daftar Tanaman Herbal</h2>
            <p class="text-sm text-gray-600 mt-1 flex items-center gap-1.5">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                Total: <span class="font-semibold text-gray-900">{{ $plants->total() }}</span> tanaman
            </p>
        </div>
        <a href="{{ route('admin.plants.create') }}" class="btn-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Tanaman
        </a>
    </div>

    <!-- Search & Filters -->
    <div class="mb-6 p-4 bg-gray-50 rounded-xl border-2 border-gray-100">
        <form method="GET" action="{{ route('admin.plants.index') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari tanaman (nama, nama lokal, nama ilmiah)..." 
                    class="w-full px-4 py-2.5 text-sm border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                >
            </div>
            <button type="submit" class="btn-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cari
            </button>
            @if(request('search'))
            <a href="{{ route('admin.plants.index') }}" class="btn-secondary">
                Reset
            </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl border-2 border-gray-100">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">No</th>
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Tanaman</th>
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Lokal</th>
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Ilmiah</th>
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Digunakan</th>
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="text-center py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($plants as $plant)
                <tr class="hover:bg-green-50/50 transition-all duration-200">
                    <td class="py-4 px-4">
                        <span class="text-sm font-semibold text-gray-700">{{ $plants->firstItem() + $loop->index }}</span>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center gap-3">
                            @if($plant->image_path)
                            <img src="{{ asset('storage/' . $plant->image_path) }}" alt="{{ $plant->name }}" class="w-14 h-14 rounded-xl object-cover border-2 border-gray-100 shadow-sm">
                            @else
                            <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center border-2 border-green-200 shadow-sm">
                                <span class="text-base font-bold text-green-700">{{ substr($plant->name, 0, 1) }}</span>
                            </div>
                            @endif
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $plant->name }}</p>
                                <p class="text-xs text-gray-500 line-clamp-1 mt-0.5">{{ Str::limit($plant->benefits, 50) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="text-sm font-medium text-gray-700">{{ $plant->local_name ?? '-' }}</span>
                    </td>
                    <td class="py-4 px-4">
                        <span class="text-sm text-gray-600 italic">{{ $plant->scientific_name ?? '-' }}</span>
                    </td>
                    <td class="py-4 px-4">
                        <span class="badge-info">
                            {{ $plant->recipe_ingredients_count ?? 0 }} racikan
                        </span>
                    </td>
                    <td class="py-4 px-4">
                        @if($plant->is_active)
                        <span class="badge-success">
                            <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Aktif
                        </span>
                        @else
                        <span class="badge">
                            Nonaktif
                        </span>
                        @endif
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.plants.show', $plant->id) }}" class="p-2 text-green-600 hover:bg-green-50 rounded-xl transition-all border-2 border-transparent hover:border-green-200" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('admin.plants.edit', $plant->id) }}" class="p-2 text-green-600 hover:bg-green-50 rounded-xl transition-all border-2 border-transparent hover:border-green-200" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.plants.destroy', $plant->id) }}" onsubmit="return confirm('Yakin ingin menghapus tanaman ini?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-600 hover:bg-gray-50 rounded-xl transition-all border-2 border-transparent hover:border-gray-200" title="Hapus">
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
                    <td colspan="7" class="py-16 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-20 h-20 bg-green-100 rounded-2xl flex items-center justify-center mb-4">
                                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600 text-sm font-semibold mb-1">
                                @if(request('search'))
                                    Tidak Ditemukan
                                @else
                                    Belum Ada Data
                                @endif
                            </p>
                            <p class="text-gray-500 text-sm mb-5">
                                @if(request('search'))
                                    Tidak ada tanaman dengan kata kunci "{{ request('search') }}"
                                @else
                                    Belum ada data tanaman herbal yang tersedia
                                @endif
                            </p>
                            @if(!request('search'))
                            <a href="{{ route('admin.plants.create') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Tanaman Pertama
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
    @if($plants->hasPages())
    <div class="mt-6 pt-6 border-t-2 border-gray-100">
        {{ $plants->links() }}
    </div>
    @endif
</div>
@endsection
