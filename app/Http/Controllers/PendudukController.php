<?php

namespace App\Http\Controllers;

use App\Services\PendudukService;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    protected $pendudukService;

    public function __construct(PendudukService $pendudukService)
    {
        $this->pendudukService = $pendudukService;
    }

    public function index()
    {
        $penduduk = $this->pendudukService->getAll();
        $user = auth()->user();
        if($user){
            return view('admin.penduduk.index', compact('penduduk'));
        }else{            
            return view('penduduk', compact('penduduk'));
        }
    }

    public function show($id)
    {
        $data = $this->pendudukService->getById($id);
        return view('penduduk.show', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:16|unique:penduduk',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:50',
            'id_kepalakeluarga' => 'nullable|exists:kepala_keluarga,id',
        ]);

        $this->pendudukService->create($validated);

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:16|unique:penduduk,nik,' . $id,
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:50',
            'id_kepalakeluarga' => 'nullable|exists:kepala_keluarga,id',
        ]);

        $this->pendudukService->update($id, $validated);

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->pendudukService->delete($id);
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus');
    }
}
