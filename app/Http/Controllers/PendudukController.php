<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
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

        $kepalaKeluarga = $this->pendudukService->getAllKepalaKeluarga();
        $kepalaKeluargaByNik = $kepalaKeluarga->keyBy('nik');

        $totalPenduduk = Penduduk::count();
        $totalLakiLaki = $this->pendudukService->getTotalLaki();
        $totalPerempuan = $this->pendudukService->getTotalPerempuan();
        $totalKepalaKeluarga = Penduduk::whereNull('id_kepalakeluarga')->count();

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
            $kristen = $this->pendudukService->getCountByReligion('Kristen');
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
                'kristen',
                'katolik',
                'hindu',
                'buddha'
            ));
        }
    }

    public function show($id)
    {
        $data = $this->pendudukService->getById($id);
        $keluarga = $this->pendudukService->getDetailKeluarga($data->id);
        return view('admin.penduduk.show', compact('data', 'keluarga'));
    }
    public function create()
    {
        $listKepalaKeluarga = $this->pendudukService->getAllKepalaKeluarga();
        return view('admin.penduduk.create', compact('listKepalaKeluarga'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:16|unique:penduduk',
            'nomor_kk' => 'nullable|string|max:16|unique:penduduk,nomor_kk',
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha',
            'id_kepalakeluarga' => 'nullable|exists:penduduk,id',
            'isKepalaKeluarga' => 'nullable|boolean',
        ]);

        // Kepala keluarga
        if (!empty($validated['isKepalaKeluarga'])) {
            $request->validate([
                'nomor_kk' => 'required|string|max:16|unique:penduduk,nomor_kk',
            ]);
            $validated['id_kepalakeluarga'] = null;
        }
        // Anggota keluarga
        elseif (!empty($validated['id_kepalakeluarga'])) {
            $kepalaKeluarga = $this->pendudukService->getById($validated['id_kepalakeluarga']);
            if ($kepalaKeluarga && !empty($kepalaKeluarga->nomor_kk)) {
                $validated['nomor_kk'] = $kepalaKeluarga->nomor_kk;
            } else {
                return back()->withErrors([
                    'id_kepalakeluarga' => 'Nomor KK kepala keluarga tidak ditemukan, silakan periksa data.'
                ])->withInput();
            }
        }

        $this->pendudukService->create($validated);

        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil ditambahkan');
    }
    public function edit($id)
    {
        $penduduk = $this->pendudukService->getById($id);

        $isKepalaKeluarga = $penduduk->id_kepalakeluarga === null;

        $isKepalaKeluargaOld = old('isKepalaKeluarga', $isKepalaKeluarga ? '1' : '');

        $listKepalaKeluarga = $this->pendudukService->getAllKepalaKeluarga($penduduk->id);

        return view('admin.penduduk.edit', compact(
            'penduduk',
            'listKepalaKeluarga',
            'isKepalaKeluarga',
            'isKepalaKeluargaOld'
        ));
    }
    public function update(Request $request, $id)
    {
        $penduduk = $this->pendudukService->getById($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:16|unique:penduduk,nik,' . $id,
            'nomor_kk' => 'nullable|string|max:16|unique:penduduk,nomor_kk,' . $id,
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha',
            'id_kepalakeluarga' => 'nullable|exists:penduduk,id',
            'isKepalaKeluarga' => 'nullable|boolean',
        ]);

        if (!empty($validated['isKepalaKeluarga'])) {
            $request->validate([
                'nomor_kk' => 'required|string|max:16|unique:penduduk,nomor_kk,' . $id,
            ]);
            $validated['id_kepalakeluarga'] = null;
        } elseif (!empty($validated['id_kepalakeluarga'])) {
            $kepalaKeluarga = $this->pendudukService->getById($validated['id_kepalakeluarga']);
            if ($kepalaKeluarga && !empty($kepalaKeluarga->nomor_kk)) {
                $validated['nomor_kk'] = $kepalaKeluarga->nomor_kk;
            } else {
                return back()->withErrors([
                    'id_kepalakeluarga' => 'Nomor KK kepala keluarga tidak ditemukan.'
                ])->withInput();
            }
        }

        $this->pendudukService->update($id, $validated);

        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->pendudukService->delete($id);
        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil dihapus');
    }
}
