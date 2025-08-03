<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BeritaService;

class BeritaController extends Controller
{
    protected $beritaService;

    public function __construct(BeritaService $beritaService)
    {
        $this->beritaService = $beritaService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:100',
            'status' => 'nullable|in:Draft,Dipublikasi',
            'sort' => 'nullable|in:Terbaru,Terlama',
        ]);

        $user = auth()->user();

        if (!$user) {
            $request->merge(['status' => 'Dipublikasi']);
        }

        $hasFilter = $request->filled('search') || $request->filled('status') || $request->filled('sort');

        if ($hasFilter) {
            $berita = $this->beritaService->getFiltered($request);
        } else {
            $berita = $this->beritaService->getPaginated();
        }

        if ($user) {
            return view('admin.berita.index', compact('berita'));
        } else {
            return view('berita.index', compact('berita'));
        }
    }

    public function show($id)
    {
        $berita = $this->beritaService->getById($id);
        $beritaTerkait = $this->beritaService->getRandomBerita($id, 4);

        return view('berita.show', compact('berita', 'beritaTerkait'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // max 2MB
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_terbit' => 'required|date',
            'penulis' => 'required|string|max:100',
            'status' => 'required|in:Draft,Dipublikasi',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $originalName = $file->getClientOriginalName(); // nama asli file
            $path = $file->storeAs('uploads/berita', $originalName, 'public');
            $validated['foto'] = $path;
        }

        $this->beritaService->create($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }
    public function edit($id)
    {
        $berita = $this->beritaService->getById($id);
        return view('admin.berita.edit', compact('berita'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // max 2MB
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_terbit' => 'required|date',
            'penulis' => 'required|string|max:100',
            'status' => 'required|in:Draft,Dipublikasi',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('uploads/berita', 'public'); // disimpan di storage/app/public/uploads/berita
            $validated['foto'] = $path;
        }

        $this->beritaService->update($id, $validated);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->beritaService->delete($id);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
