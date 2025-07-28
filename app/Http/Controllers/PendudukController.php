<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use App\Models\Penduduk;
use App\Services\KepalaKeluargaService;
use App\Services\PendudukService;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    protected $pendudukService;

    public function __construct(PendudukService $pendudukService)
    {
        $this->pendudukService = $pendudukService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
        ]);

        $hasFilter = $request->filled('search') || $request->filled('jenis_kelamin');
        
        if($hasFilter){
            $penduduk = $this->pendudukService->getFiltered($request);
        }else{
            $penduduk = $this->pendudukService->getPaginated();
        }

        $kepalaKeluarga = (new KepalaKeluargaService())->getAll();
        $kepalaKeluargaByNik = $kepalaKeluarga->keyBy('nik');

        $totalPenduduk = Penduduk::count();
        $totalLakiLaki = $this->pendudukService->getTotalLaki();
        $totalPerempuan = $this->pendudukService->getTotalPerempuan();
        $totalKepalaKeluarga = KepalaKeluarga::count();

        $user = auth()->user();
        if($user){
            return view('admin.penduduk.index', compact('penduduk', 'kepalaKeluargaByNik','totalPenduduk', 'totalLakiLaki', 'totalPerempuan', 'totalKepalaKeluarga'));
        }else{            
            return view('penduduk', compact('penduduk'));
        }
    }

    public function show($id)
    {
        $data = $this->pendudukService->getById($id);
        return view('penduduk.show', compact('data'));
    }
    public function create()
    {
        $kepalaKeluarga = new KepalaKeluargaService();
        $listKepalaKeluarga = $kepalaKeluarga->getAll();
        return view('admin.penduduk.create', compact('listKepalaKeluarga'));   
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:16|unique:penduduk',
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:50',
            'id_kepalakeluarga' => 'nullable|exists:kepala_keluarga,id',
            'nomorKK' => 'required|string|max:16|unique:kepala_keluarga,nomor_kk',
            'isKepalaKeluarga' => 'nullable|boolean',
        ]);

        $this->pendudukService->create($validated);

        if(!empty($validated['isKepalaKeluarga'])){
            $kepalaKeluargaSerice = new KepalaKeluargaService();
            $kepalaKeluargaSerice->create([
                'nomor_kk' => $validated['nomorKK'],
                'nama' => $validated['nama'],
                'nik' => $validated['nik'],
            ]);
        }

        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan');
    }
    public function edit($id)
    {
        $penduduk = $this->pendudukService->getById($id);
        $kepalaKeluarga = new KepalaKeluargaService();
        $listKepalaKeluarga = $kepalaKeluarga->getAll();
        return view('admin.penduduk.edit', compact('penduduk', 'listKepalaKeluarga'));   
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:16|unique:penduduk,nik,' . $id,
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:50',
            'id_kepalakeluarga' => 'nullable|exists:kepala_keluarga,id',
            'nomorKK' => 'required|string|max:16|unique:kepala_keluarga,nomor_kk,' . $id,
        ]);

        $this->pendudukService->update($id, $validated);

        if(!empty($validated['isKepalaKeluarga'])){
            $kepalaKeluargaService = new KepalaKeluargaService();
            $kk = KepalaKeluarga::where('nik', $validated['nik'])->first();
            if ($kk) {
                $kepalaKeluargaService->update($kk->id, [
                    'nomor_kk' => $validated['nomorKK'],
                    'nama' => $validated['nama'],
                    'nik' => $validated['nik'],
                ]);
            } else {
                $kepalaKeluargaService->create([
                    'nomor_kk' => $validated['nomorKK'],
                    'nama' => $validated['nama'],
                    'nik' => $validated['nik'],
                ]);
            }
        }else{
            $kepalaKeluargaService = new KepalaKeluargaService();
            $kepalaKeluargaService->deleteByNik($validated['nik']);
        }

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->pendudukService->delete($id);
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus');
    }
}
