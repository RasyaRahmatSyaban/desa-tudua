@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('page-title', 'Kelola Berita')
@section('page-description', 'Manajemen berita dan informasi desa')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex items-center justify-between">
            <form method="GET" action="{{ route('admin.berita.index') }}" class="flex items-center space-x-4">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari berita..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            id="searchInput">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <select name="status" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                        <option value="Dipublikasi" {{ request('status') == 'Dipublikasi' ? 'selected' : '' }}>Dipublikasi
                        </option>
                    </select>
                </div>
            </form>

            <a href="{{ route('admin.berita.create') }}"
                class="btn-primary text-white px-6 py-2 rounded-lg font-medium inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Tambah Berita
            </a>
        </div>

        <!-- Berita Table -->
        <div class="card bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Berita</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Penulis</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($berita as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Berita"
                                                    class="w-32 h-auto" />
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $item->judul }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                            {{ $item->penulis }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($item->status === 'Dipublikasi')
                                            <span class="px-2 py-1 text-xs font-medium bg-green-200 text-green-800 rounded-full">
                                                <i class="fas fa-check-circle mr-1"></i>Dipublikasi
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-medium bg-yellow-200 text-yellow-800 rounded-full">
                                                <i class="fas fa-clock mr-1"></i>Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.berita.show', $item->id) }}"
                                                class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.berita.edit', $item->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900 p-2 rounded-lg hover:bg-yellow-50">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.berita.destroy', $item->id) }}"
                                                class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 delete-button">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="text-gray-500">
                                            <i class="fas fa-newspaper text-4xl mb-4"></i>
                                            <p class="text-lg font-medium mb-2">Belum ada berita</p>
                                            <p class="text-sm">Mulai dengan menambahkan berita pertama</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-6">
                    <div class="text-sm text-gray-700">
                        Menampilkan {{ $berita->firstItem() ?? 0 }} sampai {{ $berita->lastItem() ?? 0 }}
                        dari {{ $berita->total() }} data
                    </div>
                    {{ $berita->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection