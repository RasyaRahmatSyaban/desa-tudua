<?php

namespace App\Services;

use App\Models\PerangkatDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PerangkatDesaService
{
    public function getAll()
    {
        return PerangkatDesa::select('id', 'nama', 'nip', 'jabatan', 'foto')->get();
    }
    public function getPaginated($perPage = 10)
    {
        return PerangkatDesa::select('id', 'nama', 'nip', 'jabatan', 'foto')
            ->orderByRaw("
            CASE 
                WHEN jabatan = 'kepala desa' THEN 1
                WHEN jabatan = 'sekretaris' THEN 2
                WHEN jabatan = 'bendahara' THEN 3
                ELSE 4
            END
        ")
            ->paginate($perPage);
    }
    public function getFiltered(Request $request)
    {
        return PerangkatDesa::select('id', 'nama', 'nip', 'jabatan', 'foto')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('nip', 'like', '%' . $request->search . '%')
                    ->orWhere('jabatan', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function getById($id)
    {
        return PerangkatDesa::select('id', 'nama', 'nip', 'jabatan', 'foto')->findOrFail($id);
    }
    public function getKepalaDesa()
    {
        return PerangkatDesa::select('id', 'nama', 'nip', 'jabatan', 'foto')
            ->where('jabatan', '=', 'kepala desa')->first();
    }
    public function create($data, $request)
    {
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $originalName = $foto->getClientOriginalName();
            $filename = now()->format('Ymd_His') . '_' . $originalName;
            $path = $foto->storeAs('uploads/perangkat-desa', $filename, 'public');

            $data['foto'] = $path;
        }
        return PerangkatDesa::create($data);
    }
    public function update($id, array $data, $request)
    {
        $perangkatDesa = PerangkatDesa::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($perangkatDesa->foto && Storage::disk('public')->exists($perangkatDesa->foto)) {
                Storage::disk('public')->delete($perangkatDesa->foto);
            }
            $foto = $request->file('foto');
            $originalName = $foto->getClientOriginalName();
            $filename = now()->format('Ymd_His') . '_' . $originalName;

            $path = $foto->storeAs('uploads/perangkat-desa', $filename, 'public');
            $data['foto'] = $path;
        }

        $perangkatDesa->update($data);
        return $perangkatDesa;
    }
    public function delete($id)
    {
        $perangkatDesa = $this->getById($id);

        if ($perangkatDesa->foto && Storage::disk('public')->exists($perangkatDesa->foto)) {
            Storage::disk('public')->delete($perangkatDesa->foto);
        }
        return $perangkatDesa->delete();
    }

}