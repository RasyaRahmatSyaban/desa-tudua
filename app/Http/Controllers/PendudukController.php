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

        if ($hasFilter) {
            $penduduk = $this->pendudukService->getFiltered($request);
        } else {
            $penduduk = $this->pendudukService->getPaginated();
        }

        $kepalaKeluargaService = new KepalaKeluargaService();
        $kepalaKeluarga = $kepalaKeluargaService->getAll();
        $kepalaKeluargaByNik = $kepalaKeluarga->keyBy('nik');

        $totalPenduduk = Penduduk::count();
        $totalLakiLaki = $this->pendudukService->getTotalLaki();
        $totalPerempuan = $this->pendudukService->getTotalPerempuan();
        $totalKepalaKeluarga = KepalaKeluarga::count();

        $user = auth()->user();

        if ($user) {
            return view('admin.penduduk.index', compact(
                'penduduk',
                'kepalaKeluargaByNik',
                'totalPenduduk',
                'totalLakiLaki',
                'totalPerempuan',
                'totalKepalaKeluarga'
            ));
        } else {
            $anak = $this->pendudukService->getCountByAgeRange(0, 11);
            $remaja = $this->pendudukService->getCountByAgeRange(12, 17);
            $dewasa = $this->pendudukService->getCountByAgeRange(18, 59);
            $lansia = $this->pendudukService->getCountByAgeRange(60, 200);

            // Hitung persentase otomatis
            $ageGroups = [
                [
                    'label' => 'Anak-anak (0-11)',
                    'count' => $anak,
                    'color' => 'bg-blue-500',
                ],
                [
                    'label' => 'Remaja (12-17)',
                    'count' => $remaja,
                    'color' => 'bg-yellow-500',
                ],
                [
                    'label' => 'Dewasa (18-59)',
                    'count' => $dewasa,
                    'color' => 'bg-green-500',
                ],
                [
                    'label' => 'Lansia (60+)',
                    'count' => $lansia,
                    'color' => 'bg-red-500',
                ],
            ];

            foreach ($ageGroups as &$group) {
                $group['percent'] = $totalPenduduk > 0 ? round(($group['count'] / $totalPenduduk) * 100, 1) : 0;
            }

            $persenLaki = $totalPenduduk > 0 ? round($totalLakiLaki / $totalPenduduk * 100, 1) : 0;
            $persenPerempuan = $totalPenduduk > 0 ? round($totalPerempuan / $totalPenduduk * 100, 1) : 0;

            $islam = $this->pendudukService->getCountByReligion('Islam');
            $protestan = $this->pendudukService->getCountByReligion('Protestan');
            $katolik = $this->pendudukService->getCountByReligion('Katolik');
            $hindu = $this->pendudukService->getCountByReligion('Hindu');
            $buddha = $this->pendudukService->getCountByReligion('Buddha');

            return view('penduduk', compact(
                'penduduk',
                'kepalaKeluargaByNik',
                'totalPenduduk',
                'totalLakiLaki',
                'totalPerempuan',
                'totalKepalaKeluarga',
                'persenLaki',
                'persenPerempuan',
                'ageGroups',
                'islam',
                'protestan',
                'katolik',
                'hindu',
                'buddha'
            ));
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
            'nomorKK' => 'nullable|string|max:16|unique:kepala_keluarga,nomor_kk',
            'isKepalaKeluarga' => 'nullable|boolean',
        ]);

        $this->pendudukService->create($validated);

        if (!empty($validated['isKepalaKeluarga'])) {
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
        $nomor_kk = $kepalaKeluarga->getByNik($penduduk->nik);

        $isKepalaKeluarga = false;
        if (!$penduduk->id_kepalakeluarga && $nomor_kk) {
            $isKepalaKeluarga = true;
        }

        // Handle nilai checkbox dari old input atau default
        $isKepalaKeluargaOld = old('isKepalaKeluarga', $isKepalaKeluarga ? '1' : '');

        $listKepalaKeluarga = $kepalaKeluarga->getAll();

        return view('admin.penduduk.edit', compact(
            'penduduk',
            'listKepalaKeluarga',
            'isKepalaKeluarga',
            'nomor_kk',
            'isKepalaKeluargaOld'
        ));
    }
    public function update(Request $request, $id)
    {
        $penduduk = $this->pendudukService->getById($id);
        $kepalaKeluargaService = new KepalaKeluargaService();
        $kepalaKeluarga = $kepalaKeluargaService->getByNik($penduduk->nik);
        $idKK = optional($kepalaKeluarga)->id;
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:16|unique:penduduk,nik,' . $id,
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:50',
            'id_kepalakeluarga' => 'nullable|exists:kepala_keluarga,id',
            'nomorKK' => 'required|string|max:16|unique:kepala_keluarga,nomor_kk,' . $idKK,
        ]);

        if ($request->filled('isKepalaKeluarga')) {
            $validated['id_kepalakeluarga'] = null;
        }
        $this->pendudukService->update($id, $validated);

        $kepalaKeluargaService = new KepalaKeluargaService();

        if ($request->filled('isKepalaKeluarga')) {
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
        } else {
            $kepalaKeluargaService->deleteByNik($validated['nik']);
        }

        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->pendudukService->delete($id);
        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil dihapus');
    }
}
