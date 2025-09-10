<?php

namespace App\Services;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukService
{
    public function getAll()
    {
        return Penduduk::select('id', 'nama', 'nik', 'nomor_kk', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'id_kepalakeluarga')->get();
    }
    public function getAllKepalaKeluarga($excludeId = null)
    {
        $query = Penduduk::select('id', 'nama', 'nik', 'nomor_kk', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'id_kepalakeluarga')
            ->whereNull('id_kepalakeluarga');

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->get();
    }

    public function getPaginated($perPage = 10)
    {
        return Penduduk::select('id', 'nama', 'nik', 'nomor_kk', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'id_kepalakeluarga')->latest()->paginate($perPage);
    }

    public function getFiltered(Request $request)
    {
        return Penduduk::with('kepalaKeluarga')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('jenis_kelamin'), function ($query) use ($request) {
                $query->where('jenis_kelamin', $request->jenis_kelamin);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }
    public function getById($id)
    {
        return Penduduk::select('id', 'nama', 'nik', 'nomor_kk', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'id_kepalakeluarga')->findOrFail($id);
    }
    public function getByNik($nik)
    {
        return Penduduk::select('id', 'nama', 'nik', 'nomor_kk', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'id_kepalakeluarga')->where('nik', $nik)->first();
    }
    public function getTotalLaki()
    {
        return Penduduk::where('jenis_kelamin', 'Laki-laki')->count();
    }
    public function getTotalPerempuan()
    {
        return Penduduk::where('jenis_kelamin', 'Perempuan')->count();
    }
    public function getCountByAgeRange($minAge, $maxAge)
    {
        $today = today();

        $minDate = $today->copy()->subYears($maxAge + 1)->addDay();
        $maxDate = $today->copy()->subYears($minAge);

        return Penduduk::whereBetween('tanggal_lahir', [$minDate, $maxDate])->count();
    }
    public function getCountByReligion($agama)
    {
        return Penduduk::where('agama', $agama)->count();
    }

    public function create($data)
    {
        return Penduduk::create($data);
    }
    public function update($id, array $data)
    {
        $penduduk = Penduduk::findOrFail($id);

        $penduduk->update($data);
        return $penduduk;
    }
    public function delete($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        return $penduduk->destroy($id);
    }

}