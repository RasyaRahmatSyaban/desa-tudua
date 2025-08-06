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

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:100',
            'tipe' => 'nullable|in:Foto,Video,Dokumen',
        ]);

        $hasFilter = $request->filled('search') || $request->filled('tipe');

        if ($hasFilter) {
            $medias = $this->mediaService->getFiltered($request);
        } else {
            $medias = $this->mediaService->getPaginated();
        }
        $user = auth()->user();
        if ($user) {
            return view('admin.media.index', compact('medias'));
        } else {
            return view('media', compact('medias'));
        }
    }

    public function show($id)
    {
        $item = $this->mediaService->getById($id);
        return view('media.show', compact('item'));
    }
    public function create()
    {
        return view('admin.media.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'tipe' => 'required|in:Foto,Video,Dokumen',
            'file' => 'required|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi,pdf,doc,docs|max:10240',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $path = $file->storeAs('uploads/media', $originalName, 'public');
            $validated['file'] = $path;
        }

        $this->mediaService->create($validated);
        return redirect()->route('admin.media.index')->with('success', 'Media berhasil ditambahkan');
    }
    public function edit($id)
    {
        $media = $this->mediaService->getById($id);
        return view('admin.media.edit', compact('media'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'tipe' => 'required|in:Foto,Video,Dokumen',
            'file' => 'required|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi,pdf,doc,docs|max:10240',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $path = $file->storeAs('uploads/media', $originalName, 'public');
            $validated['file'] = $path;
        }

        $this->mediaService->update($id, $validated);
        return redirect()->route('admin.media.index')->with('success', 'Media berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->mediaService->delete($id);
        return redirect()->route('admin.media.index')->with('success', 'Media berhasil dihapus');
    }
}
