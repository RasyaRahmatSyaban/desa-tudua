<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PengumumanService;

class PengumumanController extends Controller
{
    protected $pengumumanService;

    public function __construct(PengumumanService $pengumumanService)
    {
        $this->pengumumanService = $pengumumanService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:100',
            'status' => 'nullable|in:Aktif,Nonaktif',
        ]);

        $hasFilter = $request->filled('search') || $request->filled('status');

        if ($hasFilter) {
            $pengumuman = $this->pengumumanService->getFiltered($request);
        } else {
            $pengumuman = $this->pengumumanService->getPaginated();
        }
        $user = auth()->user();
        if ($user) {
            return view('admin.pengumuman.index', compact('pengumuman'));
        } else {
            return view('pengumuman', compact('pengumuman'));
        }
    }

    public function show($id)
    {
        $data = $this->pengumumanService->getById($id);
        return view('pengumuman.show', compact('data'));
    }
    public function create()
    {
        return view('admin.pengumuman.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:Aktif,Nonaktif',
            'berlaku_hingga' => 'required|date',
        ]);

        $this->pengumumanService->create($validated);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Data pengumuman berhasil ditambahkan');
    }
    public function edit($id)
    {
        $pengumuman = $this->pengumumanService->getById($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:Aktif,Nonaktif',
            'berlaku_hingga' => 'required|date',
        ]);

        $this->pengumumanService->update($id, $validated);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Data pengumuman berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->pengumumanService->delete($id);
        return redirect()->route('admin.pengumuman.index')->with('success', 'Data pengumuman berhasil dihapus');
    }
}
