<?php

namespace App\Http\Controllers;

use App\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index()
    {
        $items = $this->mediaService->getAll();
        return view('media.index', compact('items'));
    }

    public function show($id)
    {
        $item = $this->mediaService->getById($id);
        return view('media.show', compact('item'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'tipe' => 'required|in:foto,video,dokumen',
            'deskripsi' => 'nullable|string',
            'thumbnail' => 'nullable|string',
        ]);

        $this->mediaService->create($validated);
        return redirect()->route('media.index')->with('success', 'Media berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'tipe' => 'required|in:foto,video,dokumen',
            'deskripsi' => 'nullable|string',
            'thumbnail' => 'nullable|string',
        ]);

        $this->mediaService->update($id, $validated);
        return redirect()->route('media.index')->with('success', 'Media berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->mediaService->delete($id);
        return redirect()->route('media.index')->with('success', 'Media berhasil dihapus');
    }
}
