<?php

namespace App\Http\Controllers;

use App\Services\DanaMasukService;
use Illuminate\Http\Request;

class DanaMasukController extends Controller
{
    protected $danaMasukService;

    public function __construct(DanaMasukService $danaMasukService)
    {
        $this->danaMasukService = $danaMasukService;
    }

    public function index()
    {
        $danaMasuk = $this->danaMasukService->getAll();
        $user = auth()->user();
        if($user){
            return view('admin.dana-masuk.index', compact('danaMasuk'));
        }else{
            return view('dana-desa.index', compact('danaMasuk'));
        }
    }

    public function show($id)
    {
        $item = $this->danaMasukService->getById($id);
        return view('danamasuk.show', compact('item'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer',
            'bulan' => 'required|integer|min:1|max:12',
            'jumlah' => 'required|numeric',
            'sumber' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $this->danaMasukService->create($validated);
        return redirect()->route('danamasuk.index')->with('success', 'Dana masuk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer',
            'bulan' => 'required|integer|min:1|max:12',
            'jumlah' => 'required|numeric',
            'sumber' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $this->danaMasukService->update($id, $validated);
        return redirect()->route('danamasuk.index')->with('success', 'Dana masuk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->danaMasukService->delete($id);
        return redirect()->route('danamasuk.index')->with('success', 'Dana masuk berhasil dihapus');
    }
}
