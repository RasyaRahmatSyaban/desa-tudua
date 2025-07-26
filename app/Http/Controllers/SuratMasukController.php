<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SuratMasukService;

class SuratMasukController extends Controller
{
    protected $suratMasukService;

    public function __construct(SuratMasukService $suratMasukService)
    {
        $this->suratMasukService = $suratMasukService;;
    }

    public function index()
    {
        $suratMasuk = $this->suratMasukService->getAll();
        $user = auth()->user();
        if($user){
            return view('admin.surat-masuk.index', compact('suratMasuk'));
        }else{
            return view('suratmasuk.index', compact('suratMasuk'));
        }
    }

    public function show($id)
    {
        $data = $this->suratMasukService->getById($id);
        return view('suratmasuk.show', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'tanggal_terima' => 'required|date',
            'file' => 'nullable|url',
        ]);

        $this->suratMasukService->create($validated);

        return redirect()->route('suratmasuk.index')->with('success', 'Data surat masuk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'tanggal_terima' => 'required|date',
            'file' => 'nullable|url',
        ]);

        $this->suratMasukService->update($id, $validated);

        return redirect()->route('suratmasuk.index')->with('success', 'Data surat masuk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->suratMasukService->delete($id);
        return redirect()->route('suratmasuk.index')->with('success', 'Data surat masuk berhasil dihapus');
    }
}
