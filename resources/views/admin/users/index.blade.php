@extends('layouts.admin')

@section('title', 'Kelola Users')
@section('page-title', 'Kelola Users')
@section('page-description', 'Manajemen data users')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                <i class="fas fa-plus mr-2"></i>
                Tambah User
            </a>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="text-left py-3 px-1 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Id
                                </th>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($users as $user)
                                <tr class="hover:bg-slate-50 transition-colors duration-200">
                                    <td class="py-4 px-1">
                                        <div class="text-sm font-medium text-slate-900">
                                            {{ $user->id}}
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm font-medium text-slate-900">{{ $user->name }}</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-slate-600">{{ $user->email }}</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-1">
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors duration-200"
                                                title="Edit User">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>
                                            @if($user->id != auth()->id())
                                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                                                    class="inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors duration-200"
                                                        title="Hapus User"
                                                        onclick="return confirm('Yakin ingin menghapus user ini?')">
                                                        <i class="fas fa-trash text-sm"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center mb-4">
                                                <i class="fas fa-users text-2xl text-slate-400"></i>
                                            </div>
                                            <p class="text-lg font-medium text-slate-600 mb-2">Belum ada data user</p>
                                            <p class="text-sm text-slate-500 mb-4">Mulai dengan menambahkan user pertama</p>
                                            <a href="{{ route('admin.users.create') }}"
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                                <i class="fas fa-plus mr-2"></i>
                                                Tambah User
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-6 pt-6 border-t border-slate-200">
                        <div class="text-sm text-slate-600">
                            Menampilkan {{ $users->firstItem() ?? 0 }} sampai {{ $users->lastItem() ?? 0 }}
                            dari {{ $users->total() }} data
                        </div>

                        <div class="flex items-center justify-center sm:justify-end">
                            <div class="flex items-center space-x-2">
                                {{-- Previous Page Link --}}
                                @if ($users->onFirstPage())
                                    <span class="px-2 py-0.5 text-gray-400 bg-slate-100 border border-slate-300 rounded-lg cursor-not-allowed">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                @else
                                    <a href="{{ $users->previousPageUrl() }}"
                                        class="px-2 py-0.5 text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                    @if ($page == $users->currentPage())
                                        <span class="px-2 py-0.5 text-white bg-blue-500 border border-blue-500 rounded-lg font-semibold">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}"
                                            class="px-2 py-0.5 text-blue-600 bg-white border border-slate-300 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($users->hasMorePages())
                                    <a href="{{ $users->nextPageUrl() }}"
                                        class="px-2 py-0.5 text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                @else
                                    <span class="px-2 py-0.5 text-gray-400 bg-slate-100 border border-slate-300 rounded-lg cursor-not-allowed">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection