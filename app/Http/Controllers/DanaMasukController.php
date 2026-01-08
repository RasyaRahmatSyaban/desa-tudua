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

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:100',
        ]);        

        $hasFilter = $request->filled('search') || $request->filled('bulan') || $request->filled('tahun');

        if($hasFilter){
            $danaMasuk = $this->danaMasukService->getFiltered($request);
        }else{
            $danaMasuk = $this->danaMasukService->getPaginated();
        }

        $bulanMapping = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        foreach ($danaMasuk as $d) {
            $d->nama_bulan = $bulanMapping[$d->bulan] ?? '-';
        }

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

    public function create()
    {
        return view('admin.dana-masuk.create');   
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
        return redirect()->route('admin.dana-masuk.index')->with('success', 'Dana masuk berhasil ditambahkan');
    }
    public function edit($id)
    {
        $danaMasuk = $this->danaMasukService->getById($id);
        return view('admin.dana-masuk.edit', compact('danaMasuk'));   
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
        return redirect()->route('admin.dana-masuk.index')->with('success', 'Dana masuk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->danaMasukService->delete($id);
        return redirect()->route('admin.dana-masuk.index')->with('success', 'Dana masuk berhasil dihapus');
    }
}
